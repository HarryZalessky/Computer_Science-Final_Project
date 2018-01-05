<header class="header_full">
    <img class="logo" alt="logo" src="/Media/devlancer_vertical.png">
    <div class="header_content">
        <nav class="header_top">
            <ul class="nav">
                <li class="header_hire">
                    <a href="Post A Project/index.php">Post A Project</a>
                </li>
                <li class="header_work">
                    <a href="Find Work/index.php">Find work</a>
                </li>
                <li>
                    <input type="search">
                </li>
                <li>
                    <!--updates-->
                </li>
                <li>
                    <!--messages-->
                </li>
                <li style="top:0;">
                    <?php
                        //require_once '../includes/userMenu.php';
                    ?>
                    <img src="../profile_images/<?php if(isset($_SESSION["profile_image"])){echo $_SESSION["profile_image"];} else {echo "default.jpg";}?>" alt="Profile Image" />                    
                </li>
            </ul>
        </nav>
        <nav class="header_bottom">
            <ul class="left_nav">
                <li>
                    <a class="header_faq">FAQ</a>
                </li>
                <li>
                    <a class="header_community">Community</a>
                </li>
                <li>
                    <a class="header_blog">Blog</a>
                </li>
                <li>
                    <a class="header_about">About Us</a>
                </li>
            </ul>
            <ul class="right_nav">
                <li>
                    <a class="header_contactus">Contact Us</a>
                </li>
                <li class="header_social">
                    <!--add social media links here-->
                </li>
            </ul>
        </nav>
    </div>
</header>