<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        //Carbon::setLocale('ru_RU');
        $date = Carbon::parse($post->created_at);
        $comments = $post->comments()->count();
        $randomPosts = Post::get()->random(3);
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->get()
            ->take(3);
//        dd($comments);
        return view('post.show',
            compact('post', 'date', 'randomPosts', 'relatedPosts'));
    }
}
