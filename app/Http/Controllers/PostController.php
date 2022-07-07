<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Likes;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Posts::withCount('tags')->where('user_id', Auth::user()->id)->get();
        return view('Posts.index', compact('categories', 'posts'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {

        if ($request->file('postImage')) {
            $imageName = date('YmdHi') . $request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public/images/' . $request->categoryId, $imageName);

            Posts::create([
                'title' => $request->title,
                'category_id' => $request->categoryId,
                'user_id' => $request->user_id,
                'image' => $imageName,
            ]);
        }


        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Posts::withCount('tags', 'comments')->findOrFail($id);

        return view('postShow', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::find($id);
        return view('Posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        dd($request->all());
        //VALIDACIA
        $post = Posts::find($id);

        if ($request->file('image')) {
            //naxord nkar@ jnjvuma, nkar@ pahvuma unique anunov storageum u amen posti id-ov papka
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $imageName);

            $post->update([
                'title' => $request->title,
                'category_id' => $request->categoryId,
                'user_id' => Auth::user()->id,
                'image' => $imageName,
            ]);
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::find($id)->delete();
        return redirect()->back();
    }


    public function getPostByTags($data)
    {
        $posts = Posts::whereHas('tags', function ($query) use ($data) {
            $query->where('title', $data);
        })->get();

        return response()->json($posts);
    }


    public function updatePostsCategory(Request $request)
    {
        $post = Posts::findOrFail($request->postId);
        $post->update([
            'category_id' => $request->categoryId
        ]);
        return 'success';
    }

    public function likeOrDisslike(Request $request)
    {
        /*$post_id = $request->postId;
        $is_like = $request->val === 'true';
        $update = false;
        $post = Posts::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->is_liked;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Likes();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;*/


        $post = Likes::firstOrCreate(
            ['user_id' => $request->userId, 'post_id' => $request->postId, 'is_liked' => $request->val],
            ['user_id' => $request->userId, 'post_id' => $request->postId, 'is_liked' => $request->val]
        );

            if ($post && ($post->is_liked == $request->val)) {
                $post->delete();
                return 'deleted';
            } else {
                Likes::updateOrCreate(
                    ['user_id' => $request->userId, 'post_id' => $request->postId],
                    ['is_liked' => $request->val]
                );
            }
        return 'success';

    }
}
