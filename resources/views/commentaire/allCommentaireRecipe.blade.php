@extends('layout')
@section('content')
<div class="grid grid-cols-3 gap-4 mt-4">
    <section class="">
        <div class="flex flex-col shadow-lg rounded-lg justify-center">
            <img class=" h-96 object-cover object-center" src="{{ Storage::url($recette->file) }}" alt="image" srcset="">
            <div class="p-4">
                <p>Nom : {{ $recette->name }}</p>
                <p>Cuisson : {{ $recette->cuisson }} minute</p>
                <p>description : {{ $recette->desc }}</p>
                <p>Mise en ligne le : {{ $recette->created_at }}</p>
            </div>
        </div>
    </section>

    <section class="flex flex-col justify-center col-span-2">
        @foreach ($commentaires as $commentaire)
    
            <div class="flex space-x-4  p-2">
                <div>
                    <p class=" uppercase font-bold ">name : </p>
                    <p class="pl-4">{{ $commentaire->name }}</p>
                </div>
                <div>
                    <p class=" uppercase font-bold ">content : </p>
                    <p class="pl-4">{{ $commentaire->content }} </p>
                </div>
            </div>
            <div class=" border-b border-red-800 w-full"></div>
            @endforeach
    </section>
</div>

@endsection