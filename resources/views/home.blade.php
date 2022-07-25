@extends('layout')

@section('content')


<section class="flex gap-2 justify-center m-6 ">
    <a href="{{ route('recette.create') }}" class="p-2 bg-red-900 text-white rounded-md shadow-lg w-1/3 text-center">Ajouter une recette</a>
</section>

<section>
    <div class="grid grid-cols-4 gap-4 ">
        
        @foreach ($recettes as $recette)

        <div class="flex flex-col shadow-lg rounded-lg">

            <img class=" h-96 object-cover object-center" src="{{ Storage::url($recette->file) }}" alt="image" srcset="">
            <div class="p-2 text-center">
                <p>Nom : {{ $recette->name }}</p>
                <p>Cuisson : {{ $recette->cuisson }} minute</p>
                <p>description : {{ $recette->desc }}</p>
                <p>Mise en ligne le : {{ $recette->created_at }}</p>
            </div>

            @if(isset(Auth::user()->id) && Auth::user()->id === intval($recette->userId))
                <div class="w-full flex justify-center">
                    <div class="w-full flex justify-center p-2">
                        <a href="{{ route('recette.edit', $recette->id) }}"
                            class="text-center p-2 bg-black text-white rounded-md shadow-lg w-full">Modifier</a>
                    </div>
                    <form class="w-full flex justify-center p-2" action="{{ route('recette.destroy', $recette->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="p-2 bg-black text-white rounded-md shadow-lg w-full">Supprimer</button>
                    </form>
                </div>
            @endif
            @if (Auth::check())
                <div class="w-full flex justify-center p-2">
                    <a href="{{ route('recette.commentaire.create', $recette) }}"
                    class=" text-center p-2 bg-black text-white rounded-md shadow-lg w-full">creer commentaire</a>
                </div>
                <div class="w-full flex justify-center p-2">
                    <a href="{{ route('recette.commentaire.index', $recette) }}"
                    class="text-center p-2 bg-black text-white rounded-md shadow-lg w-full">commentaire</a>
                </div>
            @endif
        </div>
        @endforeach
    </div>
</section>
@endsection