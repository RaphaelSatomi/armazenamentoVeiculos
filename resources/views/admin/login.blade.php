<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <link rel="stylesheet" href="{{url('assets/css/admin.login.css')}}"/>
</head>
<body>
    <div class="content__login">
        <div class="formTemplate">
            <span>Login</span>
            <form method="POST">
                @csrf

                <div>
                    <label for="users">E-mail</label>
                    <input type="email" name="user" placeholder="admin@admin.com"/>
                </div>

                <div>
                    <label for="users">Senha</label>
                    <input type="password" name="password" placeholder="admin"/>
                </div>

                <input type="submit" value="Entrar"/>
            </form>
            @if ($error)
                <div class="errorMsg">{{$error}}</div>
            @endif
        </div>
    </div>
</body>
</html>