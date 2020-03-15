<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="http://vps735670.ovh.net/DAW/MP07/Laravel/VideoClub/public/" style="color:#777"><span style="font-size:15pt">&#9820;</span> Videoclub</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @if( Auth::check() )
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::is('catalog') && ! Request::is('catalog/create')? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/catalog')}}">
                            <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
                            Catálogo
                        </a>
                    </li>
                    <li class="nav-item {{  Request::is('catalog/create') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/catalog/create')}}">
                            <span>&#10010</span> Nueva película
                        </a>
                    </li>
                    <li class="nav-item {{  Request::is('/category') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/category')}}">
                            <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Categorías
                        </a>
                    </li>
                    <li class="nav-item {{  Request::is('/favourites') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/favourites')}}">
                            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Favoritos
                        </a>
                    </li>
                    <li class="nav-item {{  Request::is('/catalog/ranking') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/catalog/ranking')}}">
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Ranking
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav navbar-right">
                    <li>
                        <form action="{{action('CatalogController@search')}}" method="POST" role="search">
                            {{ csrf_field() }}  
                            {{ method_field('POST') }}
                            <div class="input-group mr-3">
                                <input type="text" class="form-control rounded-left" name="qry" id="qry"
                                    placeholder="Buscar película o autor"> <span class="input-group-btn">
                                    <button type="submit" name="search" id="search" class="btn btn-default rounded-right">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer">
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>
