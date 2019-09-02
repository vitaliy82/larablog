@extends('layouts.blog')

@section('content')
    <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        {{ csrf_field() }}
        <fieldset>
            <legend>Add post:</legend>
            Title:<br>
            <input type="text" name="title" required  value="{{$post->title}}"><br>

            Image:<br>
            <input name="img" type="file">
            <img src="{{asset('storage/'. $post->img)}}" width="100" height="100"><br>

            Text:<br>
            <textarea name="text" required>{{$post->text}}</textarea><br>

            <input type="submit" value="Edit">

        </fieldset>
    </form>
@endsection
