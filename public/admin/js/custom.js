$(function () {
    'use strict'

    $('#btn_change_file').on('click', function () {
        $('#product_image').click();
    });

    $('#product_image').on('change', function () {
        readURL(this);
    });

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
