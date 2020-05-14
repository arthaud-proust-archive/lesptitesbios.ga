<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use JWTAuth;
use Validator;
use Response;

class LogsController extends Controller
{



    public function index(Request $request)
    {
        if (! $logs = log::all() ) 
        {
            return response()->json('logs introuvables', 403);
        }

        return response()->json($logs, 200);
    }




    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required',
            'user' => 'required',
            'content' => 'required',
        ]);


        // Enregistrer le post dans la DB
        $log = log::create([
            'slug' => $request->action,
            'user' => $request->user,
            'content' => $request->content
        ]);
    }

}

