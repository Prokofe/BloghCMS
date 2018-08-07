<?php include_once ROOT . '/views/layouts/header.php'; ?>

    <div class="row no-gutters">
        <div class="col-sm-12">
            <div class="content">
                <b>Add new article</b>
                <hr>
                <?php if ($result): ?>
                    <p>Article edited successfully. </p>
                <?php elseif (isset($error)): ?>
                    <small><?= $error ?></small>
                <?php endif; ?>
                <br>
                <form action="" method="post">
                    Title: <br>
                    <input type="text" size="55" name="title" value="<?= $article['title'] ?>"/><br><br>
                    Text: <br>
                    <textarea rows="15" cols="42" name="content"><?= $article['content'] ?></textarea><br><br>
                    Category: <br>
                    <select name="category">
                        <option></option>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php } ?>
                    </select><br><br>
                    <input type="submit" name="submit" value="Edit article"/>
                </form>
                <br>
                <a href="<?= INDEX ?> ">&larr; Back</a>
            </div>
        </div>
    </div>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>