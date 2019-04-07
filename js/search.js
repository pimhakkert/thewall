function searchFunction(){
    var selectOption = document.getElementById("searchMenuSelect").value;
    var searchQuery = document.getElementById("searchInput").value;

    switch (selectOption) {
        case 'title':
            window.location = "index.php?title=" + searchQuery;
            break;
        case 'tag':
            window.location = "index.php?tag=" + searchQuery;
            break;
        case 'user':
            window.location = "index.php?user=" + searchQuery;
            break;
    }
}
