<?php

namespace App\Http\Controllers;

use App\Http\Requests\NombreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::where('user_id', Auth::id())->get();
        return view('posts.index', compact('posts'),['newPost'=> new Post]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //
//       if (Gate::allows('create-post')){
//           return view('posts.create');
//       } ;
//         abort(403);
        //$this->authorize('create-post');
        $posts = Post::where('user_id', Auth::id())->get();
       $this->authorize('create', new Post);

         return view('posts.create', compact('posts'),['newPost'=> new Post]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NombreRequest $request)
    {
        //

        $post = $request->all();
        $post['category'] = join(',', $request->category);
        Post::create($post);

//        $input = $request->input('size');


        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(NombreRequest $request, Post $post)
    {
        //
        $inputs =$request->all();
        $inputs['category'] = join(',', $request->category);

        $post->update($inputs);
        //$post->update( $request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect()->route('posts.index');
    }
}
