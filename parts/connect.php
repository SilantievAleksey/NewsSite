<?php

    $link = new mysqli('localhost', 'root', '', 'labs') or die('Соединение не установленно!');
    $link->set_charset("utf8") or die('Кодировка не установленна!');
