@extends('layouts.blog')

@section('content')

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

            <a href="{{ route('post.show', $post->id) }}"><h3>{{$post->title}}</h3></a>
            <p>{{$post->text}}</p>

            <form action="{{route('comment.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    <textarea name="text" required></textarea><br>
                    <input type="submit" value="Comment">
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                </fieldset>
            </form>

            @include('components.likes', ['e' => $post])

            @can('update', $post)
                <a href="{{ route('post.edit', $post->id) }}">Edit</a>
            @endcan
            @can('delete', $post)
                <a href="{{ route('post.delete', $post->id) }}">Delete</a>
            @endcan

            @foreach ($post->comments as $comment)
               <div>
                   {{  $comment->text }}
                   from  {{$comment->post->user->name}}
                   at {{$comment->created_at->format('d.m.Y')}}
               </div>
            @endforeach

        </div>
    </div>

@endsection
