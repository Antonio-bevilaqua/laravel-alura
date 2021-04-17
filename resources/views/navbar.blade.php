<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/series">Minhas Séries</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('series') }}">Séries</a>
          </li>
          
        </ul>
        <div class="d-flex nav-item dropdown">
            @auth('usuario')
            <a class="nav-link dropdown-toggle" href="#" style="min-width:160px;" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Olá {{ Auth::guard('usuario')->user()->name }}!
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <form action="{{ route('autenticacao.logout') }}" method="post">
                @csrf
                <li><button class="dropdown-item" >Logout</button></li>
              </form>
            </ul>
            @endauth
            @guest('usuario')
            <a class="nav-link" href="{{ route('autenticacao.login') }}">
                Fazer Login
            </a>
            @endguest
        </div>
      </div>
    </div>
  </nav>