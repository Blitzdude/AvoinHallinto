<?php
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  return $data;
}

function checkLoginFromDB($email, $password)
{
    $dbconnection = startSQL();
    $query="SELECT \"person\".person_name, \"person\".person_id,
\"person\".person_password, \"person\".person_phone  FROM avoinhallinto.\"person\" WHERE \"person\".person_email = $1";

    
    $params = array($email);
    $result = pg_query_params($dbconnection, $query, $params);
    
    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }
    
    $row = pg_fetch_array($result);
    if (false == $row)
    {
        echo "Check username or/and password";
        return NULL;
    }

    $hash = $row[2];
    if (false == password_verify($password, $hash))
    {
        echo "Check username or/and password";
        return NULL;
    }

    destroySQL();

    $loggedUser = new ClassUser();
    $loggedUser->setId($row[1]);
    $loggedUser->setUserName($row[0]);
    $loggedUser->setPhone($row[3]);
    return $loggedUser;
}

function destroySession()
{
    session_unset();
    session_destroy();
}

function startSQL()
{
    $connectionString="";

    $connection = pg_connect($connectionString)
        or die("Failed to connect to the data base");

    return $connection;
}

function destroySQL()
{
    pg_close();
}

function createUser($password,$phone, $name,$email)
{
    $dbconnection = startSQL();
   
    $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO avoinhallinto.person (person_email, person_password, person_name,
person_phone) VALUES ($1, $2, $3, $4)";
    $params=array($email, $hashed_pw, $name, $phone);
    $result = pg_query_params($dbconnection, $query,$params);

    if (!$result)
    {
        echo pg_last_error();
        return false;
    }
        

    return true;
}

function loadMyOrganizations($user,$dbconnection)
{
    $query = "SELECT person_has_role_in_organization.organization_id,
organization.organization_name, organization.address,
person_has_role_in_organization.organization_role_id FROM
\"avoinhallinto\".person_has_role_in_organization INNER JOIN
\"avoinhallinto\".organization ON
\"avoinhallinto\".person_has_role_in_organization.organization_id =
organization.organization_id WHERE persion_id = $1  ORDER BY
person_has_role_in_organization.order";

   
    $result = pg_query_params($dbconnection,$query,array($user->getId()));

    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }
    
    while ($row = pg_fetch_array($result))
    {
        $myOrganization = new ClassMyOrganization(); 
        $myOrganization->setId($row[0]);
        $myOrganization->setOrganizationName($row[1]);
        $myOrganization->setAddress($row[2]);
        $myOrganization->setMyRole($row[3]);
        $user->addOrganization($myOrganization);
    }
}

function loadMyGroups($user, $dbconnection)
{
    $query = "SELECT person_has_role_in_group.group_id,
organization_group.group_name, organization_group.orgranization_id,
person_has_role_in_group.role_type FROM \"avoinhallinto\".person_has_role_in_group
INNER JOIN \"avoinhallinto\".organization_group ON
\"avoinhallinto\".person_has_role_in_group.group_id = organization_group.group_id
WHERE person_id = $1  ORDER BY person_has_role_in_group.order";
   
    $result = pg_query_params($dbconnection,$query,array($user->getId()));

    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }
    
    while ($row = pg_fetch_array($result))
    {
        $myGroup = new ClassMyGroup(); 
        $myGroup->setId($row[0]);
        $myGroup->setGroupName($row[1]);
        $myGroup->setGroupOrganization($row[2]);
        $myGroup->setMyRole($row[3]);
        $user->addGroup($myGroup);
        
        loadMeetingsByGroup($myGroup, $dbconnection);
    }
}

function loadMyMeetings($user, $dbconnection)
{
    $query = "SELECT meeting_has_persons.person_id,
meeting_has_persons.meeting_id, meeting_has_persons.role_in_meeting,
meeting.start_time, meeting.endtime, meeting.visiblity, meeting.organization_id
FROM \"avoinhallinto\".meeting_has_persons INNER JOIN \"avoinhallinto\".meeting ON
\"avoinhallinto\".meeting_has_persons.meeting_id = meeting.meeting_id WHERE
person_id = $1";
   
    $result = pg_query_params($dbconnection,$query,array($user->getId()));

    if (!$result)
    {
        echo pg_last_error();
        return NULL;
    }

    while ($row = pg_fetch_array($result))
    {
        $meeting = new ClassMeeting();

        // Load case for meeting
        loadCases($meeting, $dbconnection);
    }   
}

function loadUserData($user)
{
    return;
/*
    $dbconnection = startSQL();
    loadMyOrganizations($user, $dbconnection);
    loadMyGroups($user, $dbconnection);
    loadMyMeetings($user, $dbconnection);

    destroySQL();*/
}

function canCreateUser()
{
    return true;
}

function canCreateCase()
{
    return true;
}

function insertCase($caseTitle, $caseDesctiption)
{
    echo "TODO: insert case";
    return 0;
}

function listCaseIncludes($caseId)
{
    echo "<p>Liite1</p>";
    echo "<p>Liite2</p>";
    echo "TODO: Lataa liitteet kannasta";
}

function canCreateMeeting()
{
    return true;
}   

function selectGroup()
{
    echo "TODO: Listaa ryhmät, joihin käyttäjällä on kokouksen luomisoikeudet";
    echo "<select>";
    echo "<option value=\"Hallitus\">Hallitus </option>";
    echo "<option value=\"TV\">TV</option>";
    echo "<option value=\"KV\">KV</option>";
    echo "</select>";
}

function invitePeople($groupId)
{
    echo "<p>TODO list users by group and select all from default group</p>";
}

function selectCases($groupId)
{
    echo "<p>TODO: List cases queued for group and allow user to pick up wanted
cases and also insert new cases</p>";
}

function insertNonCaseItem($groupId)
{
    echo "<p>TODO: Allow user to create 'non case' item</p>";
}

function selectMeetingTemplate($groupId)
{
    echo "<p>TODO: Allow user to choose template from list. For example:
Valmiiksi täytetyt kohdat kokouksen avaukselle, järjestäytymiselle ym.</p>";
}

?>
