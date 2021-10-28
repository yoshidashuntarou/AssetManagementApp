<h1>list.php</h1>
<div>
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

<a href="/user">ユーザー設定</a>

</div>
<a href="/asset/register">資産を登録</a>
<br>
<a href="/search">資産を検索</a>

<h3>資産一覧</h3>
@foreach($assets as $asset)
<div>
    <a href="/asset/{{ optional($asset)['id'] }}">
    <p>{{ optional($asset)['id'] }} {{ optional($asset)['asset_name'] }} {{ optional($asset)['asset_owner'] }} {{ optional($asset)['asset_user'] }} {{ optional($asset)['operational_verification'] }} {{ optional($asset)['acquisition_date'] }}</p>
    </a>
</div>

@endforeach