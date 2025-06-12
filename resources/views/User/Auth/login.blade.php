<form method="POST" action="/login">
    @csrf
    <input name="login" placeholder="Email or Phone">
    <input name="password" type="password">
    <button type="submit">Login</button>
</form>
