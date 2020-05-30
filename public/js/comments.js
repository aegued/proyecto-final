$(function () {

    let form = $('#commentsForm');
    let loading = '<span class="spinner-border spinner-border-sm mr-3" role="status" aria-hidden="true"></span>' +
        '<span>Enviando...</span>';
    let btn = form.find('#sendMessageButton');
    let success = form.find('#success');
    let textError = form.find('.help-block');
    let commentList = $('#comments-list');

    form.submit(function (e) {
        e.preventDefault();

        success.html('');
        textError.text('');

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            beforeSend: function () {
                btn.html(loading);
            },
            success: function (response) {
                console.log(response);
                btn.html('Enviar');
                form[0].reset();

                success.html(
                    '<div class="alert alert-success">'+response.success+'</div>'
                );

                commentList.append(
                    '<div class="list-group-item list-group-item-info">' +
                    '<div class="d-flex w-100 justify-content-between">' +
                    '<h5 class="mb-1"><a href="'+response.commentUserUrl+'"></a>'+response.commentUser[0].name+'</h5>' +
                    '<small>'+response.comment.createdDate+'</small>' +
                    '</div>' +
                    '<p class="mb-1">'+response.comment.text+'</p>' +
                    '</div>'
                );
            },
            error: function (response) {
                let responseText = response.responseJSON.error;
                btn.html('Enviar');
                console.log(response.responseJSON.error.text);

                if (responseText.text)
                    textError.text(responseText.text);
            }
        });
    });

})
