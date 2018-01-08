<div id="frmRegister" class="dimBackground">
    <form class="regFrm" action="../WebServices/registration.php">
        <div>
            <center><h2>Register</h2></center>
            <center><input type="email" name="email" placeholder="Email" required><br>
            <br>
            <input type="text" name="username" placeholder="Username" required><br>
            <br>
            <input type="password" id="password1" name="password" placeholder="Password" required><br>
            <br>
            <input type="password" id="password2" placeholder="Password again" required oninput="check(this)"></center>
            <br>
            <span>What do want to do? </span>
            <input type="radio" name="action_group" value="work" id="action_group-work" checked><label for="action_group-work">Work</label>
            <input type="radio" name="action_group" value="hire" id="action_group-hire"><label for="action_group-hire">Hire</label>
            <input type="submit" name="submit" formmethod="POST" class="submit"><br>
            <span style="position: relative; top: 15px;">Already A Member?</span><a href="#" onclick="
                                                                                document.getElementById('frmLogin').style.display = 'block';
                                                                                document.getElementById('frmRegister').style.display = 'none';
                                                                                " style="position: relative; top: 15px;">Log In</a>
        </div>
    </form>
</div>