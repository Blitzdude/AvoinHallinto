<div id="loginBox">
    <fieldset>
    <legend>Login</legend>
    <form id="frmLogin" action="index.php" method="POST" >
<?php
        if (true == $loginFailed)
            echo "<label id='lblError'>Login failed</label><br>";
?>
        <label id="lblUsername">Sähköposti</label><br>
        <input type="text" name="teUsername" id="teUsername" required /><br>
        <label id="lblPassword">Password</label><br>
        <input type="password" name="pwPassword" id="pwPassword" /><br>
        <input type="submit" id="sbmtLogin" value="Login" required />
    </form>
    </fieldset>
</div>
