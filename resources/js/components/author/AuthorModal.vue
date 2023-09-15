<template>
	<div class="modal fade" id="author_modal" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ is_create ? 'Crear' : 'Editar' }} Author</h5>
					<button type="button" class="btn-close" @click="closeModal" aria-label="Close">
					</button>
				</div>

				<!-- Backend Errors -->
				<backend-error :errors="back_errors" />

				<!-- Form -->
				<Form @submit="saveCategory" :validation-schema="schema">
					<div class="modal-body row">

						<!-- Name -->
						<div class="col-12">
							<label for="name">Nombre</label>
							<Field name="name" v-model="author.name" v-slot="{ errorMessage, field }" >
								<input :class="`form-control ${errorMessage || back_errors['name'] ? 'is-invalid' : ''}`"
									id="name" v-bind="field" />
								<span class="invalid-feedback">{{ errorMessage }}</span>
								<span class="invalid-feedback">{{ back_errors['name'] }}</span>
							</Field>
							<div class="col-12">
								<label for="biography">Biography</label>
								<Field name="biography" v-model="author.biography" v-slot="{ errorMessage, field }">
									<input
										:class="`form-control ${errorMessage || back_errors['biography'] ? 'is-invalid' : ''}`"
										id="biography" v-bind="field" />
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['biography'] }}</span>
								</Field>
							</div>
						</div>
					</div>

					<!-- Buttons -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" @click="closeModal">Cancelar</button>
						<button type="submit" class="btn btn-primary">Almacenar</button>
					</div>
				</Form>
			</div>
		</div>

	</div>
</template>

<script>
import { handlerErrors, successMessage } from '@/helpers/Alerts.js'
import { ref, getCurrentInstance, computed } from 'vue'
import { Field, Form } from 'vee-validate'
import * as yup from 'yup';
import BackendError from '../Components/BackendError.vue';

export default {
	props: ['author_data'],
	components: { Field, Form, BackendError },
	setup({ author_data }) {
		const instance = getCurrentInstance();
		const is_create = author_data ? ref(false) : ref(true)
		const author = !is_create.value ? ref(author_data) : ref({})
		const back_errors = ref ({});
		const closeModal = () => instance.parent.ctx.closeModal()

		const saveCategory = async () => {
			try {
				if (is_create.value) {
					await axios.post('/authors/store', author.value)
				} else {
					await axios.put(`/authors/${author.value.id}`, author.value)
				}
				successMessage({ is_delete: false, reload: false }).then(() => succesRespose())
			} catch (error) {
				back_errors.value = await handlerErrors(error)
			}
		}

		const succesRespose = () => {
			instance.parent.ctx.reloadState()
			closeModal()
		}

		// Validate
		const schema = computed(() => {
			return yup.object({
				name: yup.string().required('El nombre es requerido'),
				biography: yup.string().required('La biografia es requerida')
			})
		})

		// Retorno de data
		return {
			schema,
			author,
			is_create,
			back_errors,
			closeModal,
			saveCategory,
		}
	}

}
</script>

