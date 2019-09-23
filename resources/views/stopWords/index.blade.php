@extends('layouts.blog')

@section('content')

{{--    @can('create', App\Entities\Post::class)--}}  {{--    @endcan--}}

    <form action="{{route('stop-word.store')}}" method="post">
        {{ csrf_field() }}
        <fieldset>
            <input type="text" name="word" required value="">
            <input type="submit" value="Create">
            @include('components.errors', ['errors' => $errors])
        </fieldset>
    </form>

    @foreach ($stopWords as $word)
        <div class="single-recent-blog-post">
            <div class="thumb">
                <span>{{$word->word}}</span>
                <a href="{{ route('stop-word.edit', $word->id) }}">edit</a>
                <a href="{{ route('stop-word.delete', $word->id) }}">delete</a>
            </div>
        </div>
    @endforeach
{{--    {{ $posts->links() }}--}}

@endsection
