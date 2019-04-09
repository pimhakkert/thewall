<?php session_start(); ?>
<html lang="en">
<?php include 'php_tools/settings.php';?>
<head>
    <title>The Wall</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Pim Hakkert, Rai Griffioen, Casper Matauschek">
    <meta name="viewport" content="user-scalable=no, width=device-width" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="icon" href="images/TheWallLogo.png">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.smoothState.min.js"></script>
    <script src="js/pagetransition.js"></script>
    <link rel="stylesheet" type="text/css" href="css/master2.scss">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>
<input type="checkbox" id="toggleMenu">
<div class="wrapper" id="main">
    <input type="checkbox" id="searchMenuToggle" style="transform: translateY(20em); opacity: 0;">

    <nav class="upperNav" style="height: 5em; background-color: dimgrey">
        <?php
        if(isset($_SESSION['username'])){
//            echo "<label class=\"uploadButtonLabel\" for=\"uploadButton\" id=\"uploadButton1\">Upload</label>";
            echo "<a href='php_tools/logout.php'><input type=\"button\" value=\"Logout\" name=\"button\" id=\"mobileLogout\"></a>";
        }
        else {
            echo "<input type=\"button\" value=\"Login\" onclick=\"location.href = 'login.php'\">";
        }
        ?>

    </nav>

    <div class="modalContent">
        <div class="modalItemTitle2"></div>
        <form class="modalUploadForm" action="" method="post" enctype="multipart/form-data">

            <div class="ModalUploadDiv">
                Select image to upload:
                <input class="modalUploadFile" type="file" name="fileToUpload" id="fileToUpload" accept="images/*">
            </div>
            <div class="modalUploadContent">
                <div>
                    <p>Title:</p>
                    <p>Description:</p>
                    <p style="margin-top: 4em">Tags:</p>
                </div>
                <div class="modalUploadInput">
                    <input class="modalUploadTitle" name="modalUploadTitle" type="text" >
                    <textarea class="modalUploadDescription" name="modalUploadDescription"></textarea>
                    <input class="modalUploadTags" name="modalUploadTags" type="text" >
                </div>
                <div class="modalUploadSubmit">
                    <input class="modalUploadSubmit" type="submit" value="Upload Image" name="submit">
                </div>


            </div>
        </form>
        <?php include 'php_tools/uploadbackend.php'; ?>
    </div>

    <nav class="customNavbar">
        <div class="navbarLogo" onclick="window.location = 'index.php';"><img class="navbarLogoImg" src="images/TheWallLogo.png" alt=""></div>
        <div class="navButtons">
            <?php
            if(isset($_SESSION['username'])){
                echo "<div class='navProfile navButton'><img class='navProfileIcon' src='images/angerypigeon.jpg' alt=''><h3 class='navProfileUsername'>XRaider</h3><h3 class='navProfilePosts'>Posts: 102</h3><a class='navProfileLogout' href='php_tools/logout.php'>Logout</a></div>";
//                echo "<button class=\"modalButton upload navButton\" id=\"uploadButton2\" type=\"button\" name=\"button\" style=\"margin-left: auto\">Upload</button>";
                //echo "<a href='php_tools/logout.php'><button class='navButton' type=\"button\" name=\"button\" id=\"logout\">Logout</button></a>";

            }
            else {
                echo "<button class=\"modalButton upload navButton\" id=\"uploadButton\" type=\"button\" name=\"button\" style=\"display: none\">Upload</button>";
                echo "<button class='navButton' type=\"button\" name=\"button\" onclick=\"location.href = 'login.php'\">Login</button>";
            }
            ?>
            <label for="toggleMenu" id="navHamburger">&#9776;</label>
<!--            <label for="searchMenuToggle" class="searchMenuToggle" style="font-size: 4em; margin-right: 10px">&#9776;</label>-->
        </div>

    </nav>

<!--    <nav class="searchMenu">-->
<!--        <input type="text" placeholder="Search..">-->
<!--        <button onclick="window.alert('Haha, werkt nog niet')">Search</button>-->
<!--        <select name="sortby" id="sortby">-->
<!--            <option value="sortby">Sort By</option>-->
<!--            <option value="newtoold">New/old</option>-->
<!--            <option value="oldtonew">Old/new</option>-->
<!--        </select>-->
<!--    </nav>-->

   <div class="dashboard" id="dashboard">
        <div class="dashboardBar" id="dashboardBar">Dashboard</div>
       <div style="overflow-y: scroll; grid-column-start: 1; grid-column-end: 3;">

       <form class="dashboardProfileSettings" style="width: 80vw">
           <h3 style="margin-bottom: 1em">Settings</h3>
            <div class="dashboardProfileSetting"><h5>Username:</h5><input name="newUsername" class="usernameSetting" type="text" value="CURRENTUSERNAME"></div>
           <div class="dashboardProfileSetting"><h5>Email:</h5><input name="newEmail" class="emailSetting" type="text" value="CURRENTEMAIL"></div>
           <div style="display: flex; justify-content: flex-end"><input name="SalamiMet" type="submit" class="dashboardEditButton" style="background-color: #1e7e34;" ></div>
       </form>
           <form action="" class="dashboardProfileSettings" style="width: 80vw;">
                 <div class="dashboardProfileSetting" style="width: 80vw"><h5>Profile-icon:</h5><br><input class="profileIconSetting" type="file" name="fileToUpload" id="fileToUpload" accept="images/*"></div>
                 <div style="display: flex; justify-content: flex-end"><input name="Kaas" type="submit" class="dashboardEditButton" style="background-color: #1e7e34;" ></div>
            </form>

       <div class="dashboardContent">
           <h3 style="margin-bottom: 1em">Posts</h3>

           <div class="dashboardItem"><h4 class="dashboardPostTitle">Title</h4><h4 class="dashboardPostUploadDate">upload-date</h4><button class="dashboardEditButton modalButton">Edit</button>

               <div class="modalContent">

                   <div class="modalItemTitle">
                       <h1><?php/* echo $image_results['image_title'];*/?></h1>
                   </div>

                   <div class="modalItemRight">
                       <div class="modalItemImg">
                           <img src="images/<?php /*echo $image_results['image_name'];?>"alt="Picture: <?php echo $image_results['image_title'];*/?>">
                       </div>
                   </div>

                   <div class="modalItemLeft">
                       <textarea class="modalItemDesc"> <?php/* echo $image_results['image_description'];*/?></textarea>
                       <h3 class="modalItemOwner">Uploaded by:<br><?php/* echo $username;*/?></h3>
                       <h6 class="modalItemDate"><?php/* echo $image_results['image_date'];*/?></h6>
                       <!--               Need to finish search functionality for following for loop to be completed.-->
                       <input type="text" placeholder="Tags" style="text-align: left; grid-row: 11; grid-column: 2;">
                       <div style="grid-row: 12; grid-column: 2; display: flex;margin-top: 1em;">
                           <input type="submit" style="flex-grow: 1;">
                           <button class="dashboardEditButton" style="justify-self: flex-end">Delete</button>
                       </div>
                   </div>

               </div>

           </div>
           <div class="dashboardItem"><h4 class="dashboardPostTitle">Title</h4><h4 class="dashboardPostUploadDate">upload-date</h4><button class="dashboardEditButton modalButton">Edit</button></div>
           <div class="dashboardItem"><h4 class="dashboardPostTitle">Title</h4><h4 class="dashboardPostUploadDate">upload-date</h4><button class="dashboardEditButton modalButton">Edit</button></div>
           <div class="dashboardItem"><h4 class="dashboardPostTitle">Title</h4><h4 class="dashboardPostUploadDate">upload-date</h4><button class="dashboardEditButton modalButton">Edit</button></div>
           <div class="dashboardItem"><h4 class="dashboardPostTitle">Title</h4><h4 class="dashboardPostUploadDate">upload-date</h4><button class="dashboardEditButton modalButton">Edit</button></div>
           <div class="dashboardItem"><h4 class="dashboardPostTitle">Title</h4><h4 class="dashboardPostUploadDate">upload-date</h4><button class="dashboardEditButton modalButton">Edit</button></div>
           <div class="dashboardItem"><h4 class="dashboardPostTitle">Title</h4><h4 class="dashboardPostUploadDate">upload-date</h4><button class="dashboardEditButton modalButton">Edit</button></div>
           <div class="dashboardItem"><h4 class="dashboardPostTitle">Title</h4><h4 class="dashboardPostUploadDate">upload-date</h4><button class="dashboardEditButton modalButton">Edit</button></div>
           <div class="dashboardItem"><h4 class="dashboardPostTitle">Title</h4><h4 class="dashboardPostUploadDate">upload-date</h4><button class="dashboardEditButton modalButton">Edit</button></div>
       </div>
       </div>
   </div>



    <script src="js/modal.js"></script>
    <script src="js/sessioncheck.js"></script>
</div>
<div class="footer"></div>
</body>
</html>