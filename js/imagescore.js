
function scoreImage(imageID,user,upDown) {
    var scoreElement = document.getElementById("galleryItemScoreText");
    var score = scoreElement.value;
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
                scoreElement.innerHTML = ""+score+1;
                scoreIncrease = true;
                break;
            case 'down':
                scoreElement.innerHTML = score-1;
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
            url: 'php_tools/scorebackend.php',
            success: function(data){
                if(data==="downvote"||data==="upvote"){
                    alert('You can\'t '+data+' this image twice!');
                }
            }
        });
    }
}