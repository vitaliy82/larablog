@extends('layouts.blog')

@section('content')

    <a href="{{ route('post.create') }}">Create post</a>

    @foreach ($posts as $post)

    <div class="single-recent-blog-post">
        <div class="thumb">
            <img class="img-fluid" src="{{asset('storage/'. $post->img)}}" alt="">
            <ul class="thumb-info">
                <li><a href="#"><i class="ti-user"></i>{{$post->user->name}}</a></li>
                <li><a href="#"><i class="ti-notepad"></i>{{$post->created_at->format('d.m.Y')}}</a></li>
                <li><a href="#"><i class="ti-themify-favicon"></i>{{count($post->comments)}} Comments</a></li>
            </ul>
        </div>
        <div class="details mt-20">
            <a href="{{ route('post.show', $post->id) }}">
                <h3>{{$post->title}}</h3>
            </a>
            <p>{{$post->text}}</p>
            <a class="button" href="{{ route('post.show', $post->id) }}">Read More <i class="ti-arrow-right"></i></a>
        </div>
    </div>

    @endforeach

@endsection
