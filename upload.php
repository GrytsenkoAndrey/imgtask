<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 19.05.2020
 * Time: 19:10
 */
require_once 'constant.php';

if ($_POST['uploadSubmit']) {
    // Проверяем, нет ли ошибки при загрузке файлов
    if ($_FILES['file']['error'] == 0) {
        // Проверяем загружаемые файлы на соответствие mime-типам и максимальному размеру для загрузки
        if (in_array(mime_content_type($_FILES['file']['tmp_name']), FILE_TYPES) && $_FILES['file']['size'] < MAX_FILE_SIZE) {
            // Если временный файл существует, то выгружаем его в папку UPLOAD_PATH
            if (file_exists($_FILES['file']['tmp_name'])) {
                if (move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $_FILES['file']['name'])) {
                    echo "<img src='upload/" . $_FILES['file']["name"] . "' alt='" . $_FILES['file']["name"] . "'>";
                } else {
                    trigger_error('При загрузке файла "' . $_FILES['file']["name"] . '" произошла ошибка.');
                }
            } else {
               trigger_error('Временный файл "' . $_FILES['file']["name"] . '" отсутствует, выберите загружаемые файлы заново.');
            }
        } else {
            trigger_error('Файл "' . $_FILES['file']["name"] . '" не удовлетворяет требованиям к загрузке.');
        }
    } else {
        trigger_error("Файл не загружен.");
    }
}
