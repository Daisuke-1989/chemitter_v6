@extends('layouts.app')

@section('content')
  <div class="card">
    <div class="card-image">
      <figure class="image">
        <canvas data-idcode="{{ $tweet->idcode }}" width="200" height="250" class="actstruct chemheight"></canvas>
      </figure>
    </div>
    <div class="card-content">
      <div class="media">
        <div class="media-left">
          <figure class="image is-48x48">
            <img src="{{ $tweet->user->profile_image }}" class="rounded-circle" width="50" height="50" alt="Placeholder image">
          </figure>
        </div>

          <div class="media-content">
            <div class="content">
              <p class="title is-4">{{ $tweet->user->name }}</p>
              <p class="subtitle is-6">{{ $tweet->created_at->format('Y-m-d H:i') }}</p>
              {{ $tweet->text }}
              <div class="level is-mobile">
                <div class="level-item">
                  <a href="#"><i class="far fa-comment fa-fw"></i></a>
                  <p class="subtitle">{{ count($tweet->comments) }}</p>
                </div>
                <div class="level-item">
                  <a href="#"><i class="far fa-heart fa-fw"></i></a>
                  <p class="subtitle">{{ count($tweet->favorites) }}</p>
                </div>
              </div>
            </div>
            @foreach ($comments as $comment)
              <div class="media">
                <div class="media-left">
                  <figure class="image is-48x48">
                    <img src="{{ $tweet->user->profile_image }}" class="rounded-circle" width="50" height="50" alt="Placeholder image">
                  </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4">{{ $comment->user->name }}</p>
                    <p class="subtitle is-6">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                    {!! nl2br(e($comment->text)) !!}
                </div>
              </div>
            @endforeach
              <div class="media">
                  <div class="media-left">
                    <figure class="image is-48x48">
                      <img src="{{  $user->profile_image }}" class="rounded-circle" width="50" height="50" alt="Placeholder image">
                    </figure>
                  </div>
                  <div class="media-content">
                      <p class="title is-4">{{ $user->name }}</p>
                  </div>
              </div>
              <div class="content">
                <form method="POST" action="{{ route('comments.store') }}">
                  @csrf
                  <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                  <div class="field">
                    <p class="control">
                      <textarea class="textarea" name="text" required autocomplete="text" rows="4" placeholder="Add a comment...">{{ old('text') }}</textarea>
                    </p>
                  </div>
                  <div class="field">
                    <p class="control">
                      <button type="submit" class="button">Post comment</button>
                    </p>
                  </div>
                </form>
              </div>
            </div>
            <div class="media-right">
              @if ($tweet->user->id === Auth::user()->id)
                <div class="dropdown">
                  <div class="dropdown-trigger">
                    <button href="#" role="button" aria-controls="dropdown-menu" class="button is-white" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-fw"></i>
                    </button>
                  </div>
                  <div class="dropdown-menu" id="dropdown-menu" role="menu">
                    <div class="dropdown-content">
                      <a href="{{ url('tweets/' .$tweet->id .'/edit') }}" class="dropdown-item">edit</a>
                      <button type="submit" class="dropdown-item">delete</button>
                      <form method="POST" action="{{ url('tweets/' .$tweet->id) }}">
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
<script>
window.onload = function() {
  OCL.StructureView.showStructures('actstruct');
};
</script>
@endsection
