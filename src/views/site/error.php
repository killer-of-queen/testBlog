<?php include ROOT.'/views/layouts/header.php' ?>
    <main class="main_index">
        <div class="content">
            <h2 class="error_message"><?php
                if (isset($error))
                    echo $error;
                ?></h2>
        </div>
    </main>
<?php include ROOT.'/views/layouts/footer.php' ?>