<header class="header_full">
    <a href="../GUI/"><img class="logo" alt="logo" src="/Media/devlancer_vertical.png"></a>
    <div class="header_content">
        <nav class="header_top">
            <ul class="left_nav">
                <li class="header_hire">
                    <a href="PostAProject">Post A Project</a>
                </li>
                <li class="header_work">
                    <a href="FindWork">Find work</a>
                </li>
            </ul>
            <ul class="right_nav">
                <li>
                    <a href="#" onclick="document.getElementById('frmRegister').style.display = 'block';">Become a member</a>
                </li>
                <li>
                    <a href="#" onclick="document.getElementById('frmLogin').style.display = 'block';">Already a member? Log In</a>
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
<?php
    require_once '../includes/frmLogin.php';
    require_once '../includes/frmRegister.php';
?>