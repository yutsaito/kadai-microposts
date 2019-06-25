


{{-- micropost.blade.php から移植した20190620 --}}

    
        
                                            {{--@if (Auth::user()->is_favoring($micropost->id))--}}
                                            {{--@if (!($user->is_favoring($micropost->id)))--}}
    @if (Auth::user()->is_favoring($micropost->id))
                                            {{--@if ($user->is_favoring($micropost->id))--}}
        {{--  {{ $user }}  --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('unfavotite', ['class' => "btn btn-danger btn-sm"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['favorites.favorite', $micropost->id], 'method' => 'post']) !!}
            {!! Form::submit('favorite', ['class' => "btn btn-primary btn-sm"]) !!}
        {!! Form::close() !!}
    @endif
    








{{--
@if (Auth::id() != $user->id)
    @if (Auth::user()->is_favoring($micropost->id))
        {!! Form::open(['route' => ['user.deletefavorite', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('unfavotite', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.addfavotite', $micropost->id]]) !!}
            {!! Form::submit('favorite', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif
--}}
{{-- POSTメソッドを使用してフォームを開始し、actionにrouteキーを利用して、ルーティング名を指定 --}}
{{--  自分でかいといてなんだが、'route' => ['user.deletefavorite'　はrouteキー=>ルート名 ? 違うか？--}}
{{-- これをエラー無く表示させるには、User.phpにdeletefavorite($micropostId) メソッドが必要なハズ --}}
{{-- User.phpにaddfavorite($micropostId) メソッドが必要なハズ --}}
{{-- User.phpにis_favoring($user->id) メソッドが必要なハズ 、しかもこれはきちんとかかないといけない--}}