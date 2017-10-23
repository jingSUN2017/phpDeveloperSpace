var postId = 0;
var postBodyElement = null;

$('.like').on('click', function(event) {
    event.preventDefault();
    postId = event.target.parentNode.parentNode.parentNode.dataset['postid'];
    var isLike = true;
    $.ajax({
        header: {"X-CSRF-Token": token},
        method: 'POST',
        url: urlLike,
        data: {'isLike': isLike, 'postId': postId, '_token': token},

        success: function(data){
            //alert(data);
            event.target.innerText = event.target.innerText === 'Like' ? 'You like this post' : 'Like';
            window.location.reload();
        }
    })
});

$('.editMyBlog').on('click', function (event) {
    event.preventDefault();
    jQuery.noConflict();

    postBodyElement = event.target.parentNode.parentNode.parentNode.lastElementChild;
    postId = event.target.parentNode.parentNode.parentNode.dataset['postid'];

    var postBody = postBodyElement.textContent;
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click', function () {
    $.ajax({
        header: {"X-CSRF-Token": token},
        method: 'POST',
        url: urlEdit,
        data: {'body': $('#post-body').val(), 'postId': postId, '_token': token},

        success:function(msg){
            $(postBodyElement).text(msg['new_body']);
            $('#edit-modal').modal('hide');
        }
    })
});
