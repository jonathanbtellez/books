<template>
	<section>
		<div class="container">
			<div class="card bg-light">
				<div class="card-header d-flex justify-content-end">
					<button class="btn btn-primary" @click="openModal">Create user</button>
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
						<tbody class="align-">
							<tr v-for="{ author, category, name, stock, id } in books" :key="id">
								<th>{{ name }}</th>
								<td>{{ author.name }}</td>
								<td>{{ category.name }}</td>
								<td>
									{{ stock }}
								</td>
								<td>
									<div class="d-flex justify-content-around">
										<a href="#" class="btn btn-warning btn-sm"><i class="fa-solid fa-pencil"></i>
										</a>
										<form action="#" method="POST">
											<button type="submit" class="btn btn-danger btn-sm"><i
													class="fa-solid fa-trash-can"></i>
											</button>
										</form>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div>
				<book-modal :authors_data="authors" />
			</div>
		</div>
	</section>
</template>
<script>
import BookModal from './BookModal.vue'
export default {
	name: 'Books',
	components: {
		BookModal
	},
	date() {
		return {
			modal: null,
			book: null
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
				// this.$refs.book_modal.reset()
				// console.log(this.$refs.model_id);
			})
		},

		openModal() {
			this.modal.show()
		},

		closeModal() {
			this.modal.hide()
		}
	},

	mounted() {
		this.index()
	},
}
</script>
<style></style>
