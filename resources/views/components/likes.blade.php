<div>
    @auth
        @if($e->userLike())
            <a href="{{ route('like.delete', $e->id) }}">unlike</a>
        @else
            <a href="{{ route('like.create', $e->id) }}">like</a>
        @endif
    @endauth
    Total @guest likes @endguest: {{count($e->likes)}}
</div>
