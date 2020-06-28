<?php


class Comment
{
    public static function saveMessage($postId, $authorId, $content) {
        $db = Db::getConnection();
        $sql = 'INSERT INTO comment(content, author, post) '
            . 'VALUES (:content, :author, :post)';
        $result = $db->prepare($sql);
        $result->bindParam(':content', $content);
        $result->bindParam(':author', $authorId);
        $result->bindParam(':post', $postId);
        return $result->execute();
    }

    public static function getAllComments($postId) {
        $db = Db::getConnection();
        $sql = 'SELECT user.login as author, content, date 
                FROM comment INNER JOIN user ON user.id=comment.author WHERE comment.post=:id ORDER BY date DESC';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $postId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTotalPostComments($id) {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(id) as count FROM comment WHERE post=:id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetchColumn();
    }
}