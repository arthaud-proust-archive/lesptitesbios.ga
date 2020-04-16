<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use App\User;
use Validator;
use Response;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Register;

class UsersController extends Controller
{
    public function login(Request $request) 
    {
        // vérification que tous les champs soient correctements remplis
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password'=> 'required'
        ]);

        // si un champs ne l'est pas
        if ($validator->fails()) {
            //on retourne l'erreur
            $status = 'error';
            $error = $validator->errors();
            return response()->json(compact('status', 'error'));
        }

        // on recupère le password et l'email
        $credentials = $request->only('name', 'password');
        try {
            // si les identifiants ne correspondent pas 
            if (! $token = JWTAuth::attempt($credentials)) {
                // on retourne l'erreur
                $status = 'error';
                $error = 'Invalid login';
                return response()->json(compact('status','error'));
            }
        } catch (JWTException $e) {
            // S'il est impossible de créer le token
            // on retourne l'erreur
            return response()->json(['error' => 'Impossible de créer un token']);
        }

        $status = 'success';
        $user = User::whereName($request->get('name'))->first();
        // On retourne le status, token, et les info de l'user
        if($user->level == 1) {
            return response()->json(compact('status','token', 'user'));
        } else {
            return response()->json('Not authorized', 403);
        }
    }

    public function store(Request $request) 
    {
        // vérification que tous les champs soient correctements remplis
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:users',
            'password'=> 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}$/',
            'contact'=> 'required'
        ]);

        // si un champs ne l'est pas
        if ($validator->fails()) {
            //on retourne l'erreur
            $status = 'error';
            $error = $validator->errors();
            return response()->json(compact('status', 'error'));
        }

        $status = 'success';

        // Enregistrer l'utilisateur dans la DB 
        $user = User::create([
            'name'  => $request->get('name'),
            'password' => Hash::make($request->get('password')),
            'contact'  => $request->get('contact'),
            'level' => '0'
        ]);
        $token = JWTAuth::fromUser($user);
        
        $user = User::whereName($request->get('name'))->first();

        // Mail::to('arthaud@lesptitesbios.ga')
        //     ->queue(new Register($user));
        // Créer le token pour l'utilisateur ($user)

        // retourne une réponse avec les infos de l'user mais sans le token
        // -> tant qu'il n'est pas validé il ne peut se connecter
        return  response()->json(compact('status','user'));
    }

    public function verifyToken(Request $request)
    {
        try {
            JWTAuth::setToken($request->get('token'));
            if (! $claim = JWTAuth::getPayload()) {
                return response()->json(['Utilisateur introuvable'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['Token expiré'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['Token invalide'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['Token absent'], $e->getStatusCode());

        }

        return response()->json(['Token valide'], 200);
    }
}
