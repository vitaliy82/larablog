@extends('layouts.blog')

@section('content')
    <form action="{{route('stop-word.update', $stopWord->id)}}" method="post">
        @method('PUT')
        {{ csrf_field() }}
        <fieldset>
            <input type="text" name="word" required value="{{$stopWord->word}}">
            <input type="submit" value="Edit">
            @include('components.errors', ['errors' => $errors])
        </fieldset>
    </form>
@endsection
