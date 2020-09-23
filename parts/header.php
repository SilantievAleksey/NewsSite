<header>
    <div class="container">
        <div class="menu">
            <div class="logo">
                <img src="../images/general/Logo.png" alt="Image">
            </div>
            <div class="list">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <ul>
                        <?php
                            $months = ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"];
                        ?>
                        <li><p id="time"><?= date("j") . " " . $months[date("n")] . " " . date("Y") . " г. " . date('H:i:s'); ?></p></li>
                        <li><a href="news.php"><i class="fa fa-home fa-2x" aria-hidden="true" title="Главная страница"></i></a></li>
                        <li><a href="entrance.php"><i class="fa fa-cog fa-2x" aria-hidden="true" title="Администрирование"></i></a></li>
                        <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] == 'yes'): ?>
                            <li><button type="submit" name="exit"><i class="fa fa-sign-out fa-4x" aria-hidden="true" title="Выход"></i></button></li>
                        <?php endif; ?>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</header>

