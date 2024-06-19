<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        $users = User::all()->count();
        $categories = Category::all()->count();
        $tags = Tag::all()->count();
        $posts = Post::all()->count();
        return view('admin.main.index',
            compact('users', 'tags', 'categories', 'posts'));
    }
}
