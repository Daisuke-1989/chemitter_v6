@extends('layouts.edit')

@section('content')
<div class="hero-body">
  <div class="columns">
    <div class="column is-5">
      <div id="jsme_container"></div>
    </div>
    <div class="column is-6" id="app">
      <div class="box">
        <div class="field">
          <label class="label">Set compound</label>
          <p class="control">
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-link" v-on:click='setData'>SET</a>
                </p>
              </div>
            </p>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="column">
      <div class="card">
        <div class="card-content">
          <form method="POST" action="{{ route('tweets.update',[$tweets->id]) }}">
          @csrf
          @method('PUT')
        <div class="media">
          <div class="media-left">
            <figure class="image is-64x64">
              <img src="{{ $user->profile_image }}" width="50" height="50">
            </figure>
          </div>
          <div class="media-content">
            <div class="content">
              <a href="{{ url('users/' .$user->id) }}"><strong>{{ $user->name }}</strong></a>
            </div>
          </div>
        </div>
        <div class="card-image">
          <figure class="image">
            <canvas id="canvas" data-idcode="{{ $tweets->idcode }}" width="200" height="250" class="actstruct chemheight"></canvas>
          </figure>
        </div>
        <div class="content">
          <input id="idcode" type="text" name="idcode" value="{{ $tweets->idcode }}" hidden >
          <div class="field">
            <div class="control">
              <textarea class="textarea" name="text" required autocomplete="text" rows="4">{{ old('text') ? : $tweets->text }}</textarea>
              @error('text')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="field is-grouped is-grouped-right">
            <div class="control">
              <p class="has-text-danger">Max charactors:140</p>
              <button type="submit" class="button is-link">
                Tweet
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
