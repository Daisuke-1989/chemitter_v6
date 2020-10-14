@extends('layouts.app')

@section('content')
<div class="columns"">
    <div class="column is-6">
        <figure class="image is-4x3">
            <img src="https://bulma.io/images/placeholders/256x256.png">
        </figure>
    </div>
    <div class="column is-5 ">
        <form method="POST" action="{{ route('register') }} ">
            @csrf
                <div class="field">
                    <div class="control">
                        <p class="title">{{ __('Register') }}</p>
                    </div>
                </div>

                <div class="field">
                    <label for="name" class="label">{{ __('Name') }}</label>
                    <div class="control">
                        <input id="name" type="text" name="name" class="input" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="email" class="label">{{ __('E-Mail Address') }}</label>
                    <div class="control">
                        <input id="email" type="email" name="email" class="input" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="password" class="label">{{ __('Password') }}</label>
                    <div class="control">
                        <input id="password" type="password" class="input" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="password-confirm" class="label">{{ __('Confirm Password') }}</label>
                    <div class="control">
                        <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-link">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection
