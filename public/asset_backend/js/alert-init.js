let msg = $('.msg-data');
if (msg.attr('data-msg')) {
    Swal.fire({
        title: msg.attr('data-msg'),
        icon: msg.attr('data-type'),
      });
}
 