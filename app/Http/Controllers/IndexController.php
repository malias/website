<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        //get the posts that are published, sort by decreasing order of "id".
        $blogs = Blog::query()
            ->where('is_published',true)
            ->orderBy('id','desc')
            ->get();
        
        $blogs = Blog::where('is_published',true)->orderBy('id','desc')->paginate(5);

        //get the featured posts
        $featured_posts = Blog::query()
            ->where('is_published',true)
            ->where('is_featured',true)
            ->orderBy('id','desc')
            ->take(5)
            ->get();

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
        return view('home', [
           // 'website' => $website,
            'blogs' => $blogs,
            'featured_posts' => $featured_posts,
            'categories' => $categories,
            'tags' => $tags,
            'recent_blogs' => $recent_blogs
        ]);
    }
}
