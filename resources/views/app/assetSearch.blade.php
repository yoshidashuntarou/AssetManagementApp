<h1>assetSearch.php</h1>
<div>

    <a href="/list">一覧に戻る</a>


    <form method="post" action="/list/search">
    @csrf
    <label for="asset_owner">所有者</label>
    <input name="asset_owner"type="text">
    <br>

    <label for="asset_user">使用者</label>
    <input name="asset_user"type="text">
    <br>

    <label for="place">場所</label>
    <input name="place"type="text">
    <br>

    <label for="aasset_code">資産コード</label>
    <input name="asset_code"type="text">
    <br>

    <label for="asset_name">資産名</label>
    <input name="asset_name"type="text">
    <br>

    <label for="acquisition_date">取得年月日</label>
    <input name="acquisition_date"type="date">
    <br>

    <label for="model">型式</label>
    <input name="model"type="text">
    <br>

    <label for="number_of_assets">数量</label>
    <input name="number_of_assets"type="number">
    <br>

    <label for="operational_verification">稼働確認</label><br>
    <input name="operational_verification"type="radio" value="稼働中">稼働中<br>
    <input name="operational_verification"type="radio" value="未使用（今後使用）">未使用（今後使用）<br>
    <input name="operational_verification"type="radio" value="未使用（今後も未使用）">未使用（今後も未使用）<br>
    <input name="operational_verification"type="radio" value="故障中">故障中<br>
    <br>

    <label for="search_conditions">検索条件</label><br>
    <input name="search_conditions"type="radio" value="0" checked="checked">一部を含む<br>
    <input name="search_conditions"type="radio" value="1">全てを含む<br>

    <button type="submit">検索する</button>

</form>
    
</div>


