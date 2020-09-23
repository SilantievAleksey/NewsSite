<?php
    require_once 'connect.php';
    $result = $link->query("SELECT * FROM `news-lab-two` WHERE `id` = {$_POST['id']}")->fetch_assoc();
    $othersImages = $link->query("SELECT * FROM `different-news-img-lab2` WHERE `id_news` = {$_POST['id']} LIMIT 3 ");
?>

<div class="tiding full_tiding" id="tiding-<?= $result['id']; ?>">
    <div class="tiding-img">
        <?php if ($result['img'] == null): ?>
            <img src="../images/general/NotLoadImage.png" alt="Image">
        <?php else: ?>
            <img src="data:image/png;base64, <?= base64_encode($result['img']); ?>" alt="Image">
        <?php endif; ?>
        <div class="tiding-title">
            <b><?= $result['title'] ?></b>
        </div>
        <div class="tiding-description">
            <p><?= nl2br($result['description']); ?></p>
        </div>
    </div>
    <div class="tiding-all_description">
        <?php if ($othersImages->num_rows > 0): ?>
            <div class="others_images">
                <p>Другие изображения этой новости:</p>
                <?php while ($img = $othersImages->fetch_assoc()): ?>
                    <img src="data:image/png;base64, <?= base64_encode($img['img']); ?>" alt="Image">
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <div class="tiding-date_create">
            <?php $months = ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"]; ?>
            <p><?= "Дата публикации: " . date("j") . " " . $months[date("n")] . " " . date("Y") . " г. " . date('H:i'); ?></p>
        </div>
        <div class="tiding-details">
            <span id="put_like_full-<?= $result['id']; ?>" class="put_tiding" title="Поставить лайк" onclick="putLike(this)"><i class="fa fa-heart-o fa-2x like-n" aria-hidden="true"></i></span>
            <small id="count_likes_full-<?= $result['id']; ?>"><?= $result['count_likes']; ?></small>
        </div>
    </div>
</div>



