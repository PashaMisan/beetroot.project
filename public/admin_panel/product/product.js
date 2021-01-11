function changeStatus(id) {
    var $status_botton = $('#' + id);
    $.ajax({
        url: change_product_status_ajax,
        type: "POST",
        data: {
            "_token": csrf,
            'id': id
        },
        dataType: 'json',
        success: function (data) {
            if (data.status){
                $status_botton.text('On');
                $status_botton.toggleClass('text-danger text-success');
            } else {
                $status_botton.text('Off');
                $status_botton.toggleClass('text-success text-danger');
            }
        },
        error: function (msg) {
            alert('Ошибка');
        }
    });
}
