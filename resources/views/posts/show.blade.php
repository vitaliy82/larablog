@extends('layouts.blog')

@section('content')

    <div class="single-recent-blog-post">
        <div class="thumb">
            <img class="img-fluid" src="{{asset('storage/'. $post->img)}}" alt="">
            <br>
            <span><a href="#">{{$post->user->name}}</a></span>
            <span><a href="#">{{$post->created_at->format('d.m.Y')}}</a></span>
            <span><a href="#">{{count($post->comments)}} Comments</a></span>

        </div>
        <div class="details mt-20">
            <a href="{{ route('post.show', $post->id) }}"><h3>{{$post->title}}</h3></a>
            {!! $post->text !!}

            @include('components.likes', ['e' => $post]) &nbsp;&nbsp;&nbsp;

            @can('update', $post)
                <a href="{{ route('post.edit', $post->id) }}">Edit</a>
            @endcan
            @can('delete', $post)
                <a href="{{ route('post.delete', $post->id) }}">Delete</a>
            @endcan

            @auth
            <form action="{{route('comment.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    @include('components.editor', ['text' => ''])
                    <input type="submit" value="Comment">
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                </fieldset>
            </form>
            @endauth

            @foreach ($post->comments as $comment)
               <div>
                   {!! $comment->text !!}
                   from  {{$comment->post->user->name}}
                   at {{$comment->created_at->format('d.m.Y')}}
               </div>
            @endforeach

        </div>
    </div>

@endsection
