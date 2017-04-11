<?php
class ClassUser {

    public $m_Id = 0;
    public $m_Name = "";
    public $m_Phone = "";

    // Array of organizations
    public $m_userOrganizations = array();
    // Array of groups
    public $m_userGroups = array();
    // Array of meetings
    public $m_userMeetings = array();

    public function setId($id)
    {
        $this->m_Id = $id;
    }
    public function getId()
    {
        return $this->m_Id;
    }   
    public function setUserName($name)
    {
        $this->m_Name = $name;
    }
    public function getUserName()
    {
        return $this->m_Name;
    }
    public function setPhone($phone)
    {
        $this->m_Phone = $phone;
    }
    public function getPhone()
    {
        return $this->m_Phone;
    }
    public function addOrganization($organization)
    {   
        array_push($this->m_userOrganizations, $organization);
    }

    public function addGroup($group)
    {   
        array_push($this->m_userGroups, $group);
    }
    
    public function addMeeting($meeting)
    {
        array_push($this->m_userMeetings, $meeting);
    }   
}
?>
