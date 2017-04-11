<div id="publicData">
<?php
if (!isset($_SESSION['public_data']))
{
    echo "<p>No public data</p>";
}
else
{
    $publicdata = $_SESSION['public_data'];
    foreach ($publicdata->getOrganizations() as $organization)
    {
        $organization->showOrganization();
    }

    foreach ($publicdata->m_Cases as $case)
    {
        $case->showCase();
    }
}
?>
</div> <!-- publicData -->
