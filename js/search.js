$('#searchButton').click(function() {
    var searchQuery = document.getElementById("searchInput").value;
    window.location = "index.php?tag=" + searchQuery;
});