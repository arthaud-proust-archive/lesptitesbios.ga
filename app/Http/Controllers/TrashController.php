<?php

namespace App\Http\Controllers;
use App\Trash;
use App\Persons;
use App\Artworks;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
use Response;

class TrashController extends Controller
{


    public function index(Request $request)
    {
        if (! $elements = Trash::all() ) 
        {
            return response()->json('Corbeille vide', 200);
        }

        return response()->json($elements, 200);
    }







    public function show(Request $request, $id)
    {
        if (! $element = Trash::where('id', $id)->first() )
        {
            return response()->json('Id de l\'élément invalide (introuvable)', 404);
        }
        return response()->json($element);
    }





    public function restore(Request $request, $id)
    {

        if (! $element = Trash::where('id', $id)->first() )
        {
            return response()->json('Id de l\'élément invalide (introuvable)',404);
        }

        if ($element->type == "person") {
            // restaurer l'auteur 
            $person = persons::create([
                'slug'  => $element->slug,
                'name' => $element->name,
                'state' => $element->state,
                'img' => $element->img,
                'date' => $element->date,
                'bio' => $element->bio,
                'notes' => $element->notes
            ]);
            $element->delete();

            // retourner le post
            return response()->json(Trash::all(), 200);

        } else if ($element->type == "artwork") {
            // restaurer l'auteur 
            $artwork = artworks::create([
                'slug'  => $element->slug,
                'name' => $element->name,
                'state' => $element->state,
                'date' => $element->date,
                'person'  => $element->person,
                'content' => $element->content,
                'text' => $element->text,
                'notes' => $element->notes
            ]);
            $element->delete();

            // retourner le post
            return response()->json(Trash::all(), 200);

        } else {
            return response()->json($element, 412);
        }     
    }










    public function destroy(Request $request, $id)
    {
    
        if (! $element = Trash::where('id', $id)->first() )
        {
            return response()->json('Id de l\'élément invalide (introuvable)',404);
        }

        if ($element->type == 'person' and $element->img !="/img/persons/default.webp") {
            File::delete(public_path().$element->img);
        }

        // Delete le post de la DB
        $element->delete();
        $elements = Trash::all();
        return response()->json($elements);
    }



}

