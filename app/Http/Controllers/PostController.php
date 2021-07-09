<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth'])->only(['store', 'destroy']);
    // }

    public function index()
    {
        $posts = Post::latest()->with(['user'])->paginate(3);

        return view(
            'posts.index',
            [
                'posts' => $posts
            ]
        );
    }

    // public function show(Post $post)
    // {
    //     return view('posts.show', [
    //         'post' => $post
    //     ]);
    // }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back();
    }

    public function destroy(Post $post)
    {
        // $this->authorize('delete', $post);

        $post->delete();

        return back();
    }

    // function update($body)
    // {
    //     $data = Post::find($body);
    //     return view(
    //         'posts.edite',
    //         [
    //             'data' => $data
    //         ]
    //     );
    // }

    // function UPD(Request $req)
    // {
    //     $data = Post::find($req->body);
    //     $data->save();
    //     return redirect('dashboard');
    // }

    public function edite(Post $post)
    {

        return view('posts.edite', ['post' => $post]);
    }

    public function update(Post $post)
    {
        request()->validate([
            'content' => 'required',
        ]);

        $post->update([
            'body' => request('content'),
        ]);

        return redirect('/posts');
    }
}
