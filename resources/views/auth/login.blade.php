@extends('layouts.app')

@section('content')
<div class="hero-body">
    <div class="columns">
        <div class="column is-6">
            <figure class="image is-4x3">
                <img src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
        </div>
        <div class="column is-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="field">
                        <div class="control">
                            <p class="title">{{ __('Login') }}</p>
                        </div>
                    </div>
                    <div class="field">
                        <label for="email" class="label">{{ __('E-Mail Address') }}</label>
                        <div class="control">
                            <input id="email" type="email" name="email" class="input" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="field">
                        <label for="password" class="label">{{ __('Password') }}</label>
                        <div class="control">
                            <input id="password" type="password" class="input" name="password" required autocomplete="current-password">
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <label class="checkbox" for="remember">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-link">
                                {{ __('Login') }}
                            </button>

                                @if (Route::has('password.request'))
                                    <a class="button is-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
