<?php
class ClassCase
{
    private $m_CaseId;
    private $m_CaseName;
    private $m_CaseOrganization;
    private $m_CaseStatus;
    private $m_CasePerson;
    private $m_CaseVisibility;

    public $m_CaseIncludes = array();

    public function setId($id)
    {
        $this->m_CaseId = $id;
    }
    public function getId($id)
    {
        $this->m_CaseId;
    }
    public function setCaseName($name)
    {
        $this->m_CaseName = $name; 
    }
    public function getCaseName()
    {
        return $this->m_CaseName;
    }
    public function setCaseOrganization($organization)
    {
        $this->m_CaseOrganization = $organization; 
    }
    public function getCaseOrganization()
    {
        return $this->m_CaseOrganization;
    }
    public function setCaseStatus($status)
    {
        $this->m_CaseStatus = $status; 
    }
    public function getCaseStatus()
    {
        return $this->m_CaseStatus;
    }
    public function setCasePerson($person)
    {
        $this->m_CasePerson = $person; 
    }
    public function getCasePerson()
    {
        return $this->m_CasePerson;
    }
    public function setCaseVisibility($visibility)
    {
        $this->m_CaseVisibility = $visibility; 
    }
    public function getCaseVisibility()
    {
        return $this->m_CaseVisibility;
    }

    public function addInclude($include)
    {
        array_push($this->m_Includes, $include);
    }

    public function showCase()
    {
        $name = $this->getCaseName();
        echo "$name";
    }

}
?>
