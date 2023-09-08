<x-app title="home">
    <section class="my-3 text-center">
		<h1>Listado de libros</h1>
	</section>
    <section class="d-flex flex-wrap justify-content-around text-center">
        @foreach ($books as $book)
            <div class="card m-2 card_size">
                <div class="card-header p-2">
                    <h2 class="h5">
                        {{ $book->name }}
                    </h2>
                </div>
                <div class="card-body p-2 text-start">
                    <p>{{ $book->description }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Solicitar</a>
                </div>
            </div>
        @endforeach
    </section>
</x-app>

