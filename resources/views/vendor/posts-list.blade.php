@foreach($blogs as $blog)
    <!-- Blog Post -->
    <div class="card mb-4">
        <img class="card-img-top" src="{{\Illuminate\Support\Facades\Storage::url($blog['featured_image'])}}" alt="Card image cap">
        <div class="card-body">
            <h2 class="card-title">{{$blog['title']}}</h2>
            <p class="card-text">{{\Illuminate\Support\Str::limit(strip_tags($blog['content']), 200, '...')}}</p>
            <a href="/blog/{{$blog['slug']}}" class="btn btn-primary">Read More →</a>
        </div>
        <div class="card-footer text-muted">
            Posted on {{$blog->created_at->format('M d Y')}} by
            <a href="#">{{$blog->user['name']}}</a>
        </div>
    </div>
@endforeach

