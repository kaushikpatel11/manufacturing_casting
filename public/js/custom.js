$(document).ready(function(){

  $(document).on('click', '.btn-delete-record', function () {

    $text = 'Are you sure ?';

    if ($(this).attr('title') == "delete user")
    {
        $text = 'Are you sure you want to delete this user ?';
    }

    if (confirm($text))
    {
        $url = $(this).attr('href');
        $('#global_delete_form').attr('action', $url);
        $('#global_delete_form #delete_id').val($(this).data('id'));
        $('#global_delete_form').submit();
    }

    return false;
});

  
  
});



showSwal = function(type,text){
        'use strict';
        if(type === 'success-message'){
            swal({
              title: '',
              text: text,
              timer: 2000
            }).then(
            function () {},
              // handling the promise rejection
            function (dismiss) {
              if (dismiss === 'timer') {
                console.log('I was closed by the timer')
              }
            }
          )
        }else if(type === 'error-message'){
            swal({
              title: '',
              text: text,
              timer: 2000
            }).then(
            function () {},
              // handling the promise rejection
            function (dismiss) {
              if (dismiss === 'timer') {
                console.log('I was closed by the timer')
              }
            }
          )
        } 
    }
function validateImage(id) {
    var formData = new FormData();
    var file = document.getElementById(id).files[0];
 
    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
        $('#AjaxLoaderDiv').fadeOut('slow');
        $.bootstrapGrowl("Please select a valid image file.", {type: 'danger', delay: 4000});
        document.getElementById(id).value = '';
        return false;
    }
    return true;
}
