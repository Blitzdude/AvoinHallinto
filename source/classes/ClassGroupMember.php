<?php
class ClassGroupMember
{ 
    private $m_MemberId;
    private $m_MemberName;
    private $m_MemberRole;
    private $m_MemberPhone;
    private $m_MemberEmail;

    public function setId($id)
    {
        $this->m_MemberId = $id;
    }
    public function getId($id)
    {
        $this->m_MemberId;
    }
    public function setMemberName($name)
    {
        $this->m_MemberName = $name; 
    }
    public function getMemberName()
    {
        return $this->m_MemberName;
    }
    public function setMemberRole($role)
    {
        $this->m_MemberRole = $role; 
    }
    public function getMemberRole()
    {
        return $this->m_MemberRole;
    }
    public function setMemberPhone($phone)
    {
        $this->m_MemberPhone = $phone; 
    }
    public function getMemberPhone()
    {
        return $this->m_MemberPhone;
    }
    public function setMemberEmail($email)
    {
        $this->m_MemberEmail = $email; 
    }
    public function getMemberEmail()
    {
        return $this->m_MemberEmail;
    }

    public function showMember()
    {
        echo "$this->m_MemberName";
    }
}
?>
