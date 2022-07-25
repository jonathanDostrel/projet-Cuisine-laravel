
<nav class=" bg-black text-white p-5">
    <ul class=" flex space-x-5">
        <li><a href="/">home</a></li>
        
        @if (Auth::check())
            <li>
                <li><a href="{{ route('recette.create') }}">Creer une recette</a></li>
                @isset($recette)
                    <li><a href="{{ route('recette.show', $recette) }}">Mes recette</a></li>
                @endisset
                <form action="/logout" method="post">
                    @csrf
                    @method('POST')
                    <button>Logout</button>
                </form>
            </li>
        @else
            <li><a href="/login">login</a></li>
            <li><a href="/register">register</a></li>
        @endif
    </ul>
</nav>
