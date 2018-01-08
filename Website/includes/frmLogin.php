<div id="frmLogin" class="dimBackground" <?php if(isset($_GET['popup']) && $_GET['popup'] == 'login'){echo 'style="display:block;"';} ?>>
    <form class="logFrm" action="../WebServices/login.php" autocomplete="on">
        <div>
            <?php
                if(isset($_GET['errno'])) {
                    $errmsg;
                    switch ($_GET['errno']) {
                        case 1:
                            $errmsg = "Such user does't exist. Register?";
                            break;
                        case 2:
                            $errmsg = "Username or password incorrect, try again.";
                            break;
                        case 3:
                            $errmsg = "Your email verification code seems outdated, we just sent you an email with an updated code.";
                            break;
                        default:
                            $errmsg = "An error has occured, try again later.";
                            break;
                    }
                    echo '<span class="errMsg">'.$errmsg.'</span>';
                }
            ?>
            <center><h2>Login</h2></center>
            <input name="username" type="text" placeholder="Username or Email" required id="frmLoginUsername" <?php if(isset($_GET['username'])){echo 'value="'.$_GET["username"].'"';} ?>><br>
            <br>
            <input name="password" type="password" placeholder="Password" required id="frmLoginPassword"><br>
            <a style="position: relative; top: 3px;">Forgot your Password?</a>
            <br><br>
            <input name="submit" type="submit" formmethod="POST" class="submit" value="Submit"><br>
			<input type="checkbox" name="remember"><span>Remember Me</span><br><br>
            <span style="position: relative; top: 3px;">Not A Member?</span><a href="#" onclick="
                                                                            document.getElementById('frmLogin').style.display = 'none';
                                                                            document.getElementById('frmRegister').style.display = 'block';
                                                                            " style="position: relative; top: 3px;">Register</a>
        </div>
    </form>
</div>