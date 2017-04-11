<?php
class ClassMeeting {

    private $m_Id = 0;
    private $m_Organization = 0;
    private $m_Group = 0;
    private $m_Visibility;
    private $m_MyRole = 0;
    private $m_StartTime;
    private $m_EndTime;

    // Array of meetings
    private $m_Includes = array();
    private $m_Cases = array();

    public function setId($id)
    {
        $this->m_Id = $id;
    }
    public function getId()
    {
        return $this->m_Id;
    }   
    public function setOrganization($organization_id)
    {
        $this->m_Organization = $organization_id;
    }
    public function getOrganization()
    {
        return $this->m_Organization;
    }
    public function setGroup($group)
    {
        $this->m_Group= $group;
    }
    public function getGroup()
    {
        return $this->m_Group;
    }
    public function setMyRole($myRole)
    {
        $this->m_MyRole= $myRole;
    }
    public function getMyRole()
    {
        return $this->m_MyRole;
    }
    public function setVisibility($visibility)
    {
        $this->m_Visibility= $visibility;
    }
    public function getVisibility()
    {
        return $this->m_Visibility;
    }
    public function setStartTime($startTime)
    {
        $this->m_StartTime= $startTime;
    }
    public function getStartTime()
    {
        return $this->m_StartTime;
    }
    public function setEndTime($endTime)
    {
        $this->m_EndTime= $endTime;
    }
    public function getEndTime()
    {
        return $this->m_EndTime;
    }

    
    public function addInclude($include)
    {
        array_push($this->m_Includes, $include);
    }   
    public function addCase($case)
    {
        array_push($this->m_Cases, $case);
    }   
}
?>
