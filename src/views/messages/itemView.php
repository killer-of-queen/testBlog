<?php include ROOT . '/views/layouts/header.php' ?>
    <main class="main_index">
        <div class="content">
            <div class="message_header">
                <h2><?php echo $message['header'];?><?php if($is_author) :?>
                        <a style="font-size: 1rem;" href="/edit/<?php echo $message['id'];?>">
                            <i class="fa fa-pencil fa-2x" style="color: rgba(17, 94, 215, 0.5);" aria-hidden="true"></i>
                        </a>
                    <?php endif;?></h2>
                <h3><?php echo htmlentities($message['author']);?></h3>
            </div>
            <p><?php echo htmlentities($message['full_description']);?></p>
            <p class="message_card-footer"><?php
                $date = new DateTime($message['date']);
                echo $date->format('d.m.Y');
                ?>
            </p>
            <?php if (isset($userId)): ?>
            <form action="/comment/<?php echo $message['id'];?>" method="post">
                <label class="comment_label" for="comment">Комментарий:</label>
                <textarea required class="comment_field" name="comment" id="comment" rows="5"></textarea>
                <input type="submit" name="submit" class="button" value="Отправить">
            </form>
            <?php endif;?>
            <h2>Комментарии(<?php echo $comments_amount;?>)</h2>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <div class="comment_header"><?php echo htmlentities($comment['author']);?></div>
                    <div class="comment_content"><?php echo htmlentities($comment['content']);?></div>
                    <div class="comment_date"><?php
                        $date = new DateTime($comment['date']);
                        echo $date->format('d.m.Y h:i:s');
                        ?></div>
                </div>
            <?php endforeach;?>
        </div>
    </main>
<?php include ROOT . '/views/layouts/footer.php' ?>