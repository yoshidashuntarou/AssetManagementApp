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

@foreach($assets as $asset)

{{ $asset->id }} {{ $asset->administrator }} {{ $asset->place }} {{ $asset->asset_code }} {{ $asset->asset_name }} {{ $asset->acquisition_date }} {{ $asset->model }} {{ $asset->number_of_assets }} {{ $asset->operational_verification }} {{ $asset->created_at }}
<br>
@endforeach

<a href="/asset/{{ $assets[0]->id }}/edit">編集</a>
