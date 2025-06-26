(function($) {
  'use strict';
  $(function() {
    var todoListItem = $('.todo-list');
    var todoListInput = $('.todo-list-input');
    
    $('.todo-list-add-btn').on("click", function(event) {
      event.preventDefault();

      var item = $(this).prevAll('.todo-list-input').val();

      if (item) {
        // Gunakan struktur HTML yang sama persis dengan template asli
        // PENTING: Hapus <i class='input-helper'></i> dan tambahkan class form-check-input
        todoListItem.append(
          "<li>" +
            "<div class='form-check'>" +
              "<label class='form-check-label'>" +
                "<input class='checkbox form-check-input' type='checkbox'>" +
                item +
              "</label>" +
            "</div>" +
            "<i class='remove ti-close'></i>" +
          "</li>"
        );
        todoListInput.val("");
      }
    });

    // Perbaiki event handler untuk checkbox
    todoListItem.on('change', '.checkbox', function() {
      // Gunakan prop() instead of attr() untuk boolean properties
      if ($(this).prop('checked')) {
        $(this).closest("li").addClass('completed');
      } else {
        $(this).closest("li").removeClass('completed');
      }
    });

    todoListItem.on('click', '.remove', function() {
      $(this).parent().remove();
    });

    // Tambahan: Handle enter key pada input
    todoListInput.on('keypress', function(e) {
      if (e.which === 13) { // Enter key
        $('.todo-list-add-btn').click();
      }
    });

  });
})(jQuery);