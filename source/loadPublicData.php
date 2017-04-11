<?php
include "classes/ClassPublicData.php";

function loadPublicOrganizations()
{
$dbconnection = startSQL();
    $query = "SELECT organization.organization_id,
organization.organization_name, organization.organization_address,
organization.organization_phone, organization.parent_organization,
organization.visibility, organization.order FROM
\"avoinhallinto\".organization WHERE organization.visibility = 0 ORDER BY
organization.order";
   
    $result = pg_query($dbconnection,$query);

    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }

    unset($_SESSION['public_data']);
    $_SESSION['public_data'] = new ClassPublicData();
    while ($row = pg_fetch_array($result))
    {
        $organization = new ClassMyOrganization();
        $organization->setId($row[0]);
        $organization->setOrganizationName($row[1]);
        $organization->setOrganizationAddress($row[2]);
        $organization->setOrganizationPhone($row[3]);
        $organization->setOrganizationParent($row[4]);
        $organization->setOrganizationVisibility($row[5]);
        $organization->setOrganizationOrder($row[6]);
        
        // Add organization into public class
        $_SESSION['public_data']->addOrganization($organization);
        // Load groups
        loadGroupByOrganization($organization, $dbconnection);

        // Load cases
        loadCasesByOrganization($organization, $dbconnection);
    }   

    destroySQL();
}

function loadCasesByOrganization($organization, $dbconnection)
{
}

function loadGroupByOrganization($organization, $dbconnection)
{
    $query = "SELECT organization_group.group_id, organization_group.group_name,
organization_group.visibility FROM \"avoinhallinto\".organization_group WHERE organization_group.organization_id = $1";

    $result = pg_query_params($dbconnection,$query,
array($organization->getId()));

    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }

    while ($row = pg_fetch_array($result))
    {
        $group = new ClassMyGroup();
        $group->setId($row[0]);
        $group->setGroupName($row[1]);
        $group->setGroupVisibility($row[2]);
        $group->setGroupOrganization($organization->getId());
        
        // Add group into public class
        $name = $group->getGroupName();
        $organization->addGroup($group);
        // Load case for meeting
        loadMeetingsByGroup($group, $dbconnection);
        // Load group members
        loadMembersByGroup($group, $dbconnection);
    }   

}

function loadMembersByGroup($group, $dbconnection)
{
    $query = "SELECT person_has_role_in_group.person_id,
person_has_role_in_group.role_type, person.person_name, person.person_email,
person.person_phone FROM \"avoinhallinto\".person_has_role_in_group INNER JOIN
\"avoinhallinto\".person ON \"avoinhallinto\".person_has_role_in_group.person_id =
\"avoinhallinto\".person.person_id WHERE person_has_role_in_group.group_id =
$1";

    $result = pg_query_params($dbconnection,$query, array($group->getId()));

    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }

    while ($row = pg_fetch_array($result))
    {
        $member = new ClassGroupMember();
        $member->setId($row[0]);
        $member->setMemberRole($row[1]);
        $member->setMemberName($row[2]);
        $member->setMemberEmail($row[3]);
        $member->setMemberPhone($row[4]);
        $group->addMember($member);
    }
}

function loadMeetingsByGroup($group, $dbconnection)
{
    $query = "SELECT meeting.meeting_id, meeting.start_time, meeting.endtime,
meeting.organization_id
FROM \"avoinhallinto\".meeting WHERE meeting.group_id = $1";

    $result = pg_query_params($dbconnection,$query, array($group->getId()));

    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }

    while ($row = pg_fetch_array($result))
    {
        $meeting = new ClassMyMeeting();
        $meeting->setId($row[0]);
        $meeting->setStartTime($row[1]);
        $meeting->setEndTime($row[2]);
        $meeting->setMeetingOrganization($row[3]);
        $meeting->setMeetingName("Kokous");
        
        // Add group into public class
        $group->addMeeting($meeting);
        // Load case for meeting
        loadUsersByMeeting($meeting, $dbconnection);
        loadCasesByMeeting($meeting, $dbconnection);
        loadIncludesByMeeting($meeting, $dbconnection);
    }   
}

function loadIncludesByMeeting($meeting, $dbconnection)
{
    $query = "SELECT include.include_id, include.include_name,
include.include_path FROM \"avoinhallinto\".include WHERE include.meeting_id =
$1;";

    $result = pg_query_params($dbconnection,$query, array($meeting->getId()));

    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }

    while ($row = pg_fetch_array($result))
    {
        $include = new ClassInclude();
        $include->setId($row[0]);
        $include->setIncludeType(1); // 1 for meeting include
        $include->setIncludeDescription($row[1]);
        $meeting->addInclude($include);
    }

}

function loadCasesByMeeting($meeting, $dbconnection)
{
    $query = "SELECT meeting_has_case.case_id, \"avoinhallinto\".case.description,
\"avoinhallinto\".case.organization_id, \"avoinhallinto\".case.person_id,
\"avoinhallinto\".case.status, \"avoinhallinto\".case.visibility FROM
\"avoinhallinto\".meeting_has_case INNER JOIN \"avoinhallinto\".case ON
meeting_has_case.case_id = \"avoinhallinto\".case.case_id WHERE
meeting_has_case.meeting_id = $1";

    $result = pg_query_params($dbconnection,$query, array($meeting->getId()));

    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }

    while ($row = pg_fetch_array($result))
    {
        $case = new ClassCase();
        $case->setId($row[0]);
        $case->setCaseName($row[1]);
        $case->setCaseOrganization($row[2]);
        $case->setCasePerson($row[3]);
        $case->setCaseStatus($row[4]);
        $case->setCaseVisibility($row[5]);
        $meeting->addCase($case);
    }
}

function loadUsersByMeeting($meeting, $dbconnection)
{
    $query = "SELECT meeting_has_persons.person_id,
meeting_has_persons.role_in_meeting, person.person_name FROM
\"avoinhallinto\".meeting_has_persons INNER JOIN \"avoinhallinto\".person ON
meeting_has_persons.person_id = person.person_id WHERE
meeting_has_persons.meeting_id = $1";

    $result = pg_query_params($dbconnection,$query, array($meeting->getId()));

    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }

    while ($row = pg_fetch_array($result))
    {
        $member = new ClassGroupMember(); 
        $member->setId($row[0]);
        $member->setMemberRole($row[1]);
        $member->setMemberName($row[2]);
        $meeting->addPerson($member);
    }
}
// Load public available data

loadPublicOrganizations();

// Load cases
?>

