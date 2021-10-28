<h1>assetDtail.blade.php</h1>
<div>
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

<a href="/list">一覧に戻る</a>

<h1>資産の詳細です</h1><br>

<h3>{{ $assets[0]->id }} {{ $assets[0]->asset_owner }} {{ $assets[0]->asset_user }} {{ $assets[0]->place }} {{ $assets[0]->asset_code }} {{ $assets[0]->asset_name }} {{ $assets[0]->acquisition_date }} {{ $assets[0]->model }} {{ $assets[0]->number_of_assets }} {{ $assets[0]->operational_verification }} {{ $assets[0]->created_at }}</h3>
<br>
<a href="/asset/{{ $assets[0]->id }}/edit">編集</a>
<a href="/asset/{{ $assets[0]->id }}/delete/store">削除</a>
<br>
<br>
履歴：
<br>

@foreach($assets as $asset)
    {{ $asset->id }} {{ $asset->asset_owner }} {{ $asset->asset_user }} {{ $asset->place }} {{ $asset->asset_code }} {{ $asset->asset_name }} {{ $asset->acquisition_date }} {{ $asset->model }} {{ $asset->number_of_assets }} {{ $asset->operational_verification }} {{ $asset->created_at }}
    <br>
@endforeach

<script>
    // window.confirm("これが確認ダイアログです。");
</script>

