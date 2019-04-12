
function scoreImage(imageID,user,upDown,imageID) {
    var idScore = "galleryItemScoreText["+imageID+"]";
    var scoreElement = document.getElementsByClassName(idScore);
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

                scoreElement.innerHTML = parseInt(score) + 1;
                scoreIncrease = true;
                break;
            case 'down':
                scoreElement.innerHTML = parseInt(score) - 1;
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