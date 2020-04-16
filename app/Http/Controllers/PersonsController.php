<?php

namespace App\Http\Controllers;

use App\Trash;
use App\Persons;
use App\Artworks;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
use Response;

class PersonsController extends Controller
{



    public function index(Request $request)
    {
        if (! $persons = persons::all() ) 
        {
            return response()->json('Lien de l\'auteur invalide (introuvable)', 404);
        }

        return response()->json($persons, 200);
    }







    public function show(Request $request, $slug)
    {
        if (! $person = persons::where('slug', $slug)->first() )
        {
            if (! $person = persons::where('name', $slug)->first() )
            {
                return response()->json('Lien de l\'auteur invalide (introuvable)', 404);
            }
        }
        return response()->json($person);
    }



    public function artworks(Request $request, $slug)
    {
        if (! $person = persons::where('slug', $slug)->first() )
        {
            return response()->json('Lien de l\'auteur invalide (introuvable)', 404);
        }

        if (! $artworks = Artworks::where('person', $person->name)->get() ) 
        {
            return response()->json('Oeuvres introuvables', 200);
        }

        return response()->json($artworks);
    }





    public function store(Request $request)
    {

        // vérification que tous les champs soient correctements remplis
        $validator = Validator::make($request->all(), [
            'slug' => 'required',
            'name' => 'required',
            'state' => 'required',
        ]);

        // si un champs ne l'est pas
        if ($validator->fails()) {
            //on retourne l'erreur
            return response()->json($validator->errors(), 400);
        }


        // Enregistrer le post dans la DB 
        $person = persons::create([
            'slug'  => $request->get('slug'),
            'name' => $request->get('name'),
            'state' => $request->get('state'),
            'img' => $request->get('img'),
            'date' => $request->get('date'),
            'bio' => $request->get('bio'),
            'notes' => $request->get('notes')
        ]);

        // retourner le post
        return response()->json($person, 200);
    }






    public function update(Request $request, $slug)
    {

        if (! $person = persons::where('slug', $slug)->first() )
        {
            return response()->json('Lien de l\'auteur invalide (introuvable)', 404);
        }

        // vérification que tous les champs soient correctements remplis
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'state' => 'required'
        ]);

        // si un champs ne l'est pas
        if ($validator->fails()) {
            //on retourne l'erreur
            return response()->json($validator->errors(), 400);
        }


        // Enregistrer le post dans la DB
        $person->name = $request->get('name');
        $person->state = $request->get('state');
        $person->img = $request->get('img');
        $person->date = $request->get('date');
        $person->bio = $request->get('bio');
        $person->notes = $request->get('notes');
        $person->save();

        $person = persons::where('slug', $slug)->first();
        // retourner le succès et le post
        return response()->json($person);
    }







    public function destroy(Request $request, $slug)
    {
    
        if (! $person = persons::where('slug', $slug)->first() )
        {
            return response()->json('Lien de l\'auteur invalide (introuvable)',404);
        }

        // mets l'élément dans la poubelle
        $trash = Trash::create([
            'type'  => 'person',
            'slug'  => $person->slug,
            'name' => $person->name,
            'state' => $person->state,
            'img' => $person->img,
            'date' => $person->date,
            'bio' => $person->bio,
            'notes' => $person->notes
        ]);

        // Delete le post de la DB
        $person->delete();
        $persons = Persons::all();
        return response()->json($persons);
    }



}
