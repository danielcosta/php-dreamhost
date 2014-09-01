<?php

namespace DanielCosta\Dreamhost\Interfaces;

use DanielCosta\Dreamhost\Enum\ShellType;
use DanielCosta\Dreamhost\Enum\UserType;

/**
 * Class User
 *
 * @package DanielCosta\Dreamhost\Modules
 * @author  Daniel Costa
 */
interface User
{
    /**
     * Get all users
     *
     * @return mixed
     */
    public function getUsers();

    /**
     * Add user
     *
     * @param UserType $userType
     * @param           $username
     * @param           $fullName
     * @param           $server
     * @param ShellType $shellType
     * @param string $password
     * @param bool $enhancedSecurity
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
    );

    /**
     * Remove user
     *
     * @param           $username
     * @param ShellType $type
     * @param bool      $removeAll
     *
     * @return mixed
     */
    public function removeUser($username, ShellType $type = null, $removeAll = false);
}