<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
</head>
<body>
<form action="/register" method="POST">
    <label>
        Имя:<br>
        <input type="text" name="name" required>
    </label><br>
    <label>
        Телефон:<br>
        <input type="tel" name="phone" required>
    </label><br>
    <label>
        Email:<br>
        <input type="email" name="email" required>
    </label><br>
    <label>
        Пароль:<br>
        <input type="password" name="password" required>
    </label><br>
    <label>
        Повторите пароль:<br>
        <input type="password" name="password_confirmation" required>
    </label><br>
    <button type="submit">Зарегистрироваться</button>
</form>
</body>
</html>