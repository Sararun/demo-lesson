<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration and login system</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="container">
    <?php require __DIR__ . '/../block/_top-menu.php' ?>

    <?php require __DIR__ . '/../block/_alert.php'; ?>

    <div class="row">
        <?php echo $content; ?>
    </div>
</div>

<script src="/assets/js/jquery-1.12.4.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/script.js"></script>
</body>
</html>