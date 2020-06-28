<?php include ROOT . '/views/layouts/header.php' ?>
    <main class="main_index">
        <div class="content">
            <h2><?php echo $title?></h2>
            <form action="#" method="post">
                <label for="header">Заголовок:</label>
                <input required type="text" name="header" id="header" class="create_message_item" value="<?php echo htmlentities($header);?>">
                <label for="short_description">Краткое содержание:</label>
                <textarea required class="create_message_item" name="short_description" id="short_description" cols="30" rows="10"><?php echo htmlentities($short_description);?></textarea>
                <label for="full_description">Текст:</label>
                <textarea required class="create_message_item" name="full_description" id="full_description" cols="30" rows="10"><?php echo htmlentities($full_description);?></textarea>
                <input type="submit" name="submit" class="button" value="Сохранить">
            </form>
        </div>
    </main>
<?php include ROOT . '/views/layouts/footer.php' ?>