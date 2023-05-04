<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Внутренняя ошибка</title>
</head>
    <h1 style="font-family: Arial, Helvetica, sans-serif">Произошла внутренняя ошибка сервера. <br>
    <span style="font-size: 20px">Режим разработчика. Подробнее: /tmp/errors.log</span>
    </h1>
    <p><b>Код ошибки: </b><?= $errno ?></p>
    <p><b>Строка ошибки: </b><?= $errstr ?></p>
    <p><b>Файл: </b><?= $errfile ?></p>
    <p><b>Строка: </b><?= $errline ?></p>
</html>