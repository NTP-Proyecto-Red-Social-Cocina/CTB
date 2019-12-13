<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $response = Response::json($posts, 200);
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
        if ((!$request->contenido) || (!$request->titulo) || (!$request->foto) || (!$request->video)
        ) {
            $response = Response::json([
                'message' => 'Campos incompletos'
            ], 422);
            return $response;
        }

        $post = new Post();
        $post->contenido = trim($request->contenido);
        $post->titulo = trim($request->titulo);
        $post->foto = trim($request->foto);
        $post->video = trim($request->video);
        $post->user_id = trim($request->user_id);
        $post->save();

        $message = 'Post Creado Exitosamente';
        $response = Response::json([
            'message' => $message,
            'data' => $post,
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
        $post = Post::find($id);
        if (!$post) {
            return Response::json([
                'error' => [
                    'message' => "Post no existente"
                ]
                ],404);
        }
        return Response::json($post, 200);
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
        if ((!$request->contenido) || (!$request->titulo) || (!$request->foto) || (!$request->video)
        ) {
            $response = Response::json([
                'message' => 'Campos incompletos'
            ], 422);
            return $response;
        }

        $post = Post::find($id);
        if (!$post) {
            return Response::json([
                'error' => [
                    'message' => "Post no existente"
                ]
                ],404);
        }
        $post->contenido = trim($request->contenido);
        $post->titulo = trim($request->titulo);
        $post->foto = trim($request->foto);
        $post->video = trim($request->video);
        $post->user_id = trim($request->user_id);
        $post->save();

        $message = 'Post Actualizado Exitosamente';
        $response = Response::json([
            'message' => $message,
            'data' => $post,
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
        $post = Post::find($id);
        if (!$post) {
            return Response::json([
                'error' => [
                    'message' => "Post no existente"
                ]
                ],404);
        }
        $del = $post->delete();
        return Response::json($del, 200);
    }
}
