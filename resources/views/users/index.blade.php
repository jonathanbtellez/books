<x-app title="Users">
    <section class="my-2 text-center">
        <h1>User list</h1>
    </section>
    <section>
        <div class="container">
            <div class="card bg-light">
                <div class="card-header d-flex justify-content-end">
                    <a href={{ route('users.create') }} class="btn btn-primary">Create user</a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped table-hover table-light " id="users_table">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">identification</th>
                                <th scope="col">full name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="align-">
                            @forelse ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->number_id }}</th>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm"><i
                                                    class="fa-solid fa-pencil"></i></i>
                                            </a>
                                            <button class="ms-2 btn btn-danger btn-sm"
                                                onclick="deleteForm({{ $user->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <form id="delete_form_{{ $user->id }}"
                                                action="{{ route('users.destroy', $user) }}"
                                                method="POST" >
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="text-center h-3">There is not users</div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
    {{-- use a second slot --}}
    <x-slot:scripts>
        <script>
            // Wait to document will be ready
            // Execute loadDataTable Function
            document.addEventListener('DOMContentLoaded', loadDataTable)

            // Code to run datatable
            function loadDataTable() {
                $('#users_table').DataTable()
            }

			async function deleteForm(user_id) {
                const response = await Swal.fire({
                    icon: 'warning',
                    title: 'Esta seguro de eliminar?',
                    showCancelButton: true
                })
                if (!response.isConfirmed) return
                document.getElementById(`delete_form_${user_id}`).submit();
            };
        </script>
    </x-slot:scripts>
</x-app>
