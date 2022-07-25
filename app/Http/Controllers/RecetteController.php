<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecetteController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recettes = Recette::all();
        return view('home', compact('recettes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->verifyAuth();

        return view('recette.addRecette');
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
            "file"         => 'required|image|max:1024',
            'name'         => 'required|string|max:255',
            "cuisson"      => 'required|string|max:255',
            "desc"         => 'required|string|max:255',
        ];

        $this->validate($request, $rules);
        
        // 2. On upload l'image dans "/storage/app/public/posts"
        if ($request->has("file")) {

            $firtName =  time() . '_' . $request->file->getClientOriginalName();
    
            $path = $request->file->storeAs(
                $request->user()->name,
                $firtName,
                "public",
            );
        }

        Recette::create([
            'file'=>$path,
            'name'=>$request->name,
            'cuisson'=>$request->cuisson,
            'desc'=>$request->desc,
            'userId'=>$request->user()->id,
        ]);

        //dd($test->incrementing);
        return redirect('/')->with('statue', "success!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function show(Recette $recette)
    {
        
        $this->verifyAuth();

        $recettes = $recette->all()->where("userId", "=", $recette->user()->id);
        return view('recette.showRecette', compact('recettes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function edit(Recette $recette)
    {
        
        if($this->verifyAuthId($recette)) {
            return redirect('/')->with('statue', "oups!! ");
        }

        $recettes = Recette::find($recette->id);
        return view('recette.update', compact('recettes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recette $recette)
    {
        $this->verifyAuth();
        
        $rules = [
            "file"         => 'required|image|max:1024',
            'name'         => 'required|string|max:255',
            "cuisson"      => 'required|string|max:255',
            "desc"         => 'required|string|max:255',
        ];

        $teste = $this->validate($request, $rules);

        $data = Recette::find($recette->id);

        // 2. On upload l'image dans "/storage/app/public/posts"
        if ($request->has("file")) {

            $firtName =  time() . '_' . $request->file->getClientOriginalName();
            $path = $request->file->storeAs(
                $request->user()->name,
                $firtName,
                "public",
            );
            
            Storage::delete($path);
        }

        $data->update([
            'file'=>$path,
            'name'=>$request->name,
            'cuisson'=>$request->cuisson,
            'desc'=>$request->desc,
        ]);

        return redirect(route("recette.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recette $recette)
    {
        $this->verifyAuth();

        $recette->delete();
        return back()->with("success", "recette a été supprimer");
    }
}
