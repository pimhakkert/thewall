$('#uploadButton1').click(function() {
    $.ajax({
        type: 'POST',
        data: {
            'return' : null
        },
        xhrFields: {
          withCredentials: true
        },
        url: 'php_tools/sessioncheck.php',
        success: function(data){
            console.log(data);
            if(data === "login"){
                window.location = 'login.php';
            }
        }
    });
});

$('#uploadButton2').click(function() {
    $.ajax({
        type: 'POST',
        data: {
          'return' : null
        },
        xhrFields: {
            withCredentials: true
        },
        url: 'php_tools/sessioncheck.php',
        success: function(data){
            if(data === "login"){
                 window.location = 'login.php';
            }
        }
    });
});