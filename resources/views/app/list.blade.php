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

<h3>資産一覧</h3>
@foreach($assets as $asset)
<div>
    <a href="/asset/{{ $asset->id }}">
    <p>{{ $asset->id }} {{ $asset->asset_name }} {{ $asset->administrator }} {{ $asset->operational_verification }} {{ $asset->acquisition_date }}</p>
    </a>
</div>

@endforeach

