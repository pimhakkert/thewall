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

function sortFunction() {
    var searchQuery = null;
    var sort = document.getElementById("sortby").value;
    switch (sort) {
        case 'newtoold':
            sort = 'DESC';
            break;
        case 'oldtonew':
            sort = 'ASC';
            break;
        case 'lowtohigh':
            sort = 'SLH';
            break;
        case 'hightolow':
            sort = 'SHL';
            break;
    }

    if(getParameterByName('title')){
        searchQuery = getParameterByName('title');
        window.location = "index.php?title=" + searchQuery + "&order=" + sort;
    }
    else if(getParameterByName('tag')){
        searchQuery = getParameterByName('tag');
        window.location = "index.php?tag=" + searchQuery + "&order=" + sort;
    }
    else if(getParameterByName('user')){
        searchQuery = getParameterByName('user');
        window.location = "index.php?user=" + searchQuery + "&order=" + sort;
    }
    else {
        if(document.getElementById("searchMenuSelect").value !== '' && document.getElementById("searchInput").value !== ''){
            if(getParameterByName('title')){
                searchQuery = getParameterByName('title');
                window.location = "index.php?title=" + searchQuery + "&order=" + sort;
            }
            else if(getParameterByName('tag')){
                searchQuery = getParameterByName('tag');
                window.location = "index.php?tag=" + searchQuery + "&order=" + sort;
            }
            else if(getParameterByName('user')){
                searchQuery = getParameterByName('user');
                window.location = "index.php?user=" + searchQuery + "&order=" + sort;
            }
        }
        else {
            window.location = "index.php?order=" + sort;
        }
    }
}

function getParameterByName(variable)
{
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
}

//Mobile

function searchFunction2(){
    var selectOption = document.getElementById("searchSelect2").value;
    var searchQuery = document.getElementById("searchInput2").value;

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

function sortFunction2() {
    var searchQuery = null;
    var sort = document.getElementById("sortby2").value;
    switch (sort) {
        case 'newtoold':
            sort = 'DESC';
            break;
        case 'oldtonew':
            sort = 'ASC';
            break;
        case 'lowtohigh':
            sort = 'SLH';
            break;
        case 'hightolow':
            sort = 'SHL';
            break;
    }

    if(getParameterByName('title')){
        searchQuery = getParameterByName('title');
        window.location = "index.php?title=" + searchQuery + "&order=" + sort;
    }
    else if(getParameterByName('tag')){
        searchQuery = getParameterByName('tag');
        window.location = "index.php?tag=" + searchQuery + "&order=" + sort;
    }
    else if(getParameterByName('user')){
        searchQuery = getParameterByName('user');
        window.location = "index.php?user=" + searchQuery + "&order=" + sort;
    }
    else {
        if(document.getElementById("searchMenuSelect2").value !== '' && document.getElementById("searchInput2").value !== ''){
            if(getParameterByName('title')){
                searchQuery = getParameterByName('title');
                window.location = "index.php?title=" + searchQuery + "&order=" + sort;
            }
            else if(getParameterByName('tag')){
                searchQuery = getParameterByName('tag');
                window.location = "index.php?tag=" + searchQuery + "&order=" + sort;
            }
            else if(getParameterByName('user')){
                searchQuery = getParameterByName('user');
                window.location = "index.php?user=" + searchQuery + "&order=" + sort;
            }
        }
        else {
            window.location = "index.php?order=" + sort;
        }
    }
}