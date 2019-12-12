<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Comentario;
class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comentarios = Comentario::all();
        $response = Response::json($comentarios, 200);
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
        if ((!$request->contenido)
        ) {
            $response = Response::json([
                'message' => 'Campo incompleto'
            ], 422);
            return $response;
        }

        $coment = new Comentario();
        $coment->contenido = trim($request->contenido);
        $coment->post_id = trim($request->post_id);
        $coment->user_id = trim($request->user_id);
        $coment->save();

        $message = 'Comentario Creado Exitosamente';
        $response = Response::json([
            'message' => $message,
            'data' => $coment,
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
        $coment = Comentario::find($id);
        if (!$coment) {
            return Response::json([
                'error' => [
                    'message' => "Comentario no existente"
                ]
                ],404);
        }
        return Response::json($coment, 200);
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
        if ((!$request->contenido)
        ) {
            $response = Response::json([
                'message' => 'Campo incompleto'
            ], 422);
            return $response;
        }

        $coment = Comentario::find($id);
        if (!$coment) {
            return Response::json([
                'error' => [
                    'message' => "Comentario no existente"
                ]
                ],404);
        }
        $coment->contenido = trim($request->contenido);
        $coment->post_id = trim($request->post_id);
        $coment->user_id = trim($request->user_id);
        $coment->save();

        $message = 'Comentario Actualizado Exitosamente';
        $response = Response::json([
            'message' => $message,
            'data' => $coment,
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
        $coment = Comentario::find($id);
        if (!$coment) {
            return Response::json([
                'error' => [
                    'message' => "Comentario no existente"
                ]
                ],404);
        }
        $del = $coment->delete();
        return Response::json($del, 200);
    }
}
