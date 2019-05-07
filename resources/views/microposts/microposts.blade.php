<ul class="list-unstyled">
    @foreach ($microposts as $micropost)
        <li class="media mb-3">     <!-- margin-bottom -->
            <!-- ﾒﾃﾞｨｱｵﾌﾞｼﾞｪｸﾄ　ﾌﾞﾛｸﾞｺﾒﾝﾄトや、ﾂｲｰﾄなど、様々な種類のｺﾝﾎﾟｰﾈﾝﾄ作るためのｽﾀｲﾙ。ﾈｽﾄにしてあるようだ　 -->
            <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $micropost->user->name, ['id' => $micropost->user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    <!-- 第一引数:route（ここではsignup.getと名付けたﾙｰﾃｨﾝｸﾞ経路）　、第2引数:ﾘﾝｸのための文字列、というkeyを持つ配列変数ﾌﾟﾛﾊﾟﾃｨ(?) -->
                    <!-- その2つは指定が必須なので連想配列形式を省略して書く -->
                    <!-- 第3引数以下は任意なのでkeyを指定して連想配列形式で書く -->
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                </div>
                <div>
                    @if (Auth::id() == $micropost->user_id)
                        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $microposts->render('pagination::bootstrap-4') }}
