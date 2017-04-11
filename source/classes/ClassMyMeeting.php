<?php
class ClassMyMeeting {
    private $m_MeetingId;
    private $m_MeetingName;
    private $m_MeetingMyRole;
    private $m_MeetingVisibility;
    private $m_MeetingStartTime;
    private $m_MeetingEndTime;
    private $m_MeetingOrganization;

    public $m_Cases = array();
    public $m_Includes = array();
    public $m_Persons = array(); // 

    public function setId($id)
    {
        $this->m_MeetingId = $id; 
    }
    public function getId()
    {
        return $this->m_MeetingId;
    }
    public function setMeetingName($name)
    {
        $this->m_MeetingName = $name; 
    }
    public function getMeetingName()
    {
        return $this->m_MeetingName;
    }
    public function setAddress($address)
    {
        $this->m_MeetingAddress = $address; 
    }
    public function getAddress()
    {
        return $this->m_MeetingAddress;
    }
    public function setMyRole($myRole)
    {
        $this->m_MeetingMyRole = $myRole; 
    }
    public function getMyRole()
    {
        return $this->m_MeetingMyRole;
    }
    public function setVisibility($visibility)
    {
        $this->m_MeetingVisibility = $visibility;
    }
    public function getVisibility()
    {
        return $this->m_MeetingVisibility;
    }
    public function setStartTime($startTime)
    {
        $this->m_MeetingStartTime = $startTime;
    }
    public function getStartTime()
    {
        return $this->m_MeetingStartTime;
    }
    public function setEndTime($endTime)
    {
        $this->m_MeetingEndTime = $endTime;
    }
    public function getEndTime()
    {
        return $this->m_MeetingEndTime;
    }
    public function setMeetingOrganization($organization)
    {
        $this->m_MeetingOrganization = $organization; 
    }
    public function getMeetingOrganization()
    {
        return $this->m_MeetingOrganization;
    }

    public function addInclude($include)
    {
        array_push($this->m_Includes, $include);
    }   
    public function addCase($case)
    {
        array_push($this->m_Cases, $case);
    }   
    public function addPerson($person)
    {
        array_push($this->m_Persons, $person);
    }

    public function showMeeting()
    {
        // TODO: Add javascript and show details when clicked

        // List cases as buttons
        echo "<fieldset>";
        echo "<legend>Esitykset</legend>";
        echo "<form action='showCase.php' method='POST'>";
        foreach ($this->m_Cases as $case)
        {
            $case->showCase();
        }
        echo "</fieldset>";
        echo "<fieldset>";
        echo "<legend>Läsnä</legend>";
        foreach ($this->m_Persons as $person)
        {
            // TODO: Add javascript to show person details when clicked
            $person->showMember();
        }
        echo "</fieldset>";

        echo "<fieldset>";
        echo "<legend>Liitteet</legend>";
        foreach ($this->m_Includes as $include)
        {  
            $include->showInclude(); 
        }
        echo "</fieldset>";
    }
}
?>

