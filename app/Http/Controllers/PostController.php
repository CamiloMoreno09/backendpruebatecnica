<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Crea un nuevo post
     */
    public function createPost(Request $request)
    {
      

        // Obtiene el user_id del usuario autenticado
        $user_id = Auth::id(); 
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'user_id' => Auth::id(),
        ]);
        $post->save();

        return response()->json(['message' => 'Post creado exitosamente', 'post' => $post], 201);
    }

    public function searchPosts(Request $request)
    {
        $searchTerm = $request->input('search', ''); // Parámetro 'search' o por defecto vacío
    
        // Consulta de posts que coincidan solo con la categoría
        $posts = \DB::table('vwposts')
    ->where('category', 'like', "%{$searchTerm}%")
    ->get();
    
        // Devuelve los posts encontrados
        return response()->json($posts);
    }
    

    public function getAllPosts()
{
    $posts = \DB::table('vwposts')->get();

    return response()->json($posts);
}
}
