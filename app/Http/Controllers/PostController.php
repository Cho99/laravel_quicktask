<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withCount('posts')->get();

        return view('home', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id)->load('posts');

        return view('posts.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post;
        $result = $post->create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);
        if ($result) {
            return redirect()->route('posts.create')->with('mess',
                trans('message.post_create_success'));
        }

        return redirect()->route('posts.create')->with('mess',
            trans('message.poss_create_fail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $result = $post->update([
            'name' => $request->name,
        ]);
        if ($result) {
            return redirect()->route('posts.show', Auth::id())->with('mess',
                trans('message.post_edit_success'));
        }

        return redirect()->back()->with('mess',
            trans('message.post_edit_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $result = $post->delete();
        if ($result) {
            return redirect()->route('posts.show', Auth::id())->with('mess',
                trans('message.post_delete_success'));
        }

        return redirect()->back()->with('mess',
            trans('message.post_delete_fail'));
    }
}
