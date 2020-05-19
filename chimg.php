<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 19.05.2020
 * Time: 20:16
 */
require_once 'CutImage.php';

if ($_POST) {
    $img = new CutImage($_POST['src'], [
        [
            10, 200, 150, 174,
        ],
        [
            170, 137, 150, 300,
        ],
        [
            330, 0, 150, 574,
        ],
        [
            490, 137, 150, 300,
        ],
        [
            650, 200, 150, 174,
        ],
    ]);

    echo $img->save('upload/new_source');
}