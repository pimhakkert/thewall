function scoreImage(imageID, upDown) {
    var scoreElement = document.getElementById("galleryItemScoreText");
    var score = scoreElement.value;
    var scoreIncrease = null;

    switch(upDown){
        case 'up':
            scoreElement.innerHTML = score+1;
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
            'imageId' : imageID
        },
        url: 'php_tools/scorebackend.php',
        success: function(data){
            console.log(data);
        }
    });
}