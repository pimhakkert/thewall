$('#uploadButton1').click(function() {
    $.ajax({
        type: 'POST',
        url: 'php_tools/sessioncheck.php',
        success: function(){
            alert('SUCCESS');
        }
    });
});

$('#uploadButton2').click(function() {
    $.ajax({
        type: 'POST',
        data: {
          'return' : null
        },
        url: 'php_tools/sessioncheck.php',
        success: function(data){
            if(data === "login"){
                 window.location = 'login.php';
            }
        }
    });
});