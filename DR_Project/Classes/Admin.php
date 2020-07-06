<?php

class Admin extends User {

    public function addUser($user) {
		User::add($user);
    }

    public function editUser($user) {
        User::update($user);
    }

    public function deleteUser($userID) {
        User::delete($userID);
    }

    public function viewUsers() {
        return User::view(1);
    }

    public function addUserType($userType) {
        UserType::add($userType);
    }

    public function viewUserTypes() {
        return UserType::view(1);
    }

    public function deleteUserTypes($usertypeID) {
        UserType::delete($usertypeID);
    }

    public function editUserTypes($usertype) {
        UserType::update($usertype);
    }

    public function addPermission($permission) {
        Permission::add($permission);
    }

    public function editPermission($permission) {
        Permission::update($permission);
    }

    public function viewPermissions() {
        return Permission::view(1);
    }

    public function deletePermission($permissionID) {
        Permission::delete($permissionID);
    }

}

?>