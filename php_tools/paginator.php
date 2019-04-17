<?php
// range of num links to show
$range = 3;
echo "<div class='pagination_div'>";
if ($currentpage > 1) {
    // show << link to go back to page 1
    if(isset($_GET['page']))
    {
        $url = substr($_SERVER['REQUEST_URI'], 0, -1).'1';
        echo " <a class='pagination_begin' href='$url'><<</a> ";
    }
    elseif(isset($_GET['title'])||isset($_GET['order'])||isset($_GET['tag'])||isset($_GET['user'])) {
        echo " <a class='pagination_begin' href='{$_SERVER['REQUEST_URI']}&page=1'><<</a> ";
    }
    else{
        echo " <a class='pagination_begin' href='{$_SERVER['REQUEST_URI']}?page=1'><<</a> ";
    }
    // get previous page num
    $prevpage = $currentpage - 1;
    // show < link to go back to 1 page
    if(isset($_GET['page']))
    {
        $url = substr($_SERVER['REQUEST_URI'], 0, -1).$prevpage;
        echo " <a class='pagination_back' href='$url'><</a> ";
    }
    elseif(isset($_GET['title'])||isset($_GET['order'])||isset($_GET['tag'])||isset($_GET['user'])) {
        echo " <a class='pagination_back' href='{$_SERVER['REQUEST_URI']}&page=$prevpage'><</a> ";
    }
    else{
        echo " <a class='pagination_back' href='{$_SERVER['REQUEST_URI']}?page=$prevpage'><</a> ";
    }

} // end if

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
    // if it's a valid page number...
    if (($x > 0) && ($x <= $totalpages)) {
        // if we're on current page...
        if ($x == $currentpage) {
            // 'highlight' it but don't make a link
            echo "<b class='pagination_middle'>$x</b>";
            // if not current page...
        } else {
            // make it a link
            if(isset($_GET['page']))
            {
                $url = substr($_SERVER['REQUEST_URI'], 0, -1).$x;
                echo " <a class='pagination_middle' href='$url'>$x</a> ";
            }
            elseif(isset($_GET['title'])||isset($_GET['order'])||isset($_GET['tag'])||isset($_GET['user'])) {
                echo " <a class='pagination_middle' href='{$_SERVER['REQUEST_URI']}&page=$x'>$x</a> ";

            }
            else{
                echo " <a class='pagination_middle' href='{$_SERVER['REQUEST_URI']}?page=$x'>$x</a> ";

            }
        } // end else
    } // end if
} // end for

// if not on last page, show forward and last page links
if ($currentpage != $totalpages) {
    // get next page
    $nextpage = $currentpage + 1;
    // echo forward link for next page
    if(isset($_GET['page']))
    {
        $url = substr($_SERVER['REQUEST_URI'], 0, -1).$nextpage;
        echo " <a class='pagination_forward' href='$url'>></a> ";
    }
    elseif(isset($_GET['title'])||isset($_GET['order'])||isset($_GET['tag'])||isset($_GET['user'])) {
        echo " <a class='pagination_forward' href='{$_SERVER['REQUEST_URI']}&page=$nextpage'>></a> ";
    }
    else{
        echo " <a class='pagination_forward' href='{$_SERVER['REQUEST_URI']}?page=$nextpage'>></a> ";
    }

    // echo forward link for lastpage
    if(isset($_GET['page']))
    {
        $url = substr($_SERVER['REQUEST_URI'], 0, -1).$totalpages;
        echo " <a class='pagination_end' href='$url'>>></a> ";
    }
    elseif(isset($_GET['title'])||isset($_GET['order'])||isset($_GET['tag'])||isset($_GET['user'])) {
        echo " <a class='pagination_end' href='{$_SERVER['REQUEST_URI']}&page=$totalpages'>>></a> ";
    }
    else{
        echo " <a class='pagination_end' href='{$_SERVER['REQUEST_URI']}?page=$totalpages'>>></a> ";
    }
} // end if
echo "</div>";
?>