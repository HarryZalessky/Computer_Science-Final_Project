<div class="dimBackground" id="userMenu">
    <ul class="user_menu">
        <li class="user-data">
            <!--Profile image + name + membership type-->
            <img src="../profile_images/<?php if(isset($_SESSION["profile_image"])){echo $_SESSION["profile_image"];} else {echo "default.jpg";}?>" alt="Profile Image" />
            <br>
            <span><?php echo $_SESSION['full_name']; ?></span>
            <span><!--membership type + upgrade--></span>
        </li>
        <li>
            <!--profile-->
        </li>
        <li>
            <!--dashboard-->
        </li>
        <li>
            <!--settings-->
            <a></a>
        </li>
        <li>
            <a class="logout" href="/WebServices/logout.php" onclick="">Logout</a>
        </li>
    </ul>
</div>