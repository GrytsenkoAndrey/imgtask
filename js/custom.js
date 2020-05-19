/**
 * Created by APG on 19.05.2020.
 */

/**
 * upload image
 */
function uploadFile()
{
    file = $('#file').files;
    // ничего не делаем если files пустой
    if (typeof file == 'undefined') {
        return;
    }
    var data = new FormData();
    data.append('uploadSubmit', 1);
    data.append('file', file);
    /*$.each(file, function (key, value) {
        data.append(key, value);
    });*/

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
}
