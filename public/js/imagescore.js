function scoreImage(imageID,user,upDown) {
    var scoreElement = document.getElementById("scoreText"+imageID);
    var upvote = document.getElementById("upvote"+imageID);
    var downvote = document.getElementById("downvote"+imageID);
    var score = scoreElement.innerHTML;
    var scoreIncrease = null;

    if(user===''){
        var stringEnd = '';
        switch (upDown) {
            case 'up':
                stringEnd = 'up';
                break;
            case 'down':
                stringEnd = 'down';
                break;
        }
        alert('You must be logged in to '+stringEnd+'vote!');
    }
    else {
        switch(upDown){
            case 'up':
                scoreIncrease = true;
                break;
            case 'down':
                scoreIncrease = false;
                break;
        }

        $.ajax({
            type: 'POST',
            data: {
                'scoreIncrease' : scoreIncrease,
                'imageId' : imageID,
                'user' : user
            },
            url: '../private/php_tools/scorebackend.php',
            success: function(data){
                switch(data){
                    case 'upvote':
                        scoreElement.innerHTML = parseInt(score)+1;
                        upvote.className = "galleryItemUpvoted";
                        break;
                    case 'downvote':
                        scoreElement.innerHTML = parseInt(score)-1;
                        downvote.className = "galleryItemDownvoted";
                        break;
                    case 'upvoteBack':
                        scoreElement.innerHTML = parseInt(score)-1;
                        upvote.className = "galleryItemUpvoteClear";
                        break;
                    case 'downvoteBack':
                        scoreElement.innerHTML = parseInt(score)+1;
                        downvote.className = "galleryItemDownvoteClear";
                        break;
                    case 'downvoteDouble':
                        scoreElement.innerHTML = parseInt(score)-2;
                        upvote.className = "galleryItemUpvoteClear";
                        downvote.className = "galleryItemDownvoted";
                        break;
                    case 'upvoteDouble':
                        scoreElement.innerHTML = parseInt(score)+2;
                        upvote.className = "galleryItemUpvoted";
                        downvote.className = "galleryItemDownvoteClear";
                        break;
                }
            }
        });
    }
}