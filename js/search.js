$('#searchButton').click(function() {
    var searchQuery = document.getElementById("searchInput").value;
    $.ajax({
        type: 'POST',
        data: {
            'query' : searchQuery
        },
        url: 'php_tools/search.php',
        success: function(data){
            if(data === "login"){
                window.location = 'login.php';
            }
        }
    });
});