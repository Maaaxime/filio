<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Auth;
use Illuminate\Http\Request;
use Log;
use Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc');

        if (!Auth::User()->canany(['post.create', 'post.update']))
            $posts = $posts->active();

        $posts = $posts->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.post')
            ->with('post', new Post())
            ->with('methodName', 'POST')
            ->with('actionRoute', 'admin.posts.store')
            ->with('readonly', false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->slug = Str::slug($post->title);
        $post->promoted = $request->has('promoted');
        $post->color = $request->get('color');

        $duplicate = Post::where('slug', $post->slug)->first();
        if ($duplicate) {
            return redirect($request->url)->with('errors', __('message.postAlreadyExistErr'))->withInput();
        }

        $post->user_id = $request->user()->id;
        if ($request->has('draft')) {
            $post->active = 0;
            $message = __('message.postSuccessfullySaved');
        } else {
            $post->active = 1;
            $message = __('message.postSuccessfullyPublished');
        }

        $post->save();

        return redirect($request->url)->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            return back()->with('errors', 'requested page not found');
        }

        return view('posts.post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('admin.posts.post')
            ->with(compact('post'))
            ->with('methodName', 'PATCH')
            ->with('actionRoute', 'admin.posts.update')
            ->with('readonly', false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request)
    {
        $post = Post::find($request->input('post_id'));

        $currSlug = $post->slug;

        $title = $request->input('title');
        $newSlug = Str::slug($title);

        $duplicate = Post::where('slug', $newSlug)->first();
        if ($duplicate) {
            if ($duplicate->id != $post->id) {
                return redirect($request->url)->with('errors', __('message.postAlreadyExistErr'))->withInput();
            }
        }

        $post->title = $title;
        $post->slug = $newSlug;
        $post->body = $request->input('body');
        $post->color = $request->get('color');

        if ($request->has('draft')) {
            $post->active = 0;
            $message = __('message.postSuccessfullySaved');
        } else {
            $post->active = 1;
            $message = __('message.postSuccessfullyPublished');
        }

        $post->save();

        if ($currSlug != $newSlug)
            return redirect()->route('user.posts.show', $newSlug)->with('success', $message);

        return redirect($request->url)->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post_id = $request->input('post_id');
        $post = Post::find($post_id);
        $post->delete();

        return redirect($request->url)
            ->with('success', __('message.successDeleted', ['name' => $post->title]));
    }
}
