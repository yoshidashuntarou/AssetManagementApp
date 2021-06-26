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
</div>
id = {{$id}} <br>
name = {{$name}} <br>
room = {{$room}} <br>
email = {{$email}} <br>
<a href="/asset/register">資産を登録</a>