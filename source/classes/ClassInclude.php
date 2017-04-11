<?php
class ClassInclude
{
    private $m_IncludeId;
    private $m_IncludeType;
    private $m_IncludeDescription;
    private $m_IncludePath;
    private $m_IncludeVisibility;

    public function setId($id)
    {
        $this->m_IncludeId = $id;
    }
    public function getId()
    {
        return $this->m_IncludeId;
    }
    public function setIncludeType($type)
    {
        $this->m_IncludeType = $type;
    }
    public function getIncludeType()
    {
        return $this->m_IncludeType;
    }
    public function setIncludeDescription($description)
    {
        $this->m_IncludeDescription = $description;
    }
    public function getIncludeDescription()
    {
        return $this->m_IncludeDescription;
    }
    public function setIncludePath($path)
    {
        $this->m_IncludePath = $path;
    }
    public function getIncludePath()
    {
        return $this->m_IncludePath;
    }
    public function setIncludeVisibility($path)
    {
        $this->m_IncludeVisibility = $path;
    }
    public function getIncludeVisibility()
    {
        return $this->m_IncludeVisibility;
    }

    public function showInclude()
    {
        $decription = $this->getIncludeDescription();
        echo "$description";
    }

}
?>
