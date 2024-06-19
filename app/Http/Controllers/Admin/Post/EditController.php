<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class EditController extends BaseController
{
    public function __invoke(Post $post)
    {
        $category = Category::all();
        $tags = Tag::all();
//        dd($post->tags->pluck('id'));
        return view('admin.post.edit', compact('category', 'post', 'tags'));

    }
}
