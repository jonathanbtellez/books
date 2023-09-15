<template>
	<div class="modal fade" id="book_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header d-flex">
					<h5 class="modal-title">{{ is_created ? 'Create' : 'Edit' }} book</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<backend-error :errors="back_errors" />
				<div class="modal-body">
					<!-- Formulario -->
					<Form :validation-schema="schema" ref="form" @submit="saveBook">
						<!-- Image -->
						<div class="col-12 d-flex justify-content-center mt-1">
							<img :src="image_preview" alt="Imagen Libro" class="img-thumbnail" width="170" height="170">
						</div>

						<!-- Load Image -->
						<div class="col-12 mt-1 ">
							<label for="file" class="form-label">Imagen</label>
							<input type="file" :class="`form-control ${back_errors['file'] ? 'is-invalid' : ''}`" id="file"
								accept="image/*" @change="previewImage">
							<span class="invalid-feedback" v-if="back_errors['file']">
								{{ back_errors['file'] }}
							</span>
						</div>
						<!-- Title -->
						<div class="col-12 mt-2">
							<label for="name">Book name:</label>
							<Field name="name" v-slot="{ errorMessage, field }" v-model="book.name">
								<input type="text" id="name" v-model="book.name"
									:class="`form-control ${errorMessage || back_errors['name'] ? 'is-invalid' : ''}`"
									v-bind="field">
								<span class="invalid-feedback">{{ errorMessage }}</span>
								<span class="invalid-feedback">{{ back_errors['name'] }}</span>
							</Field>
						</div>
						<!-- Stock -->
						<div class="col-12 mt-2">
							<Field name="stock" v-slot="{ errorMessage, field }" v-model="book.stock">
								<label for="stock">Cantidad</label>
								<input type="number" id="stock" v-model="book.stock"
									:class="`form-control ${errorMessage || back_errors['stock'] ? 'is-invalid' : ''}`"
									v-bind="field">
								<span class="invalid-feedback">{{ errorMessage }}</span>
								<span class="invalid-feedback">{{ back_errors['stock'] }}</span>
							</Field>
						</div>

						<!-- Description -->
						<div class="col-12 mt-2">
							<Field name="description" v-slot="{ errorMessage, field }" v-model="book.description">
								<label for="description">Descripcion</label>
								<textarea v-model="book.description"
									:class="`form-control ${errorMessage || back_errors['description'] ? 'is-invalid' : ''}`"
									id="description" rows="3" v-bind="field"></textarea>
								<span class="invalid-feedback">{{ errorMessage }}</span>
								<span class="invalid-feedback">{{ back_errors['description'] }}</span>
							</Field>
						</div>

						<!-- Author -->
						<div class="col-12 mt-2">
							<Field name="author" v-slot="{ errorMessage, field, valid }" v-model="author">
								<label for="author">Autor</label>

								<vue-select :options="authors_data" label="name" v-model="author"
									:reduce="author => author.id" v-bind="field" placeholder="Seleccione autor"
									:clearable="false"
									:class="`${errorMessage || back_errors['author'] ? 'is-invalid' : ''}`">
								</vue-select>
								<span class="invalid-feedback" v-if="!valid">{{ errorMessage }}</span>
								<span class="invalid-feedback" v-if="!valid">{{ back_errors['author'] }}</span>
							</Field>
						</div>

						<!-- Category -->
						<div class="col-12 mt-2" v-if="load_category">
							<Field name="category" v-slot="{ errorMessage, field, valid }" v-model="category">
								<label for="category">Categoria</label>

								<vue-select id="category" :options="categories_data" v-model="category"
									:reduce="category => category.id" v-bind="field" label="name"
									placeholder="Selecciona categoria" :clearable="false"
									:class="`${errorMessage || back_errors['category'] ? 'is-invalid' : ''}`">
								</vue-select>
								<span class="invalid-feedback" v-if="!valid">{{ errorMessage }}</span>
								<span class="invalid-feedback" v-if="!valid">{{ back_errors['category'] }}</span>
							</Field>
						</div>

						<!-- Buttons -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="sumbit" class="btn btn-primary">Save</button>
						</div>

					</Form>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import * as yup from 'yup'
import { Field, Form } from 'vee-validate';
import axios from 'axios'
import { successMessage, handlerErrors } from '@/helpers/Alerts'
export default {
	name: 'BookModal',
	components: { Field, Form },
	data() {
		return {
			is_created: true,
			book: {},
			author: null,
			category: null,
			load_category: false,
			categories_data: [],
			back_errors: {},
			image_preview: '/storage/images/books/default.png',
			file: null
		}
	},
	props: {
		authors_data: {
			type: Array,
			required: true
		},
		book_data: {
			type: Object,
			required: false
		}
	},
	computed: {
		/**
		 * @return a object with field validations
		 */
		schema() {
			return yup.object({
				author: yup.string().required(),
				category: yup.string().required(),
				description: yup.string().required(),
				name: yup.string().required(),
				stock: yup.number().required().positive().integer(),
			});
		}
	},
	methods: {
		index() {
			this.getCategories()
		},
		previewImage(event) {
			// Get the image from the input
			this.file = event.target.files[0];
			// Create a url usign a built-in class URL
			this.image_preview = URL.createObjectURL(this.file)
		},
		// Handle data that includes binary files
		createFormData(data) {
			const form_data = new FormData()
			if (this.file) form_data.append('file', this.file, this.file.name)
			for (const prop in data) {
				form_data.append(prop, data[prop])
			}
			return form_data
		},
		async getCategories() {
			try {
				const { data: { categories } } = await axios('/categories')
				this.categories_data = categories
				this.load_category = true
			} catch (error) {
				handlerErrors(error)
			}
		},

		async saveBook() {
			try {
				this.book.category_id = this.category
				this.book.author_id = this.author
				const book = this.createFormData(this.book)
				if (this.is_created) {
					await axios.post('/books/store', book)
				} else {
					await axios.post(`/books/${this.book.id}`, book)
				}
				await successMessage({ is_delete: false, reload: true })

			} catch (error) {
				this.back_errors = await handlerErrors(error)
			}
		},
		reset() {
			this.is_created = true
			this.book = {}
			this.author = null
			this.category = null
			this.$parent.book = {}
			this.back_errors = {}
			this.image_preview = '/storage/images/books/default.png'
			this.file = null
			document.getElementById('file').value = ''
			setTimeout(() => this.$refs.form.resetForm(), 100)
		}
	},

	watch: {
		book_data(newValue) {

			this.book = { ...newValue }
			if (!this.book.id) return
			this.is_created = false
			this.author = this.book.author_id
			this.category = this.book.category_id

		}
	},
	mounted() {
		this.index()
	},
}
</script>
<style></style>

Home
//image precio nombre descripciioon stock

<!-- Category -->
5 productos
//image precio nombre descripciioon stock


pagina del producto
