<?php

namespace Core\Services;

interface UserServiceContract
{
    public function getUsers();
    public function changePasswordLogin($input);
    public function update($input);
    public function profile();
    public function editProfileIsAdmin($input);
    public function getDataUserInModal($input);
    public function changePassword($input);
    public function checkEmail($input);
    public function store($input);
    public function search($input);
    public function searchUserRestore($input);
    public function delete($input);
    public function restoreUsers($input);
    public function getUserRestore();
}