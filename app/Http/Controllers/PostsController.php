<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::pluck('name', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'post_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if ($request->hasFile('post_image')) {

            $filenameWithExt = $request->file('post_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('post_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('post_image')->storeAs('public/posts_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'no_post_image.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->post_image = $fileNameToStore;
        $post->save();

        $post->categories()->sync($request->categories);
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show')->with('post', Post::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if (auth()->user()->id !== $post->user_id)
            return redirect('/posts')->with('error', 'Unauthorized page');

        return view('posts.edit')->with('post', $post)->with('categories', Category::pluck('name', 'id'));
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'post_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if ($request->hasFile('post_image')) {

            $filenameWithExt = $request->file('post_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('post_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('post_image')->storeAs('public/posts_images', $fileNameToStore);
        }

        $post = Post::find($id);
        $post->categories()->sync($request->categories);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->post_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
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

        if (auth()->user()->id !== $post->user_id)
            return redirect('/posts')->with('error', 'Unauthorized page');

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }

    public function addlike(Request $request)
    {
        $post = Post::find($request->post_id);
        $post->likes()->attach($request->user_id);
        $post->save();
        return back()->with('success', 'Like added');
    }

    public function removelike(Request $request)
    {
        $post = Post::find($request->post_id);
        $post->likes()->detach($request->user_id);
        $post->save();
        return back()->with('success', 'Like removed');
    }
}
