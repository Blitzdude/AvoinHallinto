<?php
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
    if (!isset($_POST['teEmail']) || !isset($_POST['pwPassword']) ||
!isset($_POST['tePhone']) || !isset($_POST['teName']))
    {
        header("Location: index.php");
        die();
    }

    $name = test_input($_POST['teName']);
    $pw = test_input($_POST['pwPassword']);
    $phone = test_input($_POST['tePhone']);
    $email = test_input($_POST['teEmail']);

    if (true == createUser($pw, $phone, $email, $email))
    {
        header("Location: index.php");
        die();
    }
}
else
{
    header("Location: index.php");
    die();
}

include 'includes/footer.php';
?>
