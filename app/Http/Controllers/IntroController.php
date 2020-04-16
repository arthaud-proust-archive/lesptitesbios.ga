<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Intro;
use JWTAuth;
use Validator;
use Response;

class IntroController extends Controller
{



    public function index(Request $request)
    {
        if (! $intro = intro::find(1) ) 
        {
            return response()->json('Intro introuvale', 404);
        }

        return response()->json($intro, 200);
    }




    public function update(Request $request)
    {

        if (! $intro = intro::find(1) )
        {
            return response()->json('Intro introuvable', 404);
        }



        // Enregistrer le post dans la DB
        $intro->content = $request->get('content');
        $intro->save();

        $intro = intro::find(1);
        // retourner le succès et le post
        return response()->json($intro);
    }


}

