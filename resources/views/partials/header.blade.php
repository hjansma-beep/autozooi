<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            {{-- <a href="{{ route('blog.index') }}" class="navbar-brand">Laravel Guide</a> --}}
            <ul class="nav navbar-nav">
                
                @if(!Auth::check())
                 <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                {{-- <li><a href="{{ route('admin.index') }}">Posts</a></li> --}}
                <li><a href="{{ route('autozooi.zoek') }}">Artikelen zoeken</a></li>
                <li><a href="{{ route('autozooi.lijst') }}">Factuur maken</a></li>
                 <li><a href="{{ route('autozooi.klanten') }}">Klanten</a></li>
                <li><a href="{{ route('autozooi.facturen') }}">Alle facturen</a></li>
                <li>
                 <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="return logout(event);">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<script type="text/javascript">
    function logout(event){
            event.preventDefault();
            var check = confirm("Wil je echt uitloggen?");
            if(check){ 
               document.getElementById('logout-form').submit();
            }
     }
</script>