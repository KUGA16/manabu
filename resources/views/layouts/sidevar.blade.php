<div class="card">
    <div class="card-body">
        <!-- ログインしているかチェック -->
        @if(Auth::check())
            <ul class="sidevar">
                <li class="sidevar-item"><a href="{{ route('/') }}">ダッシュボード</a></li>
                <li class="sidevar-item"><a href="{{ route('users.mypage', ['user' => Auth::user()->id]) }}">マイページ</a></li>
                <li class="sidevar-item"><a href="{{ route('users.edit', ['user' => Auth::user()->id]) }}">設定</a></li>
                <li class="sidevar-item"><a href="{{ route('lessons.create') }}">レッスン作成はこちら</a></li>
            </ul>
        @else
            <h3>学びたい人と教えたい人をつなぐサイト</h3>
            <h4><a href="{{ route('register') }}">はじめる</a></h4>
        @endif
    </div>
</div>