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

        success: function(data){
            //alert(data);
            event.target.innerText = event.target.innerText === 'Like' ? 'You like this post' : 'Like';
        }
    })
});

$(document).ready(function(){
    $('.commentContainer').hide();
   // var div = document.getElementsByClassName('commentContainer');
   // div.show();
});
$('.comment').on('click',function (event) {
    event.preventDefault();
   // var div = $('.commentContainer')
    //var div = $('#this').children('div .commentContainer');
    var div = document.getElementsByClassName('commentContainer');

    if ( div.style.display === "none" ) {
        event.target.innerText='cancle my comment';
        div.show();
    } else {
        event.target.innerText='leave a comment';
        div.hide();
    }
});