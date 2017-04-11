<?php
include "includes/header.php";
?>
<div="createMeeting.php">
    <form id="frmCreateMeeting" action="createMeeting2.php">
        <?php
            selectGroup();
        ?>
        <br>
        <label>Päivä</label><br>
        <input type="date" value="vvvv-kk-pv" required><br>
        <label>Aika</label><br>
        <input type="time" value="hh:mm" required><br>
        <label>Kutsu</label><br>
        <?php
            invitePeople($groupId);
            
            echo "Compose";
            // Choose te            
            selectMeetingTemplate($groupId);

            selectCases($groupId);
        ?>
        <p>OnClick: esikatsele esityslista ja hyväksytä, jonka jälkeen ohjaus ->
createMeeting2.php"</p>
        <input type="submit" value="Esikatsele"> 
    </form>
</div>
<?php
include "includes/footer.php";
?>

