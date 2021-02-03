<?php

namespace Module\user\Model;

class Admin extends AdminTable {

    public $Id;
    public $Username;
    public $Password;
    public $Random;
    public $Name;
    public $Email;
    public $Phone;
    public $Address;
    public $Note;
    public $Groups;
    public $Active;

    const tableName = table_prefix . "admin";
    const Admin = 1;
    const SuperAdmin = -1;
    const Customer = 2;
    const DaiLy = 3;
    const TTBH = 4;

    function __construct($NhanVien = NULL) {
        if ($NhanVien) {
            $this->Id = isset($NhanVien['Id']) ? $NhanVien['Id'] : '';
            $this->Username = isset($NhanVien['Username']) ? $NhanVien['Username'] : '';
            $this->Password = isset($NhanVien['Password']) ? $NhanVien['Password'] : '';
            $this->Random = isset($NhanVien['Random']) ? $NhanVien['Random'] : '';
            $this->Name = isset($NhanVien['Name']) ? $NhanVien['Name'] : '';
            $this->Email = isset($NhanVien['Email']) ? $NhanVien['Email'] : "";
            $this->Phone = isset($NhanVien['Phone']) ? $NhanVien['Phone'] : "";
            $this->Address = isset($NhanVien['Address']) ? $NhanVien['Address'] : "";
            $this->Note = isset($NhanVien['Note']) ? $NhanVien['Note'] : "";
            $this->Groups = isset($NhanVien['Groups']) ? $NhanVien['Groups'] : "";
            $this->Active = isset($NhanVien['Active']) ? $NhanVien['Active'] : 0;
        }
        parent::__construct();
    }

    function CheckLogin($Username, $Password) {
        return $this->userByUsernamePassword($Username, $Password);
//        return $this->getUserByUsernamePassword($Username, $Password);
    }

    function createrPassword($p, $r) {
        return sha1($p . $r);
    }

    public static function getCurentUser($obj = false) {

        if (isset($_SESSION[QuanTri])) {
            if (!$obj)
                return $_SESSION[QuanTri];
            return new Admin($_SESSION[QuanTri]);
        }
        return NULL;
    }

    public static function setCurentUser($User) {
        $_SESSION[QuanTri] = $User;
    }

    public static function IsLogin() {
        if (!isset($_SESSION[QuanTri])) {
            return FALSE;
        }
        if (empty($_SESSION[QuanTri])) {
            return FALSE;
        }
        return True;
    }

    public static function Logout() {
        unset($_SESSION[QuanTri]);
        \Common\Common::toUrl("/dashboard/");
    }

    function updateUserInfor($user) {
        return $this->Update($user, "`Username` = '{$user["Username"]}'");
    }

    public function getUserByUsername($Username) {
        return $this->ToRow($this->Select("`Username` = '{$Username}'"));
    }

    function GetAll2Option() {
        $where = " 1=1";
        return $this->getColumnsOption(["Id", "Name"], $where);
    }

    public function Groups() {
        $Project = new userGroups();
        return new userGroups($Project->GetByGroupsId($this->Groups));
    }

    public function GetUserActive() {
        $active = AdminStatus::sActive;
        $Where = "`Active` = '{$active}'";
        return $this->ToArray($this->Select($Where));
    }

    public function GetUserByActive($active) {
        $Where = "`Active` = '{$active}'";
        return $this->ToArray($this->Select($Where));
    }

    public function Active() {
        $ac = new AdminStatus();
        return $ac->GetById($this->Active, true);
    }

    public function publicKey() {
        return sha1($this->Username . $this->Email . $this->Id);
    }

    public function getUserByPublicKey($publicKey) {
        $Where = " SHA1(concat(`Username`,`Email`,`Id`)) = '{$publicKey}'";
        return $this->ToRow($this->Select($Where));
    }

    public function ResetPassword($Model) {
        $password = "zaq@123Abc";
        $Model["Password"] = $this->createrPassword($password, $Model["Random"]);
        $this->UpdateSubmit($Model);
//        send mail
        return $password;
    }

    public function AdminViewModel() {
        $a["Id"] = $this->Id;

        $a["Name"] = $this->Name;
        $a["Email"] = $this->Email;
        $a["Address"] = $this->Address;
        $a["Groups"] = $this->Groups;
        $a["Phone"] = $this->Phone;
        $a["Active"] = $this->Active;
        return $a;
    }

    public function isAdmin() {
        return Admin::getCurentUser(true)->Groups()->GroupsId == self::Admin;
    }

    public function updatePasswordUser($User) {
        return $this->UpdateSubmit($User);
    }

    public function getUserByEmail($Email) {
        return $this->ToRow($this->Select("`Email` = '{$Email}'"));
    }

    public function CheckPassword($Password) {
        return $this->CheckLogin($this->Username, $Password);
    }

    public static function GetUsersOptions() {
        $admin = new Admin();
        if ($groups) {
            $where = " `Groups` = '{$groups}' ";
        } else {
            $where = " 1=1";
        }
        return $admin->getColumnsOption(["Id", "Name"], $where);
    }

    public static function GetUsersByGroups2Options($user = []) {
        $admin = new Admin();
        if (!$user) {
            return null;
        }
        if ($user) {
            $users = implode(",", $user);
            $where = " `Groups` in ($users) ";
        } else {
            $where = " 1=1";
        }
        return $admin->getColumnsOption(["Id", "Name"], $where);
    }

}

?>