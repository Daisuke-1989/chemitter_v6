@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-image">
            <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">
            </figure>
        </div>
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-48x48">
                        <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4">{{ $user->name }}</p>
                        @if ($is_followed)
                            <span class="tag is-light">フォローされています</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="content">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Phasellus nec iaculis mauris. <a>@bulmaio</a>.
            <a href="#">#css</a> <a href="#">#responsive</a>
            <br>
            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
            <ul class="level is-mobile">
                <li class="level-item has-text-centeredr">
                    <div>
                        <p class="heading">Tweets</p>
                        <p class="title">{{ $tweet_count }}</p>
                    </div>
                </li>
                <li class="level-item has-text-centeredr">
                    <div>
                        <p class="heading">Following</p>
                        <p class="title">{{ $follow_count }}</p>
                    </div>
                </li>
                <li class="level-item has-text-centeredr">
                    <div>
                        <p class="heading">Followers</p>
                        <p class="title">{{ $follower_count }}</p>
                    </div>
                </li>
                <li class="level-item">
                    <div>
                        @if ($user->id === Auth::user()->id)
                            <a href="{{ url('users/' .$user->id .'/edit') }}" class="button is-white">Edit</a>
                        @else
                            @if ($is_following)
                                <form action="{{ route('unfollow', [$user->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="button">フォロー解除</button>
                                </form>
                            @else
                                <form action="{{ route('follow', [$user->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="button">フォローする</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
    @if (isset($timelines))
        @foreach ($timelines as $timeline)
            <div class="card">
                <div class="card-image">
                    <figure class="image">
                        <canvas data-idcode="{{ $timeline->idcode }}" width="200" height="250" class="actstruct chemheight"></canvas>
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img src="{{ $user->profile_image }}" class="rounded-circle" width="50" height="50" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4">{{ $timeline->user->name }}</p>
                            <p class="subtitle is-6">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="media-right">
                            @if ($timeline->user->id === Auth::user()->id)
                                <div class="dropdown">
                                    <div class="dropdown-trigger">
                                        <button href="#" role="button" aria-controls="dropdown-menu" class="button is-white" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-fw"></i>
                                        </button>
                                    </div>
                                    <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                        <div class="dropdown-content">
                                            <a href="{{ url('tweets/' .$timeline->id .'/edit') }}" class="dropdown-item">edit</a>
                                            <button type="submit" class="dropdown-item">delete</button>
                                            <form method="POST" action="{{ url('tweets/' .$timeline->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="content">
                    {{ $timeline->text }}
                </div>
                <div class="level is-mobile">
                    <div class="level-item">
                        <a href="#"><i class="far fa-comment fa-fw"></i></a>
                        <p class="subtitle">{{ count($timeline->comments) }}</p>
                    </div>
                    <div class="level-item">
                        <a href="#"><i class="far fa-heart fa-fw"></i></a>
                        <p class="subtitle">{{ count($timeline->favorites) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
<div class="my-4 d-flex justify-content-center">
    {{ $timelines->links() }}
</div>
<script>
window.onload = function() {
  OCL.StructureView.showStructures('actstruct');
};
</script>
@endsection
