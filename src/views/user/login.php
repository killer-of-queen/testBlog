<?php include ROOT.'/views/layouts/header.php' ?>
    <main class="main_login">
        <div class="content">
            <div class="login_card">
                <h2 class="login_card-header">
                    Регистрация/Авторизация
                </h2>
                <form action="#" method="post">
                    <label for="login">Логин:</label>
                    <input required type="text" name="login" id="login"><br>
                    <input type="checkbox" id="register" name="register"
                           checked>
                    <label for="register">Регистрация</label><br>
                    <input class="button" type="submit" name="submit" value="Вход">
                </form>
                <div class="login_error"><?php if ($errors != false) echo $errors['incorrect']; ?></div>
            </div>
        </div>
    </main>
<?php include ROOT.'/views/layouts/footer.php' ?>