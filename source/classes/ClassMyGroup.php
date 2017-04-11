<?php
class ClassMyGroup {
    private $m_GroupId;
    private $m_GroupName;
    private $m_GroupMyRole;
    private $m_GroupOrganization;
    private $m_GroupVisibility;

    public $m_Members = array();
    public $m_Meetings= array();
    

    public function setId($id)
    {
        $this->m_GroupId = $id; 
    }
    public function getId()
    {
        return $this->m_GroupId;
    }
    public function setGroupName($name)
    {
        $this->m_GroupName = $name; 
    }
    public function getGroupName()
    {
        return $this->m_GroupName;
    }
    public function setGroupVisibility($visibility)
    {
        $this->m_GroupVisibility = $visibility; 
    }
    public function getGroupVisibility()
    {
        return $this->m_GroupVisibility;
    }
    public function setMyRole($myRole)
    {
        $this->m_GroupMyRole = $myRole; 
    }
    public function getMyRole()
    {
        return $this->m_GroupMyRole;
    }
    public function setGroupOrganization($organizationId)
    {
        $this->m_GroupOrganization = $organizationId;
    }
    public function getGroupOrganization()
    {
        return $this->m_GroupOrganization;
    }
    public function addMember($member)
    {
        array_push($this->m_Members, $member);
    }
    public function addMeeting($meeting)
    {
        array_push($this->m_Meetings, $meeting);
    }

    public function showGroup()
    {
        $name = $this->getGroupName();
        echo "<button type='button' name='groupButton' >$name </button>";
        echo "<fieldset>";
        echo "<legend>Jäsenet</legend>";
        // TODO: show members but add javascript to hide them
        echo "<ul>";
        foreach ($this->m_Members as $member)
        {
            $member->showMember();
        }
        echo "</ul>";
        echo "</fieldset>";
        echo "<fieldset>";
        echo "<legend>Kokoukset</legend>";
        foreach ($this->m_Meetings as $meeting)
        {
            $meeting->showMeeting();
        }
        echo "</fieldset>";
    }
}
?>
