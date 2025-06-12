<form method="POST" action="/register">
    @csrf
    <input name="first_name" placeholder="First Name">
    <input name="last_name" placeholder="Last Name">
    <input name="email" type="email">
    <input name="phone" type="text">
    <input name="password" type="password">
    <input name="password_confirmation" type="password">
    <button type="submit">Register</button>
</form>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
