<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends AuthController
{
    /**
     * Display a listing of the resource.
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function index(Recette $recette)
    {
        $this->verifyAuth();
       
        $commentaires = Commentaire::all()->where('recetteId', '=', $recette->id);
        return view('commentaire.allCommentaireRecipe', compact('commentaires', 'recette'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Recette $recette)
    {
        $this->verifyAuthId($recette);

        $user = $request->user();
        return view('commentaire.addCommentaire', compact('user', 'recette'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->verifyAuth();
        
        // Les règles de validation pour "title" et "content"
        $rules = [
            "content" => 'required|string|max:1024',
        ];
        
        $this->validate($request, $rules);

       
        Commentaire::create([
            'name'=>$request->user()->name,
            'content'=>$request->content,
            'recetteId'=>intval($request->recetteId),
            'userId'=>$request->user()->id,
        ]);

        //dd($test->incrementing);
        return redirect('/')->with('statue', "success!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Commentaire $commentaire)
    {
        dd('test');
        if(Auth::check()) {
            $commentaires = $commentaire->all()->where([
                "userId", "=", Auth::user()->id,
                "recetteId", "=", Auth::user()->id
            ]);
            return view('recette.showRecette', compact('recettes'));
        }
        return redirect(route("login"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentaire $commentaire)
    {
        //
    }
}
