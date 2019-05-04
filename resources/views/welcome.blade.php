@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Microposts</h1>
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            <!-- 第1引数とび先のrouteでroute/web.phpで名付けたもの、第2ﾘﾝｸさせる文字列、第3?何だっけ？、第4このformのbootstrap -->
        </div>
    </div>
@endsection