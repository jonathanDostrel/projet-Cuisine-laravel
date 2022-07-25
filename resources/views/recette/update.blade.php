@extends('layout')
@section('content')

   <section class=" bg-red-800 flex justify-center">
        <form class=" w-1/3 m-4" action="{{ route('recette.update', $recettes->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for='file'>image : </label>
                <input class="rounded-lg h-10 px-4" type='file' name='file' id='file' accept="image/png, image/jpeg">
            </div>
            <div class="flex flex-col space-y-2">
                <label for='name'>Nom de la recette</label>
                <input class="rounded-lg h-10 px-4" name="name" id='name' type='text' value="{{ $recettes->name }}">
            </div>
            <div class="flex flex-col space-y-2">
                <label for='cuisson'>temps de cuisson (minute)</label>
                <input class="rounded-lg h-10 px-4" type='number' name='cuisson' id='cuisson' min="1" step='1' value="{{ $recettes->cuisson }}">
            </div>
            <div class="flex flex-col space-y-2">
                <label for='desc'>Description</label>
                <textarea class="h-32 rounded-lg px-4" name="desc" id='desc' type='text' >{{ $recettes->desc }}</textarea>
            </div>
            
            <div class="flex justify-center">
                <button class="m-4 bg-white rounded-lg w-32" type="submit">Valider</button>
            </div>
        </form>
   </section>
@endsection