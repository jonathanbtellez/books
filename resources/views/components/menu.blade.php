{{-- Menu --}}
<nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ env('APP_NAME') }}</a>

        {{-- Haburguesa --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse bg-light" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registro</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown bg-light">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle bg-light" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end bg-light" aria-labelledby="navbarDropdown">

                            @role('admin')
                                {{-- users --}}
                                <a class="dropdown-item bg-light" href="{{ route('users.index') }}">Users
                                </a>
                            @endrole
                            @can('books.index')
                                {{-- Books --}}
                                <a class="dropdown-item bg-light" href="{{ route('books.index') }}">Books
                                </a>
                            @endcan
                            @can('categories.index')
								{{-- Category --}}
                                <a class="dropdown-item bg-light" href="{{ route('categories.index') }}">Categories
                                </a>
                            @endcan
							@can('authors.index')
							{{-- Category --}}
							<a class="dropdown-item bg-light" href="{{ route('authors.index') }}">Authors
							</a>
						@endcan
                            <a type="submit" class="dropdown-item bg-light" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                {{-- Logout --}}
                            </form>
                        </div>

                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
