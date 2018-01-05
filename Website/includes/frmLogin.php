<div id="frmLogin" class="loginForm">
    <form action="../WebServices/login.php" autocomplete="on">
        <div>
            <center><h2>Login</h2></center>
            <input name="username" type="text" placeholder="Username or Email" required id="frmLoginUsername"><br>
            <br>
            <input name="password"type="password" placeholder="Password" required id="frmLoginPassword"><br>
            <a style="position: relative; top: 3px;">Forgot your Password?</a>
            <br><br>
            <input name="submit" type="submit" formmethod="POST" class="submit" value="Submit"><br>
            <span style="position: relative; top: 3px;">Not A Member?</span><a href="#" id="registerBtnLogin" style="position: relative; top: 3px;">Register</a>
        </div>
    </form>
</div>