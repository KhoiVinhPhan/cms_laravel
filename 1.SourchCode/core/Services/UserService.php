<?php

namespace Core\Services;

use Core\Repositories\UserRepositoryContract;

class UserService implements UserServiceContract
{
    protected $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        return $this->userRepository = $userRepository;
    }

    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }

    public function changePasswordLogin($input)
    {
        return $this->userRepository->changePasswordLogin($input);
    }

    public function update($input)
    {
        return $this->userRepository->update($input);
    }

    public function profile()
    {
        return $this->userRepository->profile();
    }

    public function editProfileIsAdmin($input)
    {
        return $this->userRepository->editProfileIsAdmin($input);
    }

    public function getDataUserInModal($input)
    {
        return $this->userRepository->getDataUserInModal($input);
    }

    public function changePassword($input)
    {
        return $this->userRepository->changePassword($input);
    }

    public function checkEmail($input)
    {
        return $this->userRepository->checkEmail($input);
    }

    public function store($input)
    {
        return $this->userRepository->store($input);
    }

    public function search($input)
    {
        return $this->userRepository->search($input);
    }

    public function searchUserRestore($input)
    {
        return $this->userRepository->searchUserRestore($input);
    }

    public function delete($input)
    {
        return $this->userRepository->delete($input);
    }

    public function getUserRestore()
    {
        return $this->userRepository->getUserRestore();
    }

    public function restoreUsers($input)
    {
        return $this->userRepository->restoreUsers($input);
    }

}