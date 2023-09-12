<x-app title="home">
    <section class="my-3 text-center">
        <h1>Listado de libros</h1>
    </section>
    <section class="d-flex flex-wrap justify-content-around text-start align-content-around">
        @foreach ($books as $book)
            <div class="card m-2 my-3 card_size d-flex">
                <img class="card-img-top" src="{{ asset($book->file->route) }}" alt="Image face">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">{{ $book->name }}</h5>
                    <p class="card-text">{{ $book->formatDescription }}</p>
                    <div class="d-flex  flex-wrap my-3">
                        <span class="w-100"><strong>Author:</strong> {{ $book->author->name }}</span>
                        <span><strong>Category:</strong> {{ $book->category->name }}</span>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grip gap-2 text-center">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Solicitar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</x-app>
