<?php

namespace DanielCosta\Dreamhost\Modules;

use DanielCosta\Dreamhost\Interfaces\User as UserInterface;
use DanielCosta\Dreamhost\Enum\ShellType;
use DanielCosta\Dreamhost\Enum\UserType;

/**
 * Class User
 *
 * @package DanielCosta\Dreamhost\Modules
 * @author  Daniel Costa
 */
class User implements UserInterface
{
    /**
     * Get all users
     *
     * @return mixed
     */
    public function getUsers()
    {
        $proxy = new \DanielCosta\Dreamhost\Proxy;
        return $proxy->getUsers();
    }

    /**
     * Add user
     *
     * @param UserType  $userType
     * @param           $username
     * @param           $fullName
     * @param           $server
     * @param ShellType $shellType
     * @param string    $password
     * @param bool      $enhancedSecurity
     *
     * @return mixed
     */
    public function addUser(
        UserType $userType,
        $username,
        $fullName,
        $server,
        ShellType $shellType,
        $password = '',
        $enhancedSecurity = true
    ) {
        // TODO: Implement addUser() method.
    }

    /**
     * Remove user
     *
     * @param           $username
     * @param ShellType $type
     * @param bool      $removeAll
     *
     * @return mixed
     */
    public function removeUser($username, ShellType $type = null, $removeAll = false)
    {
        // TODO: Implement removeUser() method.
    }

}