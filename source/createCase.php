<?php
include 'includes/header.php';

if (false == canCreateCase())
{
    header("Location: index.php");
    die();
}
?>
<div id="createCaseBox">
    <form id="frmCreateCase" action="createCase2.php" method="POST">
        <label id="lblCaseTitle">Otsikko</label><br>
        <input type="text" name="teCaseTitle" id="teCaseTitle" requeired /><br>
        <label id="lblCaseDescription">Kuvaus</label><br>
        <textarea id="taCaseDescription" name="taCaseDescription" rows="4" cols="50">Lyhyt kuvaus. Tarkempaan selontekoon, käytä
liitteitä</textarea><br>
        <input type="submit" value="Lähetä">
        </form>
</div>
<?php

include 'includes/footer.php';
?>
