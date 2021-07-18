<form method="post" action="/user/store">
    @csrf
    <a href="/list">一覧に戻る</a><br>
    <label for="name">名前</label>
    <input id="name" name="name" type="text" value="{{ $user->name }}" oninput="validate()">
    <br>

    <label for="room">研究室</label>
    <input id='room' name="room" type="text" value="{{ $user->room }}" oninput="validate()">
    <br>

    <button id="submitButton" type="submit">更新する</button>
    <script>
        
        document.getElementById('submitButton').disabled = true;

        const name = document.getElementById('name').value;
        const room = document.getElementById('room').value;

        function validate() {
            let name2 = document.getElementById('name').value;
            let room2 = document.getElementById('room').value;

            if (name != name2 || room != room2) {
                document.getElementById('submitButton').disabled = false;
            } else {
                document.getElementById('submitButton').disabled = true;
            }            
        }
    </script>
</form>