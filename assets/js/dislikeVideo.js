function dislikeVideo(button, videoId,username) {
    var dataInput = [];
        dataInput[0] = videoId;
        dataInput[1] = username;
    $.post("ajax/dislikeVideo.php", {'dataInput' : dataInput})
    .done(function(data) {
        
        var dislikeButton = $(button);
        var likeButton = $(button).siblings(".likeButton");

        dislikeButton.addClass("active");
        likeButton.removeClass("active");

        var result = JSON.parse(data);
        updateLikesValue(likeButton.find(".text"), result.likes);
        updateLikesValue(dislikeButton.find(".text"), result.dislikes);

        if(result.dislikes < 0) {
            dislikeButton.removeClass("active");
            dislikeButton.find("img:first").attr("src", "assets/images/icons/thumb-down.png");
        }
        else {
            dislikeButton.find("img:first").attr("src", "assets/images/icons/thumb-down-active.png")
        }

        likeButton.find("img:first").attr("src", "assets/images/icons/thumb-up.png");
    });
}

function updateLikesValue(element, num) {
    var likesCountVal = element.text() || 0;
    element.text(parseInt(likesCountVal) + parseInt(num));
}