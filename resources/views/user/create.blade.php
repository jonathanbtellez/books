<x-app title="create">
	<section class="text-center">
		<h1 class="m-0">Create user</h1>
	</section>
    <section class="my-3 d-flex justify-content-center text-center">
        <div class="card bg-light row col-md-8">
            <div class="card-header d-flex justify-content-end">
                <a href={{ route('user.index') }} class="btn btn-secondary">Regresar</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.store') }}" novalidate>
                    @csrf
                    <x-users.form>Create</x-users.form>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app>
