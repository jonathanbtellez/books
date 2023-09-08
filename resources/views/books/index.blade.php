<x-app title="Books">
    <section class="my-2 text-center">
        <h1>Books list</h1>
    </section>
    <books-list :books="{{$books}}" :authors="{{$authors}}"/>
</x-app>
