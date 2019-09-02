@extends('layouts.blog')

@section('content')
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <fieldset>
            <legend>Add post:</legend>
            Title:<br>
            <input type="text" name="title" required><br>

            Image:<br>
            <input name="img" type="file" required>

            Text:<br>
            <textarea name="text" required></textarea><br>

            <input type="submit" value="Add">

        </fieldset>
    </form>
@endsection
