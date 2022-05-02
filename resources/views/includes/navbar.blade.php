<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand text-dark" href="#">
            {{-- {{ __('Relax') }} --}}
            <span class="navbar-toggler-icon ms-2"></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown d-flex align-items-center">
                    <a class="nav-link dropdown-toggle" href="#" id="navbar-base" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('lang') }} <i class="uil-angle-down lh-1 fs-5"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbar-base">
                        <a class="dropdown-item" href="{{ route('lang', 'en') }}">English</a>
                        <a class="dropdown-item" href="{{ route('lang', 'ar') }}">Arabic</a>
                    </div>
                </li>
                <li class="nav-item dropdown d-flex align-items-center">
                    <img class="rounded-pill" src="{{ Auth::user()->image }}" height="28" />
                    <a class="nav-link dropdown-toggle" href="#" id="navbar-base" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="name-person">
                            {{ Auth::user()->name }}
                        </span>
                        <i class="uil uil-angle-down lh-1 fs-5 position-relative" style="top: 1px"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbar-base">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>