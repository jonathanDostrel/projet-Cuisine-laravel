<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function verifyAuth() {
        if(!Auth::check()) {
            return redirect(route("login"));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recette  $recette
     * @return \Illuminate\Http\Response
     */
    public function verifyAuthId(Recette $recette): bool {
        
        if(Auth::user()->id !== intval($recette->userId)) {
            return true;
        }
        return false;
    }
}
