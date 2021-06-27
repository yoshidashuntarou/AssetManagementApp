<form method="post" action="/asset/{{ $asset_id }}/edit/store">
    @csrf
    <label for="administrator">担当者</label>
    <input name="administrator" type="text" value="{{ $asset->administrator }}">
    <br>

    <label for="place">場所</label>
    <input name="place" type="text" value="{{ $asset->place }}">
    <br>

    <label for="aasset_code">資産コード</label>
    <input name="asset_code" type="text" value="{{ $asset->asset_code }}">
    <br>

    <label for="asset_name">資産名</label>
    <input name="asset_name" type="text" value="{{ $asset->asset_name }}">
    <br>

    <label for="acquisition_date">取得年月日</label>
    <input name="acquisition_date" type="date" value="{{ $asset->acquisition_date }}">
    <br>

    <label for="model">型式</label>
    <input name="model" type="text" value="{{ $asset->model }}">
    <br>

    <label for="number_of_assets">数量</label>
    <input name="number_of_assets" type="number" value="{{ $asset->number_of_assets }}">
    <br>

    <label for="operational_verification">稼働確認</label><br>
    <input name="operational_verification"type="radio" value="稼働中" @if($asset->operational_verification == '稼働中') checked @endif>稼働中<br>
    <input name="operational_verification"type="radio" value="未使用（今後使用）" @if($asset->operational_verification == '未使用（今後使用）') checked @endif>未使用（今後使用）<br>
    <input name="operational_verification"type="radio" value="未使用（今後も未使用）" @if($asset->operational_verification == '未使用（今後も未使用）') checked @endif>未使用（今後も未使用）<br>
    <input name="operational_verification"type="radio" value="故障中" @if($asset->operational_verification == '故障中') checked @endif>故障中<br>
    <br>

    <button type="submit">更新する</button>
</form>