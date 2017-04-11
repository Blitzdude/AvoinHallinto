<?php
class ClassMyOrganization {
    private $m_OrganizationId;
    private $m_OrganizationName;
    private $m_OrganizationAddress;
    private $m_OrganizationPhone;
    private $m_OrganizationMyRole;
    private $m_OrganizationVisibility;
    private $m_OrganizationOrder;
    private $m_OrganizationParent;

    public $m_Groups = array();
    public $m_Cases = array();
    public $m_Members = array();

    public function setId($id)
    {
        $this->m_OrganizationId = $id; 
    }
    public function getId()
    {
        return $this->m_OrganizationId;
    }
    public function setOrganizationName($name)
    {
        $this->m_OrganizationName = $name; 
    }
    public function getOrganizationName()
    {
        return $this->m_OrganizationName;
    }
    public function setOrganizationAddress($address)
    {
        $this->m_OrganizationAddress = $address; 
    }
    public function getOrganizationAddress()
    {
        return $this->m_OrganizationAddress;
    }
    public function setOrganizationPhone($phone)
    {
        $this->m_OrganizationPhone = $phone; 
    }
    public function getOrganizationPhone()
    {
        return $this->m_OrganizationPhone;
    }
    public function setMyRole($myRole)
    {
        $this->m_OrganizationMyRole = $myRole; 
    }
    public function getMyRole()
    {
        return $this->m_OrganizationMyRole;
    }
    public function setOrganizationParent($parentId)
    {
        $this->m_OrganizationParent = $parentId;
    }
    public function getOrganizationParent()
    {
        return $this->m_OrganizationParent;
    }
    public function setOrganizationVisibility($visibility)
    {
        $this->m_OrganizationVisibility = $visibility;
    }
    public function getOrganizationVisibility()
    {
        return $this->m_OrganizationVisibility;
    }
    public function setOrganizationOrder($order)
    {
        $this->m_OrganizationOrder = $order;
    }
    public function getOrganizationOrder()
    {
        return $this->m_OrganizationOrder;
    }

    public function addGroup($group)
    {
        array_push($this->m_Groups, $group);
    }

    public function showOrganization()
    {
        echo "<h2>$this->m_OrganizationName</h3>";
        // TODO: Add javascript and show details when clicked

        // List groups as buttons
        echo "<form action='showGroup.php' method='POST'>";
        echo "<ul>";
        foreach ($this->m_Groups as $group)
        {
            echo "<li>";
            $group->showGroup();
            echo "</li>";
        }
        echo "</ul>";
        echo "</form>";
    }
}
?>
