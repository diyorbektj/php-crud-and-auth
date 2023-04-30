<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!--    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LeMycMlAAAAAC5tvGZuwE_8-WFlun4C2NpDAW8N"></script>-->
</head>
<body>
<?php
\Core\Session::start();
$user = \Core\Session::get('user');
?>
<h1><?=$user?->name?></h1>
</body>
</html>