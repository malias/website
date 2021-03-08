@extends('master')

@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ setting('site.description') }}">
    <meta name="author" content="Eric Hu">
@endsection

@section('title')
    <title>{{$blog['title']}}{{ setting('site.title') }}</title>
@endsection

@section('content')
    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4">{{$blog['title']}}</h1>

            <!-- Author -->
            <p class="lead">
                by
                <a href="#">{{$blog->user['name']}}</a>
            </p>
            <hr>

            <!-- Date/Time -->
            <p>Posted on {{$blog->created_at->format('M d, Y')}}</p>
            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="{{\Illuminate\Support\Facades\Storage::url($blog->featured_image)}}" alt="">
            <hr>

            <!-- Post Content -->
            {!! $blog->content !!}
            <hr>

        </div>
        @include('vendor.sidebar')

    </div>
@endsection