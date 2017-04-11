<?php
include "includes/header.php";
include "classes/ClassUser.php";
include "classes/ClassMyOrganization.php";
include "classes/ClassMyGroup.php";
include "classes/ClassGroupMember.php";
include "classes/ClassMyMeeting.php";
include "classes/ClassCase.php";
include "classes/ClassInclude.php";

$loginFailed=false;
if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
    if (isset($_POST["teUsername"]) && isset($_POST["pwPassword"]))
    {
        $username = test_input($_POST["teUsername"]);
        $password = test_input($_POST["pwPassword"]);

        $user = checkLoginFromDB($username, $password);
        if ($user)
        {
            $_SESSION['logged_user'] = $user;
        }
        else
        {
            $loginFaild=true;
        }
    }
}

// Loads all public visible data if it is not loaded
if (!isset($_SESSION['public_data']))
{
    include "loadPublicData.php";
}

// If we dont have user for session, add login box
if (!isset($_SESSION['logged_user']))
{
    include "login.php";
}
else
{
    // Load user data
    loadUserData($_SESSION['logged_user']);

    // If user can create new users, add button
    if (true == canCreateUser())
    {
        ?>
        <div id="createUserButton">
            <form id="createUserButton" action="register.php">
                <button type="submit"> Luo käyttäjä</button>
            </form>
        </div>
        <?php
    }

    if (true == canCreateCase())
    {
        ?>
        <div id="createCaseButton">
            <form id="createCaseButton" action="createCase.php">
                <button type="submit"> Luo aloite</button>
            </form>
        </div>
        <?php
    }

    if (true == canCreateMeeting())
    {
        ?>
        <div id="createMeetingButton">
            <form id="createMeetingButton" action="createMeeting.php">
                <button type="submit"> Luo kokous</button>
            </form>
        </div>

        <?php
    }

    // Finally add logout option
    include "logout.php";
}

// Show public data to user
include "showPublicData.php";

// Show user data
include "showUserData.php";

include "includes/footer.php";
?>
