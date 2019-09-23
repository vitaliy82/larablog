@extends('layouts.blog')

@section('content')
    <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        {{ csrf_field() }}
        <fieldset>
            <legend>Edit post:</legend>
            Title:<br>
            <input type="text" name="title" required  value="{{$post->title}}"><br>
            Image:<br>
            <input name="img" type="file">
            <img src="{{asset('storage/'. $post->img)}}" width="100" height="100"><br>
            Text:<br>
            @include('components.editor', ['text' => $post->text])
            <br>
            <input type="submit" value="Edit">
            @include('components.errors', ['errors' => $errors])
        </fieldset>
    </form>
@endsection
