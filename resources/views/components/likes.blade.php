<div>
    @if($e->userLike())
        <a href="{{ route('like.set', $e->id) }}">unlike </a>
    @else
        <a href="{{ route('like.set', $e->id) }}">like </a>
    @endif
    Total:  {{count($e->likes)}}
</div>
