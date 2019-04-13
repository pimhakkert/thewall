function scoreImage(imageID,user,upDown) {
    var scoreElement = document.getElementById("scoreText"+imageID);
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
            url: 'php_tools/scorebackend.php',
            success: function(data){
                alert(data);
                switch(data){
                    case 'upvote':
                        scoreElement.innerHTML = parseInt(score)+1;
                        //hold upvote div.
                        break;
                    case 'downvote':
                        scoreElement.innerHTML = parseInt(score)-1;
                        //hold downvote div.
                        break;
                    case 'upvoteBack':
                        scoreElement.innerHTML = parseInt(score)-1;
                        //hold no div.
                        break;
                    case 'downvoteBack':
                        scoreElement.innerHTML = parseInt(score)+1;
                        //hold no div.
                        break;
                    case 'downvoteDouble':
                        scoreElement.innerHTML = parseInt(score)-2;
                        //hold upvote div.
                        break;
                    case 'upvoteDouble':
                        scoreElement.innerHTML = parseInt(score)+2;
                        //hold downvote div.
                        break;
                }
            }
        });
    }
}