<?php
include 'includes/header.php';

if (false == canCreateCase())
{
    header("Location: index.php");
    die();
}

if (isset($_POST["teCaseTitle"]) && isset($_POST["taCaseDescription"]))
{
    $caseTitle = $_POST["teCaseTitle"];
    $caseDescription= $_POST["taCaseDescription"];
    $caseId = insertCase($caseTitle, $caseDescription);

    if (-1 == $caseID)
    {
        // Todo: popup error?    
        header("Location: index.php");
        die();
    }
}

if (isset($_POST["includeFile"]))
{
    echo "Uploading (not yet but in future)";
}

listCaseIncludes($caseId);
?>
<div id="createCaseIncludes">
    <form id="frmCreateCase2" action="createCase2.php" method="POST">
        <input type="file" id="includeFile">
        <input type="submit" value="Lataa liite">
        <input type="hidden" id="caseId" value="<?php$caseID?>">
    </form>
</div>

<div id="returnButton">
    <form id="returnToIndex" action="index.php" method="POST">
        <input type="submit" value="Valmis">
    </form>
</div>

<?php
include 'includes/footer.php';
?>
