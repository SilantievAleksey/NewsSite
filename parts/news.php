<?php session_start(); ?>
<?php require_once 'connect.php'; ?>
<?php
    if (isset($_POST['exit'])){
        $_SESSION['auth'] = 'no';
        header('Location: news.php');
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
    <title>Новости</title>
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

<?php if (!empty($_GET['sort'])): ?>
    <script>
        editSelected();
    </script>
<?php endif; ?>

</body>
</html>