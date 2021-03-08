<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __invoke($slug)
    {
        //get the requested tag
        $tag = Tag::query()
            ->where('slug', $slug)
            ->firstOrFail();

        //get the posts with that tag
        $blogs = $tag->blogs()
            ->where('is_published',true)
            ->orderBy('id','desc')
            ->get();
            $blogs = Blog::where('is_published',true)->orderBy('id','desc')->paginate(5);

        //get all the categories
        $categories = Category::all();

        //get all the tags
        $tags = Tag::all();

        //get the recent 5 posts
        $recent_blogs = Blog::query()
            ->where('is_published',true)
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();

        //return the data to the corresponding view
        return view('tag', [
            //'website' => $website,
            'tag' => $tag,
            'blogs' => $blogs,
            'categories' => $categories,
            'tags' => $tags,
            'recent_blogs' => $recent_blogs
        ]);
    }
}
