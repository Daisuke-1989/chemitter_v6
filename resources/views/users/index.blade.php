@extends('layouts.app')

@section('content')
    <div class="container">
        <ul>
                @foreach ($all_users as $user)
                    <li class="box">
                        <article class="media">
                            <div class="media-left">
                                <figure class="image is-64x64">
                                    <img src="{{ $user->profile_image }}" width="50" height="50">
                                </figure>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <a href="{{ url('users/' .$user->id) }}"><strong>{{ $user->name }}</strong></a>
                                </div>
                                <nav class="level is-mobile">
                                    <div class="level-left">
                                        @if (auth()->user()->isFollowed($user->id))
                                            <div class="level-item" aria-lavel="like">
                                                <span class="icon is-small has-text-info"><i class="fas fa-heart"></i></span>
                                            </div>
                                        @endif
                                        <div class="level-item" aria-lavel="follow">
                                            @if (auth()->user()->isFollowing($user->id))
                                                <form action="{{ route('unfollow', [$user->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="button is-white"><span class="icon is-small has-text-info"><i class="fas fa-heart"></i></span></button>
                                                </form>
                                            @else
                                                <form action="{{ route('follow', [$user->id]) }}" method="POST">
                                                    {{ csrf_field() }}

                                                    <button type="submit" class="button is-white"><span class="icon is-small has-text-info"><i class="far fa-heart"></i></span></button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </article>
                    </li>
                @endforeach
        </ul>
        <div class="my-4 d-flex justify-content-center">
            {{ $all_users->links() }}
        </div>
    </div>
@endsection
