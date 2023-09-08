
<x-app title="Users">
    <section class="my-2 text-center">
        <h1>User list</h1>
    </section>
    <section>
        <div class="container">
            <div class="card bg-light">
                <div class="card-header d-flex justify-content-end">
                    <a href={{route('users.create')}} class="btn btn-primary">Create user</a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped table-hover table-light ">
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
											{{$role->name}}
										@endforeach
									</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <a  href="{{route('users.edit', $user)}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pencil"></i></i>
											</a>
											<form action="{{route('users.destroy', $user)}}" method="POST">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i>
												</button>
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
</x-app>
