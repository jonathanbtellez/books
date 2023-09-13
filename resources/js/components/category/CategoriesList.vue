<template >
	<div class="container">

		<div class="card bg-light">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-primary" @click="createCategory">Crear categoria</button>
			</div>
			<div class="card-body">
				<div class="card-body table-responsive">
					<table class="table table-bordered table-striped table-hover table-light " id="category_table">
						<thead class="text-center">
							<tr>
								<th>Nombre</th>
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
			<h1>Hola Mundo</h1>
			<!-- <category-modal :category_data="category" /> -->
		</div>
	</div>
</template>
<script>

import {ref, onMounted} from 'vue';

export default {
	// props:[],
	setup(/* props, context*/){ /* Se monta en beforeCreated */

		const load_modal = ref(false)
		const table = ref(null)


		const mountedTable = ()=>{
			table.value = $('#category_table').DataTable()
		}

		const createCategory=()=>{
			load_modal.value = !load_modal.value
		}
		const handleAction=()=>{}

		onMounted(()=>{
			mountedTable()
		})
		return {
			load_modal,
			createCategory,
			handleAction
		}
	}
}
</script>
