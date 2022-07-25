@extends('layout')
@section('content')
<section class="flex justify-center m-4">
    <div class="flex flex-col shadow-lg rounded-lg w-1/2 justify-center">
        <img class=" h-96 object-cover object-center" src="{{ Storage::url($recette->file) }}" alt="image" srcset="">
        <div class="p-4">
            <p>Nom : {{ $recette->name }}</p>
            <p>Cuisson : {{ $recette->cuisson }} minute</p>
            <p>description : {{ $recette->desc }}</p>
            <p>Mise en ligne le : {{ $recette->created_at }}</p>
        </div>
    </div>
</section>

<section class="flex justify-center">
    <form class="shadow-2xl rounded-lg w-1/2 m-4" action="{{ route('recette.commentaire.store', $recette) }}"
        method="post">
        @csrf
        <div class="flex flex-col space-y-4 p-2">
            <label for='name'>Speudo</label>
            <input class="rounded-lg bg-black h-10 px-4 text-white" name="name" id='name' type='text'
                value="{{ Auth::user()->name }}" disabled>
        </div>

        <div class="flex flex-col space-y-2 p-2">
            <label for='content'>Commentaire</label>
            <textarea class="h-32 rounded-lg px-4 border border-black" name="content" id='content'
                type='text'>Votre commentaire</textarea>
        </div>
        
        <input type="hidden" name="recetteId" value="{{ $recette->id }}">

        <div class="flex justify-center bg-red-900">
            <button class=" m-4 bg-white rounded-lg w-32" type="submit">Valider</button>
        </div>
    </form>
</section>
@endsection