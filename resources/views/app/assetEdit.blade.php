<form method="post" action="/asset/{{ $asset_id }}/edit/store">
    @csrf
    <label for="asset_owner">所有者</label>
    <input id="asset_owner" name="asset_owner" type="text" value="{{ $asset->asset_owner }}" oninput="validate()">
    <br>

    <label for="asset_user">担当者</label>
    <input id="asset_user" name="asset_user" type="text" value="{{ $asset->asset_user }}" oninput="validate()">
    <br>

    <label for="place">場所</label>
    <input id="place" name="place" type="text" value="{{ $asset->place }}" oninput="validate()">
    <br>

    <label for="aasset_code">資産コード</label>
    <input id="asset_code" name="asset_code" type="text" value="{{ $asset->asset_code }}" oninput="validate()">
    <br>

    <label for="asset_name">資産名</label>
    <input id="asset_name" name="asset_name" type="text" value="{{ $asset->asset_name }}" oninput="validate()">
    <br>

    <label for="acquisition_date">取得年月日</label>
    <input id="acquisition_date" name="acquisition_date" type="date" value="{{ $asset->acquisition_date }}" oninput="validate()">
    <br>

    <label for="model">型式</label>
    <input id="model" name="model" type="text" value="{{ $asset->model }}" oninput="validate()">
    <br>

    <label for="number_of_assets">数量</label>
    <input id="number_of_assets" name="number_of_assets" type="number" value="{{ $asset->number_of_assets }}" oninput="validate()">
    <br>

    <label id="operational_verification" for="operational_verification">稼働確認</label><br>
    <input id="operational_verification" name="operational_verification" type="radio" value="稼働中" @if($asset->operational_verification == '稼働中') checked @endif oninput="validate()">稼働中<br>
    <input id="operational_verification" name="operational_verification" type="radio" value="未使用（今後使用）" @if($asset->operational_verification == '未使用（今後使用）') checked @endif oninput="validate()">未使用（今後使用）<br>
    <input id="operational_verification" name="operational_verification" type="radio" value="未使用（今後も未使用）" @if($asset->operational_verification == '未使用（今後も未使用）') checked @endif oninput="validate()">未使用（今後も未使用）<br>
    <input id="operational_verification" name="operational_verification" type="radio" value="故障中" @if($asset->operational_verification == '故障中') checked @endif oninput="validate()">故障中<br>
    <br>

    <button id="submitButton" type="submit">更新する</button>

    <script>
        
        document.getElementById('submitButton').disabled = true;

        const asset_owner = document.getElementById('asset_owner').value;
        const asset_user = document.getElementById('asset_user').value;
        const place = document.getElementById('place').value;
        const asset_code = document.getElementById('asset_code').value;
        const asset_name = document.getElementById('asset_name').value;
        const acquisition_date = document.getElementById('acquisition_date').value;
        const model = document.getElementById('model').value;
        const number_of_assets = document.getElementById('number_of_assets').value;
        const operational_verification = document.getElementById('operational_verification');
        let radio = document.getElementsByName('operational_verification');
        let checkedValue = '';

        for (let i = 0; i < 4; i++){
            if (radio.item(i).checked){
                checkedValue = radio.item(i).value;
            }
        }

        function validate() {
            let asset_owner2 = document.getElementById('asset_owner').value;
            let asset_user2 = document.getElementById('asset_user').value;
            let place2 = document.getElementById('place').value;
            let asset_code2 = document.getElementById('asset_code').value;
            let asset_name2 = document.getElementById('asset_name').value;
            let acquisition_date2 = document.getElementById('acquisition_date').value;
            let model2 = document.getElementById('model').value;
            let number_of_assets2 = document.getElementById('number_of_assets').value;
            let checkedValue2 = '';

            for (let i = 0; i < 4; i++){
                if (radio.item(i).checked){
                    checkedValue2 = radio.item(i).value;
                }
            }

            if (asset_owner != asset_owner2 || asset_user != asset_user2 || asset_code != asset_code2 || asset_name != asset_name2 || acquisition_date != acquisition_date2 || model != model2 || number_of_assets != number_of_assets2 || checkedValue != checkedValue2) {
                document.getElementById('submitButton').disabled = false;
            } else {
                document.getElementById('submitButton').disabled = true;
            }            
        }
    </script>

</form>