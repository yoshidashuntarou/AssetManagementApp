<form method="post" action="/user/store">
    @csrf
    <a href="/list">一覧に戻る</a><br>
    <label for="administrator">名前</label>
    <input name="name" type="text" value="{{ $user->name }}">
    <br>

    <label for="place">研究室</label>
    <input name="room" type="text" value="{{ $user->room }}">
    <br>

    <button type="submit">更新する</button>
</form>