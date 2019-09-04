$(function () {
    'use strict'

    $('#btn_change_file').on('click', function () {
        $('#product_image').click();
    });

    $('#product_image').on('change', function () {
        readURL(this);
    });

    // function uploadFile(img) {
    //     var form_data = new FormData();
    //     form_data.append('file', img.files[0]);
    //     form_data.append('_token', '{{csrf_token()}}');
    //     $('#loading_image').css('display', 'block');
    //     $.ajax({
    //         url: "{{url('ajax-image-upload')}}",
    //         data: form_data,
    //         type: 'POST',
    //         contentType: false,
    //         processData: false,
    //         success: function (data) {
    //             if (data.fail) {
    //                 $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
    //                 alert(data.errors['file']);
    //             }
    //             else {
    //                 $('#file_name').val(data);
    //                 $('#preview_image').attr('src', '{{asset('uploads')}}/' + data);
    //             }
    //             $('#loading_image').css('display', 'none');
    //         },
    //         error: function (xhr, status, error) {
    //             alert(xhr.responseText);
    //             $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
    //         }
    //     });
    // }

    // function removeFile() {
    //     if ($('#file_name').val() != '') {
    //         if (confirm('Are you sure want to remove profile picture?')) {
    //             $('#loading_image').css('display', 'block');
    //             var form_data = new FormData();
    //             form_data.append('_method', 'DELETE');
    //             form_data.append('_token', '{{csrf_token()}}');
    //             $.ajax({
    //                 url: "ajax-remove-image/" + $('#file_name').val(),
    //                 data: form_data,
    //                 type: 'POST',
    //                 contentType: false,
    //                 processData: false,
    //                 success: function (data) {
    //                     $('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
    //                     $('#file_name').val('');
    //                     $('#loading_image').css('display', 'none');
    //                 },
    //                 error: function (xhr, status, error) {
    //                     alert(xhr.responseText);
    //                 }
    //             });
    //         }
    //     }
    // }

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#preview_image').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }
})
