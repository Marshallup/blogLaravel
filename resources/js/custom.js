$('.input-thumbnail-create').on('change', function(event) {
    var tgt = event.target || window.event.srcElement,
        files = tgt.files;

    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        let parent = $(this).parent().parent();
        fr.readAsDataURL(files[0]);
        fr.onload = function (event) {
            let imgPath = event.target.result;
            let img = new Image();
            img.src = imgPath;
            img.style.maxWidth = '300px';
            img.classList.add('preview-thumbnail');
            img.classList.add('mt-2');
            img.onload = function(event)
            {
                if($('.preview-thumbnail')) {
                    $('.preview-thumbnail').remove();
                    parent.after(img);
                } else {
                    parent.after(img);
                }
            }
        }
    }
    // Not supported
    else {
        // fallback -- perhaps submit the input to an iframe and temporarily store
        // them on the server until the user's session ends.
    }
})


let form = $('.form-ajax');
form.each(function(index, item)
{
    let jqItem = $(item);
    let inputs = jqItem.find('input');
    let submitBtn = jqItem.find('button');

    submitBtn.click(function (e) {
        e.preventDefault();
        var formData = {};
        inputs.each(function (index, item)
        {
            let jqElem = $(item);
            let name = jqElem.attr('name');
            let val = jqElem.val();
            formData[name] = val;
        })
        var type = "POST";
        var ajaxUrl = jqItem.attr('action');
        $.ajax({
            type: type,
            url: ajaxUrl,
            data: formData,
            dataType: 'json',
            complete: function(data) {

                let title = jqItem.find('input[name=title]').val();

                if(data.status === 200) {
                    if ($('.tags-list').length) {
                        jqItem.parents('tr').animate({
                            background: 'red',
                            opacity: 0,
                            height: 0,
                        }, 500, function() {
                            $(this).remove();
                            if ($('.form-ajax').length === 0) {
                                let href = window.location.href;
                                let numberPage = href.match(/\?page=([0-9]+)/)[1];
                                if (numberPage !== 1){
                                    let searchStr = 'page=' + numberPage;
                                    let replaceStr = 'page=' + (numberPage - 1);
                                    window.location.href = href.replace(searchStr, replaceStr);
                                }
                            }


                        })
                    }

                    if($('.page-tag-create')) {
                        $('.page-tag-create').prepend('<div style="display: none;" class="alert alert-success">Тег - "' + title + '" успешно создан</div>');
                        $('.alert-success').first().show(300, function() {
                            let thisMessage = $(this);
                            setTimeout(function() {
                                thisMessage.hide(300, function() {
                                    $(this).remove();
                                })
                            }, 2000)
                        })
                    }

                } else {
                    console.log('error', data);
                }

                jqItem[0].reset();

            }
        });
    });

})
let btnReply = $('.btn-reply');
if(btnReply.length) {
    btnReply.each(function(index, item) {
        let btn = $(item);
        btn.on('click', function (event) {
            $('.comment-form form').prepend("<input type='hidden' name='parent_id' value="+ $(this).data('comment-id') +" />")
        })
    })
    // console.log(btnReply.data('comment-id'))
}

function setArticleLike() {
    let go = true;
    const like = $('.like-post');
    const postId = like.data('post');
    const postAction = like.data('action');
    const csrf = like.data('csrf');
    const userLike = $('.last-user-like');
    const type = 'POST';
    const formData = {};
    formData.slug = postId;
    formData._token = csrf;


    if (go) {
        like.on('click', function (event) {
            event.preventDefault();
            go = false;
            // if (like.hasClass('active')) return;
            // like.addClass('active');
            // if (!like.hasClass('active')) {
            $.ajax({
                type: type,
                url: postAction,
                data: formData,
                dataType: 'json',
                beforeSend: function () {
                    // like.addClass('active');
                },
                complete: function (data) {
                    if (data.status === 200) {
                        let response = data.responseJSON;
                        userLike.text(response.user)
                        go = true;
                        // console.log(userLike.text)
                        // go = true;
                        // like.removeClass('active');

                    } else {
                        console.log('error', data);
                    }

                }
            });
            // go = false;
            // }
        })
    }
}
setArticleLike();
