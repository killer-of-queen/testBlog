<?php

class User
{
    public static function auth($userId) {
        $_SESSION['user'] = $userId;
    }

    public static function register($login) {
        $db = Db::getConnection();
        $sql = 'INSERT INTO user (login) '
            . 'VALUES (:login)';
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login);
        $result->execute();
        return $db->lastInsertId();
    }

    public static function login($login) {
        $db = Db::getConnection();
        $sql = 'SELECT id FROM user '
            . 'WHERE login=:login';
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login);
        $result->execute();
        return $result->fetchColumn();
    }

    public static function checkLogged() {
        if(isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /login");
    }
}