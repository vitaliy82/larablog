@extends('layouts.blog')

@section('content')
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <fieldset>
            <legend>Add post:</legend>
            Title:<br>
            <input type="text" name="title" value="{{ old('title') }}" required><br>

            Image:<br>
            <input name="img" type="file" value="{{old('img')}}" required>

            Text:<br>
            @include('components.editor', ['text' => old('text')])
            <br>

            <input type="submit" value="Add">
            @include('components.errors', ['errors' => $errors])
        </fieldset>
    </form>
@endsection
