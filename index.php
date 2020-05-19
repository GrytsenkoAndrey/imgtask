<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 19.05.2020
 * Time: 18:47
 */
require_once 'constant.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Player</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
   <!-- <script type="text/javascript" src="/js/custom.js"></script>-->



    <style>

    </style>
</head>
<body>

<input type="file" name="file" id="file">

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

         $.ajax({
             type: "POST",
             url: "upload.php",
             data: data,
             processData: false,
             contentType: false,
             success: function (data) {
                 $('#imgBox').html(data);
             }
         });
    });

</script>
</body>
</html>
