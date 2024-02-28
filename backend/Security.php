<?php

class Security {
    private $loginCredentials;
    private $roles;
    private $permissions;
    
    public function __construct($loginCredentials, $roles, $permissions) {
        $this->loginCredentials = $loginCredentials;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }
    
    public function grantPermission($permission) {
        $this->permissions[] = $permission;
    }
    
    public function revokePermission($permission) {
        $key = array_search($permission, $this->permissions);
        if ($key !== false) {
            unset($this->permissions[$key]);
        }
    }
    
    public function getLoginCredentials() {
        return $this->loginCredentials;
    }
    
    public function getRoles() {
        return $this->roles;
    }
    
    public function getPermissions() {
        return $this->permissions;
    }
    
    public function setLoginCredentials($loginCredentials) {
        $this->loginCredentials = $loginCredentials;
    }
    
    public function setRoles($roles) {
        $this->roles = $roles;
    }
    
    public function setPermissions($permissions) {
        $this->permissions = $permissions;
    }
}

?>
