<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        $response = Response::json($usuarios, 200);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ((!$request->name) || (!$request->email) || (!$request->nombre) || (!$request->sexo) || (!$request->telefono) || (!$request->password) || (!$request->fecha_nacimiento) || (!$request->foto)
        ) {
            $response = Response::json([
                'message' => 'Campos incompletos'
            ], 422);
            return $response;
        }

        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->nombre = trim($request->nombre);
        $user->sexo = trim($request->sexo);
        $user->telefono = trim($request->telefono);
        $user->password = trim($request->password);
        $user->fecha_nacimiento = trim($request->fecha_nacimiento);
        $user->foto = trim($request->foto);
        $user->save();

        $message = 'Usuario Creado Exitosamente';
        $response = Response::json([
            'message' => $message,
            'data' => $user,
        ], 201);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            return Response::json([
                'error' => [
                    'message' => "Usuario no existente"
                ]
                ],404);
        }
        return Response::json($usuario, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ((!$request->name) || (!$request->email) || (!$request->nombre) || (!$request->sexo) || (!$request->telefono) || (!$request->password) || (!$request->fecha_nacimiento) || (!$request->foto)
        ) {
            $response = Response::json([
                'message' => 'Campos incompletos'
            ], 422);
            return $response;
        }

        $user = User::find($id);
        if (!$user) {
            return Response::json([
                'error' => [
                    'message' => "Usuario no existente"
                ]
                ],404);
        }

        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->nombre = trim($request->nombre);
        $user->sexo = trim($request->sexo);
        $user->telefono = trim($request->telefono);
        $user->password = trim($request->password);
        $user->fecha_nacimiento = trim($request->fecha_nacimiento);
        $user->foto = trim($request->foto);
        $user->save();

        $message = 'Usuario Actualizado Exitosamente';
        $response = Response::json([
            'message' => $message,
            'data' => $user,
        ], 201);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            return Response::json([
                'error' => [
                    'message' => "Usuario no existente"
                ]
                ],404);
        }
        $del = $usuario->delete();
        return Response::json($del, 200);
    }
}
