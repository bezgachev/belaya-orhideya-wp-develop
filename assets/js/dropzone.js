if ($('.input-file').length > 0) {

  var dt = new DataTransfer();

  $('.input-file input[type=file]').on('change', function () {
    let $files_list = $(this).closest('.input-file').next();
    $files_list.empty();

    for (var i = 0; i < this.files.length; i++) {
      let file = this.files.item(i);
      dt.items.add(file);

      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onloadend = function () {
        let new_file_input = '<div class="input-file-list-item">' +
          '<img class="input-file-list-img" src="' + reader.result + '">' +
          '<span class="input-file-list-name">' + file.name + '</span>' +
          '<a href="#" onclick="removeFilesItem(this); return false;" class="input-file-list-remove"></a>' +
          '</div>';
        $files_list.append(new_file_input);
      }
      $('.input-file').hide();
    };
    this.files = dt.files;


    files = this.files;
    let data = new FormData();
    // заполняем объект данных файлами в подходящем для отправки формате
    $.each(files, function (key, value) {
      data.append(key, value);
    });
    let th = $(this);
    let check = th.parents('.form').find('input[name="check"]').val();
    let check_nonce = th.parents('.form').find('input[name="check_nonce"]').val();
    data.append('action', 'load_file_action');
    data.append('check_nonce', check_nonce);
    data.append('check', check);
    console.log(data);
    let html = '';
    $.ajax({
      url: '/wp-admin/admin-ajax.php',
      type: 'POST', // важно!
      data: data,
      cache: false,
      dataType: 'json',
      // отключаем обработку передаваемых данных, пусть передаются как есть
      processData: false,
      // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
      contentType: false,
      // функция успешного ответа сервера
      success: function (respond, status, jqXHR) {
        if (typeof respond.error === 'undefined') {
          let files_path = respond.files;
          $.each(files_path, function (key, val) {
            let isLastElement = key == files_path.length - 1;
            if (isLastElement) {
              html += val;
            } else {
              html += val + "||";
            }
          });
          let file_name = th.parents('.form').find('input[name="file_name"]');
          if (file_name.length) {
            file_name.remove();
            th.parents('.form').find('.form__hidden_wp').append('<input type="hidden" name="file_name" value="' + html + '">');
          } else {
            th.parents('.form').find('.form__hidden_wp').append('<input type="hidden" name="file_name" value="' + html + '">');
          }
        }
      },
      // функция ошибки ответа сервера
      error: function (jqXHR, status, errorThrown) {
        console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
      }
    });

















  });

  function removeFilesItem(target) {
    let name = $(target).prev().text();
    let input = $(target).closest('.input-file-row').find('input[type=file]');
    $(target).closest('.input-file-list-item').remove();
    for (let i = 0; i < dt.items.length; i++) {
      if (name === dt.items[i].getAsFile().name) {
        dt.items.remove(i);
      }
    }
    input[0].files = dt.files;
    $('.input-file').show();
  }



  let dropArea = document.querySelector('.input-file-row');

  ['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false)
  });
  ['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false)
  });

  function highlight(e) {
    dropArea.classList.add('highlight')
  }
  function unhighlight(e) {
    dropArea.classList.remove('highlight')
  }


}