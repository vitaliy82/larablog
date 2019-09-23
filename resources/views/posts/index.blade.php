@extends('layouts.blog')

@section('content')
    @foreach ($posts as $post)
        <div class="single-recent-blog-post">
            <a href="{{ route('post.show', $post->id) }}">
                <h3>{{$post->title}}</h3>
            </a>
            <div class="thumb">
                <a href="{{ route('post.show', $post->id) }}">
                    <img class="img-fluid" src="{{asset('storage/'. $post->img)}}" alt="">
                </a>
                <div class="details mt-20">
                    <p>
                        {!! Str::words($post->text, 2, '...') !!}
                        <a class="button" href="{{ route('post.show', $post->id) }}">Read More <i class="ti-arrow-right"></i></a>
                    </p>
                </div>
                <div>
                    <span><a href="#">{{count($post->comments)}} Comments</a></span>&nbsp;&nbsp;
                    <span><a href="#">{{$post->created_at->format('d.m.Y')}}</a></span>&nbsp;&nbsp;
                    <span><a href="#">{{$post->user->name}}</a></span>&nbsp;&nbsp;
                </div>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}
@endsection
