@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('users.show', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">TimeLine <span class="badge badge-secondary">{{ $count_microposts }}</span></a></li>
                <li class="nav-item"><a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/followings') ? 'active' : '' }}">Followings <span class="badge badge-secondary">{{ $count_followings }}</span></a></li>
                <li class="nav-item"><a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/followers') ? 'active' : '' }}">Followers <span class="badge badge-secondary">{{ $count_followers }}</span></a></li>
                <li class="nav-item"><a href="{{ route('favorites.favorite', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/favorites') ? 'active' : '' }}">Favorites <span class="badge badge-secondary">{{ $count_favorites }}</span></a></li>
            </ul>
                                                                                {{--<h1>{{ $user }}</h1>--}}
                                                                                {{--@foreach ($microposts as $micropost)--}}
               @include('microposts.microposts', ['microposts' => $microposts])
                                                                                   {{--@include('micropost_favorite.favorite_button', ['micropost' => $micropost])--}} 
                                                                                {{--@endforeach--}}          
        </div>
    </div>
@endsection


                                                                                {{-- UsersController から表示する。これを忘れてどうすればいいかパニックになった20190620 
                                                                                さらにあとで気づいたが、Routeにもう一か所追加があった！！これわかって入れば混乱なかったはず！！！
                                                                                --}}