@extends('layouts.app')

@section('content')
    @include('users.users',['users'=>$users])
    <!-- @include() 指定の場所にコンテンツを挿入する　継承できない、変数渡せる -->
    <!-- 第1引数:取り込む外部ﾌｧｲﾙ(?)、第2:読み込み先で利用する変数-->
@endsection