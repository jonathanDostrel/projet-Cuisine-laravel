@extends('layout')

@section('content')
    

    <section class="flex gap-2 justify-center m-6">
        <a href="{{ route('recette.create') }}" class="p-2 bg-black text-white rounded-md shadow-lg">Ajouter une recette</a>
    </section>

    <section>
        <div class="grid grid-cols-4 gap-4 ">
            @foreach ($recettes as $recette)
                <div class="flex flex-col shadow-lg rounded-lg">
                    <img src="{{ Storage::url($recette->file) }}" alt="image" srcset="">
                    <div class="p-4">
                        <p>Nom : {{ $recette->name }}</p>
                        <p>Cuisson : {{ $recette->cuisson }} minute</p>
                        <p>description : {{ $recette->desc }}</p>
                        <p>Mise en ligne le : {{ $recette->created_at }}</p>
                    </div>
                    @if(isset(Auth::user()->id) && Auth::user()->id === intval($recette->userId))
                        <div class="flex space-x-6  justify-center p-4">
                            <a href="{{ route('recette.edit', $recette->id) }}" class="p-3 bg-black text-white rounded-md shadow-lg">Modifier</a>
                            <form action="{{ route('recette.destroy', $recette->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="p-3 bg-black text-white rounded-md shadow-lg">Supprimer</button>
                            </form>
                            <a href="{{ route('recette.destroy', $recette->id) }}"  class="p-3 bg-black text-white rounded-md shadow-lg">Détaille</a>
                        </div>
                    @endif
                   </div>
            @endforeach
        </div>
    </section>
@endsection