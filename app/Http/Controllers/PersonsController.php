<?php

namespace App\Http\Controllers;

use App\Trash;
use App\Persons;
use App\Artworks;
use App\Traits\Logs;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
use Response;

class PersonsController extends Controller
{
    use Logs;

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
            'name' => 'required',
            'slug' => 'required|unique:persons',
            'img' => 'required|mimes:jpeg,png,jpg,gif,svg,webp,jfif|image',
        ]);

        // si un champs ne l'est pas
        if ($validator->fails()) {
            //on retourne l'erreur
            return response()->json($validator->errors()->first(), 400);
        }

        $imageName = $request->get('name').'.'.request()->img->getClientOriginalExtension();
        request()->img->move(public_path('img/persons'), $imageName);

        $user = $this->getUser($request->token);
        // Enregistrer le post dans la DB 
        $person = persons::create([
            'slug'  => $request->get('slug'),
            'name' => $request->get('name'),
            'state' => 'beginned',
            'img' => '/img/persons/'.$imageName,
            'date' => $request->get('date'),
            'bio' => $request->get('bio'),
            'notes' => $request->get('notes'),
            'editor' => $user->name
        ]);
        $this->addLog($request->token, 'Create', 'Person '.$request->slug);

        // retourner le post
        $persons = persons::all();
        return response()->json($persons, 200);
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
            'state' => 'required',
            'img' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,jfif|image',
        ]);

        // si un champs ne l'est pas
        if ($validator->fails()) {
            //on retourne l'erreur
            return response()->json($validator->errors()->first(), 400);
        }
        $user = $this->getUser($request->token);

        


        // Enregistrer le post dans la DB
        $person->name = $request->get('name');
        if($user->level >= 3) {
            $person->state = $request->get('state');
        }
        if($request->img) {
            File::delete(public_path().$person->img);
            $imageName = $request->get('name').'.'.request()->img->getClientOriginalExtension();
            request()->img->move(public_path('img/persons/'), $imageName);
            $person->img = 'img/persons/'.$imageName;
        }
        $person->date = $request->get('date');
        $person->bio = $request->get('bio');
        $person->notes = $request->get('notes');
        $person->editor = $user->name;
        $person->save();
        $this->addLog($request->token, 'Update', 'Person '.$person->slug);

        // retourner le succès et le post
        $persons = persons::all();
        return response()->json($persons);
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
            'notes' => $person->notes,
            'editor' => $person->editor
        ]);

        // Delete le post de la DB
        $person->delete();
        $this->addLog($request->token, 'Place in trash', 'Person '.$request->slug);

        $persons = Persons::all();
        return response()->json($persons);
    }



}
