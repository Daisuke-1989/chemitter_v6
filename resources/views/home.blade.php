@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="tabs is-centered">
            <ul>
                <li class="is-active"><a href="{{ url('/') }}">All</a></li>
                <li><a>Aromatic</a></li>
                <li><a>Open Editer</a></li>
            </ul>
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
                    {!! nl2br(e($timeline->text)) !!}
                </div>
                <div class="level is-mobile">
                    <div class="level-item">
                        <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                        <p class="subtitle">{{ count($timeline->comments) }}</p>
                    </div>
                    <div class="level-item">
                        @if (!in_array($user->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
                          <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                            @csrf
                            <input type="hidden" name="tweet_id" value="{{ $timeline->id }}">
                            <button type="submit" class="button is-white"><span class="icon is-small has-text-info"><i class="far fa-heart"></i></span></button>
                          </form>
                        @else
                          <form method="POST" action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button is-white"><span class="icon is-small has-text-info"><i class="fas fa-heart"></i></span></button>
                          </form>
                         @endif
                        <p class="subtitle">{{ count($timeline->favorites) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $timelines->links() }}
    </div>
<script>
window.onload = function() {
  OCL.StructureView.showStructures('actstruct');
};
</script>
@endsection
