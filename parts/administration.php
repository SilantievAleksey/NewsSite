<?php session_start(); ?>
<?php require_once 'connect.php'; ?>
<?php
    if (isset($_POST['exit'])){
        $_SESSION['auth'] = 'no';
        header('Location: news.php');
        die();
    }
?>
<?php
    if (isset($_POST['create_tiding'])){
        $date = date("Y-m-d H:i:s");
        $title = trim(htmlspecialchars($_POST['new_tiding_title']));
        $annotation = trim(htmlspecialchars($_POST['new_tiding_annotation']));
        $text = trim(htmlspecialchars($_POST['new_tiding_text']));
        if ($_FILES['new_tiding_img']['size'][0] > 0){
            $img = addslashes(file_get_contents($_FILES['new_tiding_img']['tmp_name'][0]));
            $link->query("INSERT INTO `news-lab-two` (`title`, `description`, `short_annotation`, `img`, `date_create`, `status`, `count_likes`) VALUES ('{$title}','{$text}', '{$annotation}', '{$img}', '{$date}' , 1, 0)");
            $id = $link->insert_id;
            for($i = 1; $i < count($_FILES['new_tiding_img']['name']); $i++){
                $img = addslashes(file_get_contents($_FILES['new_tiding_img']['tmp_name'][$i]));
                $link->query("INSERT INTO `different-news-img-lab2` (`id_news`, `img`) VALUES ({$id}, '{$img}')");
            }
        }
        else{
            $link->query("INSERT INTO `news-lab-two` (`title`, `description`, `short_annotation`, `date_create`, `status`, `count_likes`) VALUES ('{$title}','{$text}', '{$annotation}', '{$date}' , 1, 0)");
        }
        header("Location: {$_SERVER['PHP_SELF']}");
        die();
    }
?>
<?php
    if (isset($_POST['save_edit_tiding'])){
        $date = date("Y-m-d H:i:s");
        $id = (int)$_POST['save_edit_tiding'];
        $title = trim(htmlspecialchars($_POST['edit_tiding_title']));
        $annotation = trim(htmlspecialchars($_POST['edit_tiding_annotation']));
        $text = trim(htmlspecialchars($_POST['edit_tiding_text']));
        if ($_FILES['edit_tiding_img']['size'][0] > 0){
            $img = addslashes(file_get_contents($_FILES['edit_tiding_img']['tmp_name'][0]));
            $link->query("UPDATE `news-lab-two` SET `title` = '{$title}', `description` = '{$text}', `short_annotation` = '{$annotation}', `img` = '{$img}', `date_create` = '{$date}' WHERE `id` = {$id} ");
            $link->query("DELETE FROM `different-news-img-lab2` WHERE `id_news` = {$id} ");
            for($i = 1; $i < count($_FILES['edit_tiding_img']['name']); $i++){
                $img = addslashes(file_get_contents($_FILES['edit_tiding_img']['tmp_name'][$i]));
                $link->query("INSERT INTO `different-news-img-lab2` (`id_news`, `img`) VALUES ({$id}, '{$img}')");
            }
        }
        else{
            $link->query("UPDATE `news-lab-two` SET `title` = '{$title}', `description` = '{$text}', `short_annotation` = '{$annotation}', `date_create` = '{$date}' WHERE `id` = {$id} ");
        }
        header("Location: {$_SERVER['PHP_SELF']}");
        die();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Администрирование</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/news.css">
    <link rel="stylesheet" href="../css/administration.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../images/general/Logotip.ico" type="image/x-icon">
</head>
<body>

<?php require_once 'header.php'; ?>

<section class="content">
    <div class="container">
        <div class="main">

            <div class="create_tiding create_tiding_hide">
                <button type="button" name="look_create_tiding">Открыть форму создания новостей</button>
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" id="form_create_tiding" class="form_create_tiding" enctype="multipart/form-data">
                    <div class="tiding_part">
                        <p>
                            <label for="new_tiding_title">Заголовок: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                            <input type="text" name="new_tiding_title" id="new_tiding_title" required>
                        </p>
                    </div>
                    <div class="tiding_part">
                        <p>
                            <label for="new_tiding_annotation">Краткая аннотация: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                            <textarea name="new_tiding_annotation" id="new_tiding_annotation" required></textarea>
                        </p>
                    </div>
                    <div class="tiding_part">
                        <p>
                            <label for="new_tiding_text">Текст: <i class="fa fa-asterisk" aria-hidden="true"></i></label>
                            <textarea name="new_tiding_text" id="new_tiding_text" required></textarea>
                        </p>
                    </div>
                    <div class="tiding_part">
                        <p>
                            <label for="new_tiding_img">Изображения:</label>
                            <input type="file" name="new_tiding_img[]" id="new_tiding_img" multiple accept=".jpg, .jpeg, .png">
                        </p>
                    </div>
                    <button type="submit" name="create_tiding">Создать</button>
                </form>
            </div>

            <div class="sort_list_news">
                <span>
                    <label for="sort-date">Выберите хронологию новостей:</label>
                    <select id="sort-date" name="sort-date" class="select-css">
                        <option value="date-DESC">По убыванию даты</option>
                        <option value="date-ASC">По возрастанию даты</option>
                    </select>
                </span>
                <span>
                    <label for="sort-likes">Сортировать по лайкам</label>
                    <select id="sort-likes" name="sort-likes" class="select-css">
                        <option value="likes-ASC">По возрастанию</option>
                        <option value="likes-DESC">По убыванию</option>
                    </select>
               </span>
            </div>

            <div class="list_news"></div>

            <div class="popup-fade">
                <div class="popup">
                    <span class="popup-close" onclick="closeTiding(this)"><i class="fa fa-times fa-2x" aria-hidden="true"></i></span>
                    <div class="specific_tiding"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../scripts/news.js"></script>
<script src="../scripts/administration.js"></script>
</body>
</html>