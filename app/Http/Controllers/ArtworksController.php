<?php

namespace App\Http\Controllers;

use App\Trash;
use App\Artworks;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
use Response;

class ArtworksController extends Controller
{



    public function index(Request $request)
    {
        if (! $artworks = Artworks::all() ) 
        {
            return response()->json('Oeuvres introuvables',404);
        }

        return response()->json($artworks);
    }







    public function show(Request $request, $slug)
    {
        if (! $artwork = Artworks::where('slug', $slug)->first() )
        {
            return response()->json('Lien de l\'oeuvre invalide (introuvable)', 404);
        }

        return response()->json($artwork);
    }






    public function store(Request $request)
    {

        // vérification que tous les champs soient correctements remplis
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:artworks'
        ]);

        // si un champs ne l'est pas
        if ($validator->fails()) {
            //on retourne l'erreur
            return response()->json($validator->errors()->first(),400);
        }


        // Enregistrer le post dans la DB 
        $artwork = Artworks::create([
            'slug'  => $request->get('slug'),
            'name' => $request->get('name'),
            'state' => 'beginned',
            'person'  => $request->get('person'),
            'date' => $request->get('date'),
            'content' => $request->get('content'),
            'text' => $request->get('text'),
            'notes' => $request->get('notes')
        ]);

        // retourner le succès et le post
        $artworks = artworks::all();
        return response()->json($artworks);
    }






    public function update(Request $request, $slug)
    {
        
        if (! $artwork = Artworks::where('slug', $slug)->first() )
        {
            return response()->json('Lien de l\'oeuvre invalide (introuvable)',404);
        }
        
        // vérification que tous les champs soient correctements remplis
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'state' => 'required'
        ]);
        
        // si un champs ne l'est pas
        if ($validator->fails()) {
            //on retourne l'erreur
            return response()->json($validator->errors()->first(),400);
        }
            
        $user = JWTAuth::toUser($request->token);

        // Enregistrer le post dans la DB
        $artwork->name = $request->get('name');
        if($user->level >= 3) {
            $artwork->state = $request->get('state');
        }
        $artwork->person = $request->get('person');
        $artwork->date = $request->get('date');
        $artwork->content = $request->get('content');
        $artwork->text = $request->get('text');
        $artwork->notes = $request->get('notes');
        $artwork->save();

        // retourner le succès et le post
        $artworks = artworks::all();
        return response()->json($artworks);
    }







    public function destroy(Request $request, $slug)
    {
    
        if (! $artwork = Artworks::where('slug', $slug)->first() )
        {
            return response()->json('Lien de l\'oeuvre invalide (introuvable)',404);
        }

        // ajoute à la poubelle l'élément
        $trash = Trash::create([
            'type'  => 'artwork',
            'slug'  => $artwork->slug,
            'name' => $artwork->name,
            'state' => $artwork->state,
            'date' => $artwork->date,
            'person'  => $artwork->person,
            'content' => $artwork->content,
            'text' => $artwork->text,
            'notes' => $artwork->notes
        ]);

        // Delete le post de la DB
        $artwork->delete();
        $artworks = Artworks::all();
        // $artworks = Artworks::where("person", $artwork->person)->get();
        return response()->json($artworks);
    }


    public function get(Request $request, $slug) {
        $artwork = Artworks::where('slug', $slug)->first();

        $artworks = Artworks::where("person", $artwork->person)->get();
        return response()->json($artworks);
    }


}
