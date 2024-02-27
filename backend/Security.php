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

    public function getLoginCredentials() {
        return $this->loginCredentials;
    }

    public function setLoginCredentials($loginCredentials) {
        $this->loginCredentials = $loginCredentials;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function setRoles($roles) {
        $this->roles = $roles;
    }

    public function getPermissions() {
        return $this->permissions;
    }

    public function setPermissions($permissions) {
        $this->permissions = $permissions;
    }
}


?>