<?php

namespace DanielCosta\Dreamhost;

use DanielCosta\Dreamhost\Enum\ShellType;
use DanielCosta\Dreamhost\Enum\UserType;
use DanielCosta\Dreamhost\Interfaces\User;
use GuzzleHttp\Client;

/**
 * Class Proxy
 *
 * This class performs all the API calls
 * It uses the supplied HTTP client as a default (cURL)
 *
 * @package DanielCosta\Dreamhost\Core
 * @author  Daniel Costa
 */
class Proxy implements User
{
    /**
     * HTTP Client
     *
     * @var \GuzzleHttp\Client
     * @access protected
     */
    protected $client;

    /**
     * @var string
     */
    protected $token = '';

    /**
     * @var string
     */
    protected $url = 'https://api.dreamhost.com/';

    public function __construct($access_token = null)
    {
        $this->client = new Client();
        $this->access_token = $access_token;
    }

    /**
     * Set the access token
     *
     * @param string $token The access token
     *
     * @access public
     *
     * @return Proxy
     */
    public function setAccessToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get all users
     *
     * @return mixed
     */
    public function getUsers()
    {
        return $this->call(
            'get',
            'user-list_users'
        );
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

    /**
     * Make a call to the API
     *
     * @param string $url    URL
     * @param string $method HTTP method to use
     * @param array  $params API parameters
     *
     * @access private
     */
    private function call($url, $method = 'get', array $params = null)
    {
        $response = $this->client->$method(
            $url,
            $params
        );

        return $response;
    }
}