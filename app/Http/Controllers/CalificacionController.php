<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Calificacion;
class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calificacions = Calificacion::all();
        $response = Response::json($calificacions, 200);
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
        if ((!$request->nota)
        ) {
            $response = Response::json([
                'message' => 'Campo incompleto'
            ], 422);
            return $response;
        }

        $calif = new Calificacion();
        $calif->nota = trim($request->nota);
        $calif->post_id = trim($request->post_id);
        $calif->user_id = trim($request->user_id);
        $calif->save();

        $message = 'Calificacion Creada Exitosamente';
        $response = Response::json([
            'message' => $message,
            'data' => $calif,
        ], 201);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$post_id)
    {
        $calif = Calificacion::where('post_id', '=', $post_id)
        ->where('user_id', '=', $user_id);
        if (!$calif) {
            return Response::json([
                'error' => [
                    'message' => "Calificacion no existente"
                ]
                ],404);
        }
        return Response::json($calif, 200);
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
    public function update(Request $request, $post_id, $user_id)
    {
        if ((!$request->nota)
        ) {
            $response = Response::json([
                'message' => 'Campo incompleto'
            ], 422);
            return $response;
        }

        $calif = Calificacion::where('post_id', '=', $post_id)
        ->where('user_id', '=', $user_id);
        if (!$calif) {
            return Response::json([
                'error' => [
                    'message' => "Calificacion no existente"
                ]
                ],404);
        }
        $calif->nota = trim($request->nota);
        $calif->save();

        $message = 'Calificacion Actualizada Exitosamente';
        $response = Response::json([
            'message' => $message,
            'data' => $calif,
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
        $calif = Calificacion::find($id);
        if (!$calif) {
            return Response::json([
                'error' => [
                    'message' => "Calificacion no existente"
                ]
                ],404);
        }
        $del = $calif->delete();
        return Response::json($del, 200);
    }
}
