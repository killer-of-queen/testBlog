<?php


class UserController
{
    public function actionLogout() {
        unset($_SESSION['user']);
        header("Location: /");
    }

    public function actionLogin()
    {
        $errors = false;

        unset($_SESSION['user']);

        if (isset($_POST['submit'])) {

            $login = $_POST['login'];

            if (isset($_POST['register'])) {
                $userId = User::register($login);
                if($userId == false)
                {
                    $errors['incorrect'] = 'Логин уже существует';
                }
            } else {
                $userId = User::login($login);
                if($userId == false)
                {
                    $errors['incorrect'] = 'Логин не зарегистрирован';
                }
            }
            if ($errors == false) {
                User::auth($userId);
                header("Location: /");
            } else {
                unset($userId);
            }
        }
        require_once (ROOT.'/views/user/login.php');
        return true;
    }
}