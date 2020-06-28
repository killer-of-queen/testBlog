<?php include ROOT . '/views/layouts/header.php' ?>
    <main class="main_index">
        <div class="content">
            <?php if($messages == []):?>
                <h3 class="empty_message_list"><?php echo $empty_page_name?></h3>
            <?php else: ?>
                <?php foreach ($messages as $message) :?>
                    <a href="/message/<?php echo $message['id'];?>">
                        <div class="message_card">
                            <div class="message_card-header">
                                <p><?php echo htmlentities($message['header']);?></p>
                                <?php if(isset($message['author'])):?>
                                    <p><?php echo htmlentities($message['author']);?></p>
                                <?php endif;?>
                            </div>
                            <p class="message_card-content"><?php echo htmlentities($message['short_description']);?></p>
                            <p class="message_card-footer"><?php
                                $date = new DateTime($message['date']);
                                echo $date->format('d.m.Y');
                                ?></p>
                        </div>
                    </a>
                <?php endforeach;?>
                <div class="paginator"><?php echo $pagination->get() ?></div>
            <?php endif;?>
        </div>
    </main>
<?php include ROOT . '/views/layouts/footer.php' ?>