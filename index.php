<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 19.05.2020
 * Time: 18:47
 */
require_once 'constant.php';
require_once 'CutImage.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Player</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.imgareaselect.js"></script>
</head>
<body>

<input type="file" name="file" id="file" accept="<?= implode(',', FILE_TYPES) ?>">

<div id="loadStatus"></div>
<div id="imgBox"></div>


<script>
    $('#file').on('change', function(){
        file = this.files[0];
        // ничего не делаем если files пустой
        if (typeof file == 'undefined') {
            return;
        }


         var data = new FormData();
         data.append('uploadSubmit', 1);
         data.append('file', file);

        // загружаем изображение
         $.ajax({
             type: "POST",
             url: "upload.php",
             data: data,
             processData: false,
             contentType: false,
             success: function (data) {
                 $('#imgBox').html(data);

                 // обрезаем изображение
                 $.ajax({
                     type:'POST',
                     url:'chimg.php',
                     data:{'src': $('img').attr('src')},
                     success: function (data) {
                         $('img').remove();
                         $('#imgBox').html(data);
                         console.log('update');
                     }
                 });
             }

         });
    });


</script>

</body>
</html>
