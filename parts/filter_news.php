<?php
    require_once 'connect.php';
    $sort = "DESC";
    $result = $link->query("SELECT * FROM `news-lab-two` ORDER BY `date_create` {$sort} ");
    if (!empty($_POST['sort'])){
        $sort = explode("-", $_POST['sort']);
        if ($sort[0] == "date"){
            $result = $link->query("SELECT * FROM `news-lab-two` ORDER BY `date_create` {$sort[1]} ");
        }
        else if ($sort[0] == "likes"){
            $result = $link->query("SELECT * FROM `news-lab-two` ORDER BY `count_likes` {$sort[1]} ");
        }
    }
?>

<?php while ($row = $result->fetch_assoc()): ?>

    <?php if ($row['status'] == 2): ?>

        <div class="tiding" id="tiding-<?= $row['id']; ?>">
            <div class="tiding-img element_tiding_hide">
                <?php if ($row['img'] == null): ?>
                    <img src="../images/general/NotLoadImage.png" alt="Image">
                <?php else: ?>
                    <img src="data:image/png;base64, <?= base64_encode($row['img']); ?>" alt="Image">
                <?php endif; ?>
            </div>
            <div class="tiding-all_description element_tiding_hide">
                <div class="tiding-title">
                    <b><?= $row['title'] ?></b>
                </div>
                <div class="tiding-description">
                    <p><?= $row['short_annotation']; ?></p>
                </div>
                <div class="tiding-date_create">
                    <?php $months = ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"]; ?>
                    <p><?= "Дата публикации: " . date("j", strtotime($row['date_create'])) . " " . $months[date("n")] . " " . date("Y", strtotime($row['date_create'])) . " г. " . date('H:i', strtotime($row['date_create'])); ?></p>
                </div>
                <div class="tiding-details">
                    <span id="over_tiding-<?= $row['id']; ?>" class="open_tiding" onclick="openTiding(this)">Читать далее...</span>
                    <?php if ($_POST['url'] === "admin"): ?>
                        <span id="edit_tiding" onclick="edit_tiding(this)">Открыть форму редактирования новости</span>
                    <?php endif; ?>
                    <span id="put_like-<?= $row['id']; ?>" class="put_tiding" title="Поставить лайк" onclick="putLike(this)"><i class="fa fa-heart-o fa-2x like-n" aria-hidden="true"></i></span>
                    <small id="count_likes-<?= $row['id']; ?>"><?= $row['count_likes']; ?></small>
                </div>
            </div>
            <div class="tiding-show tiding-control-hide">
                <div class="block-tiding_hide">
                    <p>Новость скрыта администратором</p>
                </div>
                <?php if ($_POST['url'] === "admin"): ?>
                    <div class="tiding_control">
                        <img src="../images/general/HideTiding.png" alt="Image" title="Скрыть новость" class="hide_tiding" onclick="hide_tiding(this)">
                        <img src="../images/general/DeleteTiding.png" alt="Image" title="Удалить новость" class="delete_tiding" onclick="delete_tiding(this)">
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="edit_tiding" id="edit_tiding-<?= $row['id']; ?>">
            <form action="administration.php" method="post" id="form_edit_tiding" class="form_edit_tiding" enctype="multipart/form-data" novalidate>
                <div class="tiding_part">
                    <p>
                        <label for="edit_tiding_title">Заголовок: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                        <input type="text" name="edit_tiding_title" id="edit_tiding_title" value="<?= $row['title']; ?>" required>
                    </p>
                </div>
                <div class="tiding_part">
                    <p>
                        <label for="edit_tiding_annotation">Краткая аннотация: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                        <textarea name="edit_tiding_annotation" id="edit_tiding_annotation" required><?= $row['short_annotation']; ?></textarea>
                    </p>
                </div>
                <div class="tiding_part">
                    <p>
                        <label for="edit_tiding_text">Текст: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                        <textarea name="edit_tiding_text" id="edit_tiding_text" required><?= $row['description']; ?></textarea>
                    </p>
                </div>
                <div class="tiding_part old-img">
                    <label>Выбранное изображение:</label>
                    <?php if ($row['img'] == null): ?>
                        <span>Изображение не блыо загружено!</span>
                    <?php else: ?>
                        <img src="data:image/png;base64, <?= base64_encode($row['img']); ?>" alt="Image">
                    <?php endif; ?>
                </div>
                <div class="tiding_part">
                    <p>
                        <label for="edit_tiding_img">Выбрать другие изображения:</label>
                        <input type="file" name="edit_tiding_img[]" id="edit_tiding_img" multiple accept=".jpg, .jpeg, .png">
                    </p>
                    <span id="error_edit_img"></span><br>
                </div>
                <button type="submit" name="save_edit_tiding" value="<?= $row['id']; ?>">Сохранить</button>
            </form>
        </div>

    <?php else: ?>

        <div class="tiding" id="tiding-<?= $row['id']; ?>">
            <div class="tiding-img">
                <?php if ($row['img'] == null): ?>
                    <img src="../images/general/NotLoadImage.png" alt="Image">
                <?php else: ?>
                    <img src="data:image/png;base64, <?= base64_encode($row['img']); ?>" alt="Image">
                <?php endif; ?>
            </div>
            <div class="tiding-all_description">
                <div class="tiding-title">
                    <b><?= $row['title'] ?></b>
                </div>
                <div class="tiding-description">
                    <p><?= $row['short_annotation']; ?></p>
                </div>
                <div class="tiding-date_create">
                    <?php $months = ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"]; ?>
                    <p><?= "Дата публикации: " . date("j", strtotime($row['date_create'])) . " " . $months[date("n")] . " " . date("Y", strtotime($row['date_create'])) . " г. " . date('H:i', strtotime($row['date_create'])); ?></p>
                </div>
                <div class="tiding-details">
                    <span id="over_tiding-<?= $row['id']; ?>" class="open_tiding" onclick="openTiding(this)">Читать далее...</span>
                    <?php if ($_POST['url'] === "admin"): ?>
                        <span id="edit_tiding" onclick="edit_tiding(this)">Открыть форму редактирования новости</span>
                    <?php endif; ?>
                    <span id="put_like-<?= $row['id']; ?>" class="put_tiding" title="Поставить лайк" onclick="putLike(this)"><i class="fa fa-heart-o fa-2x like-n" aria-hidden="true"></i></span>
                    <small id="count_likes-<?= $row['id']; ?>"><?= $row['count_likes']; ?></small>
                </div>
            </div>
            <div class="tiding-show">
                <div class="block-tiding_hide element_tiding_hide">
                    <p>Новость скрыта администратором</p>
                </div>
                <?php if ($_POST['url'] === "admin"): ?>
                    <div class="tiding_control">
                        <img src="../images/general/ShowTiding.png" alt="Image" title="Скрыть новость" class="hide_tiding" onclick="hide_tiding(this)">
                        <img src="../images/general/DeleteTiding.png" alt="Image" title="Удалить новость" class="delete_tiding" onclick="delete_tiding(this)">
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="edit_tiding" id="edit_tiding-<?= $row['id']; ?>">
            <form action="administration.php" method="post" id="form_edit_tiding" class="form_edit_tiding" enctype="multipart/form-data">
                <div class="tiding_part">
                    <p>
                        <label for="edit_tiding_title">Заголовок: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                        <input type="text" name="edit_tiding_title" id="edit_tiding_title" value="<?= $row['title']; ?>" required>
                    </p>
                </div>
                <div class="tiding_part">
                    <p>
                        <label for="edit_tiding_annotation">Краткая аннотация: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                        <textarea name="edit_tiding_annotation" id="edit_tiding_annotation" required><?= $row['short_annotation']; ?></textarea>
                    </p>
                </div>
                <div class="tiding_part">
                    <p>
                        <label for="edit_tiding_text">Текст: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                        <textarea name="edit_tiding_text" id="edit_tiding_text" required><?= $row['description']; ?></textarea>
                    </p>
                </div>
                <div class="tiding_part old-img">
                    <label>Выбранное изображение:</label>
                    <?php if ($row['img'] == null): ?>
                        <span>Изображение не блыо загружено!</span>
                    <?php else: ?>
                        <img src="data:image/png;base64, <?= base64_encode($row['img']); ?>" alt="Image">
                    <?php endif; ?>
                </div>
                <div class="tiding_part">
                    <p>
                        <label for="edit_tiding_img">Выбрать другие изображения:</label>
                        <input type="file" name="edit_tiding_img[]" id="edit_tiding_img" multiple accept=".jpg, .jpeg, .png">
                    </p>
                </div>
                <button type="submit" name="save_edit_tiding" value="<?= $row['id']; ?>">Сохранить</button>
            </form>
        </div>

    <?php endif; ?>

<?php endwhile; ?>


