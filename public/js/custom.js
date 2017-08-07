var postId = 0;

$('.like').on('click', function(event) {
    event.preventDefault();
    postId = event.target.parentNode.parentNode.parentNode.dataset['postid'];
    var isLike = true;
    $.ajax({
        header: {"X-CSRF-Token": token},
        type: 'POST',
        url: urlLike,
        data: {'isLike': isLike, 'postId': postId, '_token': token},

        success: function(){
            //alert(data);
            event.target.innerText = event.target.innerText === 'Like' ? 'You like this post' : 'Like';
        }
    })
});