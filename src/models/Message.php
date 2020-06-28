<?php


class Message
{
    const SHOW_BY_DEFAULT = 3;

    public static function getMessageContent($id) {
        $db = Db::getConnection();
        $sql = 'SELECT post.id AS id, user.id AS userId, user.login AS author, header, short_description, full_description, date 
                FROM post INNER JOIN user ON user.id=post.user WHERE post.id=:id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }

    public static function getAllMessages($page, $limit = self::SHOW_BY_DEFAULT) {
        $db = Db::getConnection();
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $sql = 'SELECT post.id AS id, user.login AS author, header, short_description, full_description, date 
                FROM post INNER JOIN user ON user.id=post.user ORDER BY date DESC LIMIT :limit OFFSET :offset';
        $result = $db->prepare($sql);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserMessages($userId, $page, $limit = self::SHOW_BY_DEFAULT) {
        $db = Db::getConnection();
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $sql = 'SELECT * FROM post '
            . 'WHERE user=:userId ORDER BY date DESC LIMIT :limit OFFSET :offset';
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function saveMessage($message) {
        $db = Db::getConnection();
        $sql = 'INSERT INTO post(header, short_description, full_description, user) '
            . 'VALUES (:header, :short_description, :full_description, :user)';
        $result = $db->prepare($sql);
        $result->bindParam(':header', $message['header']);
        $result->bindParam(':short_description', $message['short_description']);
        $result->bindParam(':full_description', $message['full_description']);
        $result->bindParam(':user', $message['user']);
        return $result->execute();
    }

    public static function editMessage($message) {
        $db = Db::getConnection();
        $sql = 'UPDATE post '
            . 'SET header=:header, short_description=:short_description, full_description=:full_description WHERE id=:id';
        $result = $db->prepare($sql);
        $result->bindParam(':header', $message['header']);
        $result->bindParam(':short_description', $message['short_description']);
        $result->bindParam(':full_description', $message['full_description']);
        $result->bindParam(':id', $message['id']);
        return $result->execute();
    }

    public static function getTotalMessages() {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(id) as count FROM post';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchColumn();
    }

    public static function getTotalUserMessages($id) {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(id) as count FROM post WHERE user=:id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchColumn();
    }
}