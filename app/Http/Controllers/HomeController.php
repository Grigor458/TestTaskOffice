<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Likes;
use App\Models\Posts;
use App\Models\Tags;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function homepage()
    {
        $posts = Posts::withCount('tags', 'comments', 'likes')->get();
        $tags = Tags::all();
        $categories = Category::all();
        return view('index', compact('posts', 'tags', 'categories'));
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

        if ($request->status) {

            Likes::first()->where('user_id', $request->userId)
                ->where('post_id', $request->postId)
                ->delete();
            return 'success deleted';
        } else {

            Likes::updateOrCreate(
                ['user_id' => $request->userId, 'post_id' => $request->postId],
                ['is_liked' => $request->val]
            );
            return 'success created';
        }
        /*
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
                }*/

    }
}
