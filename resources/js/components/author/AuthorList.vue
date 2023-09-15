<template>
	<div class="card  bg-light container">
		<div class="card-header d-flex justify-content-end">
			<button class="btn btn-primary" @click="createAuthor">Crear autor</button>
		</div>
		<div class="card-body">
			<div class="table-responsive my-4 mx-2">
				<table class="table table-bordered table-light table-striped" id="author_table">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Biography</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody @click="handleAction">
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div v-if="load_modal">
		<author-modal :author_data="author" />
	</div>
</template>

<script>
import { handlerErrors, successMessage, deleteMessage } from '@/helpers/Alerts.js'
import HandlerModal from '@/helpers/HandlerModal.js'
import AuthorModal from './AuthorModal.vue'
import { ref, onMounted } from 'vue'
export default {
	components: { AuthorModal },
	/*
	* Setup se lanza en beforeCreated
	*/
	setup(/* props, context*/) {
		const author = ref(null)
		const table = ref(null)
		const { openModal, closeModal, load_modal } = HandlerModal()

		onMounted(() => index());
		const index = () => mountedTable()

		const mountedTable = () => {
			table.value = $('#author_table').DataTable({
				destroy: true,
				processing: true,
				serverSide: true,
				scrollX: true,
				order: [[0, 'asc']],
				autoWidth: false,
				dom: 'Bfrtip',
				buttons: ['pageLength', 'excel', 'pdf', 'copy'],
				ajax: `/authors/get-all-dt`,
				columns: [
					{ data: 'name', name: 'name', orderable: true, searchable: true },
					{ data: 'format_biography', name: 'biography', orderable: false, searchable: false },
					{
						name: 'action',
						orderable: false,
						searchable: false,
						render: (data, type, row, meta) => {
							return `<div class="d-flex justify-content-center" data-role='actions'>
		            <button onclick='event.preventDefault();' data-id='${row.id}' role='edit' class="btn btn-warning btn-sm">
		              <i class='fas fa-pencil-alt' data-id='${row.id}' role='edit'></i>
								</button>
		            <button onclick='event.preventDefault();' data-id='${row.id}' role='delete' class="btn btn-danger btn-sm ms-1">
		            	<i class='fas fa-trash-alt' data-id='${row.id}' role='delete'></i>
								</button>
		          </div>`
						}
					}
				]
			})
		}

		const handleAction = (event) => {
			const button = event.target
			const author_id = button.getAttribute('data-id')
			if (button.getAttribute('role') == 'edit') {
				editAuthor(author_id)
			} else if (button.getAttribute('role') == 'delete') {
				deleteAuthor(author_id)
			}
		}

		const editAuthor = async (id) => {
			try {
				const { data } = await axios.get(`/authors/${id}`)
				author.value = data.author
				await openModal('author_modal')
			} catch (error) {
				await handlerErrors(error)
			}
		}

		const createAuthor = async () => {
			author.value = null
			await openModal('author_modal')
		}

		const deleteAuthor = async (id) => {
			if (!await deleteMessage()) return
			try {
				await axios.delete(`/authors/${id}`)
				await successMessage({ is_delete: true })
				reloadState()
			} catch (error) {
				await handlerErrors(error)
			}
		}

		const reloadState = () => {
			table.value.destroy()
			index()
		}

		// index()
		return {
			author,
			load_modal,
			editAuthor,
			deleteAuthor,
			createAuthor,
			closeModal,
			reloadState,
			handleAction
		}
	}
}
</script>
