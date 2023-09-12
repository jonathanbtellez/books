<template>
	<section>
		<div class="container">
			<div class="card bg-light">
				<div class="card-header d-flex justify-content-end">
					<button class="btn btn-primary" @click="openModal">Create book</button>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-bordered table-striped table-hover table-light " id="book_table">
						<thead class="text-center">
							<tr>
								<th>Title</th>
								<th>Author</th>
								<th>Category</th>
								<th>Quantity</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody class="align-items-center">
							<tr v-for="({ author, category, name, stock, id }) in books" :key="id">
								<th>{{ name }}</th>
								<td>{{ author.name }}</td>
								<td>{{ category.name }}</td>
								<td>
									{{ stock }}
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<button type="button" @click="editBook(id)" class="btn btn-warning btn-sm"
											title="edit"><i class="fa-solid fa-pencil"></i>
										</button>
										<button type="button" @click="deleteBook(id)" class="btn btn-danger btn-sm"
											title="delete"><i class="fa-solid fa-trash-can"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div>
				<book-modal :authors_data="authors" :book_data="book" ref="book_modal" />
			</div>
		</div>
	</section>
</template>
<script>
import BookModal from './BookModal.vue'
import { successMessage, deleteMessage } from '@/helpers/Alerts'

export default {
	name: 'Books',
	components: {
		BookModal
	},
	data() {
		return {
			modal: null,
			book: null,
			books_data: null
		}
	},
	props: {
		books: {
			type: Array,
			required: true
		},
		authors: {
			type: Array,
			required: true
		}
	},

	methods: {
		async index() {
			$('#book_table').DataTable()
			const modal_id = document.querySelector('#book_modal');
			this.modal = new bootstrap.Modal(modal_id)

			modal_id.addEventListener('hidden.bs.modal', e => {
				// Create bind with a children using ref
				// call method reset of children from parent
				this.$refs.book_modal.reset()
				// console.log(this.$refs.model_id);
			})
		},

		openModal() {
			this.modal.show()
		},

		async editBook(id) {
			this.book = this.books.find(book => book.id === id);
			this.openModal()
		},

		async deleteBook(id) {
			if (!await deleteMessage()) return
			try {
				await axios.delete(`/books/${id}`)
				await successMessage({ is_delete: true, reload: true })
			} catch (error) {
				console.log(error);
			}
		},
	},

	mounted() {
		this.index()
	},
}
</script>
