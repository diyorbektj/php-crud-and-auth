<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>
<!--    <script src="https://www.google.com/recaptcha/api.js?render=6LfHaswlAAAAAP7VYgrRCQyNXsoIV3va34y0C3vb"></script>-->
</head>
<body>
<form action="/login" method="POST">
    <label>
        Email:<br>
        <input type="email" name="email" required>
    </label><br>
    <label>
        Пароль:<br>
        <input type="password" name="password" required>
    </label><br>
    <input type="hidden" name="captcha_token_v3">
    <div id="captcha"></div>
    <div class="g-recaptcha" data-sitekey="6LfGaswlAAAAAAPzKbV9PnrwG3uCarmkOSHw97Ke"></div>
    <button class="g-recaptcha"
            data-sitekey="6LfHaswlAAAAAP7VYgrRCQyNXsoIV3va34y0C3vb"
            data-callback='onSubmit'
            type="submit"
            data-action='submit'>Submit</button>
</form>
<script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
</script>
</body>
</html>