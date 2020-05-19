<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 19.05.2020
 * Time: 20:16
 */
require_once 'CutImage.php';
/**
 * изменяем изображение после загрузки
 *
 * @param string $srcName
 * @param string $outFileName
 * @param int $w
 */
function transformImage($srcName, $outFileName, $resX, $resY, $w, $h)
{
    # create resource
    $src = imagecreatefromjpeg($srcName);
    # new file resource
    $nfile = imagecreate($w+400, $h+400);
    # background
    imagecolorallocate($src, 255, 255, 255);
    # copy & resize
    imagecopyresampled($nfile, $src, 0, 0, $resX, $resY, $w, $h, $w, $h);
    imagecopyresampled($nfile, $src, $w+10, 0, $resX, $resY, $w, $h, $w, $h);

    imagejpeg($nfile, $outFileName, 100);
}

if ($_POST) {
    $img = new CutImage('upload/source.jpg', [
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

    echo $img->save('new_source');
}