<template>
	<div class="modal fade" id="book_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header d-flex">
					<h5 class="modal-title">{{ is_create ? 'Create' : 'Edit' }} book</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<!-- Formulario -->
					<Form :validation-schema="schema" @submit="saveBook">
						<!-- Title -->
						<div class="col-12">
							<label for="name">Book name:</label>
							<Field name="name" v-slot="{ errorMessage, field }" v-model="book.name">
								<input type="text" id="name" v-model="book.name"
									:class="`form-control ${errorMessage ? 'is-invalid' : ''}`" v-bind="field">
								<span class="invalid-feedback">{{ errorMessage }}</span>
							</Field>
						</div>
						<!-- Stock -->
						<div class="col-12 mt-2">
							<Field name="stock" v-slot="{ errorMessage, field }" v-model="book.stock">
								<label for="stock">Cantidad</label>
								<input type="number" id="stock" v-model="book.stock"
									:class="`form-control ${errorMessage ? 'is-invalid' : ''}`" v-bind="field">
								<span class="invalid-feedback">{{ errorMessage }}</span>
							</Field>
						</div>

						<!-- Description -->
						<div class="col-12 mt-2">
							<Field name="description" v-slot="{ errorMessage, field }" v-model="book.description">
								<label for="description">Descripcion</label>
								<textarea v-model="book.description"
									:class="`form-control ${errorMessage ? 'is-invalid' : ''}`" id="description" rows="3"
									v-bind="field"></textarea>
								<span class="invalid-feedback">{{ errorMessage }}</span>
							</Field>
						</div>

						<!-- Author -->
						<div class="col-12 mt-2">
							<Field name="author" v-slot="{ errorMessage, field }" v-model="author">
								<label for="author">Autor</label>

								<vue-select :options="authors_data" label="name" v-model="author"
									:reduce="author => author.id" v-bind="field" placeholder="Seleccione autor"
									:clearable="false" :class="`${errorMessage ? 'is-invalid' : ''}`">
								</vue-select>

								<span class="invalid-feedback">{{ errorMessage }}</span>
							</Field>
						</div>

						<!-- Category -->
						<div class="col-12 mt-2" v-if="load_category">
							<Field name="category" v-slot="{ errorMessage, field, valid }" v-model="category">
								<label for="category">Categoria</label>

								<vue-select id="category" :options="categories_data" v-model="category"
									:reduce="category => category.id" v-bind="field" label="name"
									placeholder="Selecciona categoria" :clearable="false"
									:class="`${errorMessage ? 'is-invalid' : ''}`">
								</vue-select>
								<span class="invalid-feedback" v-if="!valid">{{ errorMessage }}</span>

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
			categories_data: []
		}
	},
	props: {
		authors_data: {
			type: Array,
			required: true
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
				description: yup.string(),
				name: yup.string().required(),
				stock: yup.number().required().positive().integer(),
			});
		}
	},
	methods: {
		index() {
			this.getCategories()
		},
		async getCategories() {
			try {
				const { data: { categories } } = await axios('/api/categories')
				this.categories_data = categories
				this.load_category = true
			} catch (error) {
				console.error(error)
				this.load_category = false
			}
		},

		async saveBook() {
			try {

				this.book.category_id = this.category
				this.book.author_id = this.author
				await axios.post('/api/books', this.book)
				await Swal.fire('success', 'Felicidades informacion guardada')
				this.$parent.closeModal()
			} catch (error) {
				console.error(error)

			}
		}
	},
	mounted() {
		this.index()
	},
}
</script>
<style></style>
