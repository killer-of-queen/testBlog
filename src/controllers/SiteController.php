<?php


class SiteController
{
    public function actionComment($postId) {
        $userId = User::checkLogged();
        if ($_POST['submit']) {
            $is_saved = Comment::saveMessage($postId, $userId, $_POST['comment']);
            if ($is_saved != 1)
            {
                $error = "Не удалось оставить комментарий :(";
                require_once (ROOT.'/views/site/error.php');
                return true;
            }
        }
        header("Location: /message/$postId");
    }

    public function actionIndex($page = 1) {
        $empty_page_name = "Лента пока пуста!";
        $userId = User::checkLogged();
        $messages = Message::getAllMessages($page, Message::SHOW_BY_DEFAULT);
        $total = Message::getTotalMessages();
        $pagination = new Pagination($total, $page, Message::SHOW_BY_DEFAULT, 'page-');
        require_once(ROOT . '/views/messages/listView.php');
        return true;
    }

    public function actionOpen($id) {
        $userId = User::checkLogged();
        $message = Message::getMessageContent($id);
        $comments = Comment::getAllComments($id);
        $comments_amount = Comment::getTotalPostComments($id);
        $is_author = $message['userId'] == $userId;
        require_once(ROOT . '/views/messages/itemView.php');
        return true;
    }

    public function actionEdit($id) {
        $userId = User::checkLogged();
        $title = "Редактирование поста";
        $message = Message::getMessageContent($id);
        $header = $message['header'];
        $short_description = $message['short_description'];
        $full_description = $message['full_description'];
        if(isset($_POST['submit'])) {
            $message['id'] = $id;
            $message['header'] = $_POST['header'];
            $message['short_description'] = $_POST['short_description'];
            $message['full_description'] = $_POST['full_description'];
            $is_save = Message::editMessage($message);
            if ($is_save == false) {
                $error = "Не удалось сохранить изменения :(";
                require_once (ROOT.'/views/site/error.php');
                return true;
            } else {
                header("Location: /im");
            }
        }
        require_once(ROOT . '/views/messages/createOrUpdate.php');
        return true;
    }

    public function actionUser($page = 1) {
        $empty_page_name = "Список сообщений пока пуст!";
        $userId = User::checkLogged();
        $total = Message::getTotalUserMessages($userId);
        $pagination = new Pagination($total, $page, Message::SHOW_BY_DEFAULT, 'page-');
        $messages = Message::getUserMessages($userId, $page, Message::SHOW_BY_DEFAULT);
        require_once(ROOT . '/views/messages/listView.php');
        return true;
    }

    public function actionCreate() {
        $header = '';
        $short_description = '';
        $full_description = '';
        $title = "Новый пост";
        $userId = User::checkLogged();

        if(isset($_POST['submit'])) {
            $message['header'] = $_POST['header'];
            $message['short_description'] = $_POST['short_description'];
            $message['full_description'] = $_POST['full_description'];
            $message['user'] = $userId;
            $is_save = Message::saveMessage($message);
            if ($is_save == false) {
                $error = "Не удалось сохранить сообщение :(";
                require_once (ROOT.'/views/site/error.php');
                return true;
            } else {
                header("Location: /im");
            }
        }
        require_once(ROOT . '/views/messages/createOrUpdate.php');
        return true;
    }
}