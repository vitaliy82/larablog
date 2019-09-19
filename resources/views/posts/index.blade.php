@extends('layouts.blog')

@section('content')

    @can('create', App\Entities\Post::class)
        <a href="{{ route('post.create') }}">Create post</a>
    @endcan

    @foreach ($posts as $post)
        <div class="single-recent-blog-post">
            <div class="thumb">
                <a href="{{ route('post.show', $post->id) }}">
                    <img class="img-fluid" src="{{asset('storage/'. $post->img)}}" alt="">
                </a>
                <ul class="thumb-info">
                    <span><a href="#">{{$post->user->name}}</a></span>
                    <span><a href="#">{{$post->created_at->format('d.m.Y')}}</a></span>
                    <span><a href="#">{{count($post->comments)}} Comments</a></span>
                </ul>
            </div>
            <div class="details mt-20">
                <a href="{{ route('post.show', $post->id) }}">
                    <h3>{{$post->title}}</h3>
                </a>
                <p>{!! Str::words($post->text, 2, '...') !!}</p>
                <a class="button" href="{{ route('post.show', $post->id) }}">Read More <i class="ti-arrow-right"></i></a>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}

@endsection
