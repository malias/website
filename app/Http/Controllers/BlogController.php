<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show($slug)
    {
        //get the requested post, if it is published
        $blog = Blog::query()
            ->where('is_published', true)
            ->where('slug', $slug)
            ->firstOrFail();

        //get all the categories
        $categories = Category::all();

        //get all the tags
        $tags = Tag::all();

        //get the recent 5 posts
        $recent_blogs = Blog::query()
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        //related posts
        $related_blogs = Blog::query()
        ->where('is_published',true)
        ->whereHas('tags', function ($q) use ($blog) {
            
        return $q->whereIn('name', $blog->tags->pluck('name'));
        })
            ->where('id', '!=', $blog->id)->take(3)->get();                    

        //return the data to the corresponding view
        return view('blog', [
           // 'website' => $website,
            'blog' => $blog,
            'categories' => $categories,
            'tags' => $tags,
            'recent_blogs' => $recent_blogs,
            'related_blogs' => $related_blogs,
        ]);
    }

    public function search(Request $request)
    {
        $key = trim($request->get('q'));

        $blogs = Blog::query()
            ->where('title', 'like', "%{$key}%")
            ->orWhere('content', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->get();

        //get all the categories
        $categories = Category::all();

        //get all the tags
        $tags = Tag::all();

        //get the recent 5 posts
        $recent_blogs = Blog::query()
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        

        return view('search', [
            'key' => $key,
            'blogs' => $blogs,
            'categories' => $categories,
            'tags' => $tags,
            'recent_blogs' => $recent_blogs,
            
        ]);
    }
    
}