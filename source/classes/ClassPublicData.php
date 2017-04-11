<?php
class ClassPublicData {

    // Array of meetings
    public $m_Organizations = array();
    public $m_Meetings = array();
    public $m_Cases = array();

    public function addOrganization($organization)
    {
        array_push($this->m_Organizations, $organization);
    }   
    public function addCase($case)
    {
        array_push($this->m_Cases, $case);
    }   
    public function addMeeting($meeting)
    {
        array_push($this->m_Meeting, $meeting);
    } 
    public function getOrganizations()
    {
        return $this->m_Organizations;
    }
}
?>
