<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Twitter</title>
    <link rel="stylesheet" href="/template/css/custom.css">
    <link rel="stylesheet" href="/template/css/font-awesome.css">
</head>
<body>
<header>
    <div class="content">
        <?php
        if (isset($userId))
        {
            echo "<a href=\"/\">Лента</a>";
            echo "<a href=\"/im\">Мои сообщения</a>";
            echo "<a href=\"/create\">
            <i class=\"fa fa-envelope fa-2x\" style=\"color: rgba(17, 94, 215, 0.5);\" aria-hidden=\"true\"></i>
        </a>";
        }
        ?>
        <a href="<?php echo (isset($userId)) ? '/logout' : '/login';?>">
            <i class="fa <?php echo (isset($userId)) ? 'fa-sign-out' : 'fa-sign-in';?> fa-2x" style="color: rgba(17, 94, 215, 0.5);" aria-hidden="true"></i>
        </a>
    </div>
</header>