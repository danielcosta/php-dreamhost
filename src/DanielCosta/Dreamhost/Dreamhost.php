<?php

namespace DanielCosta\Dreamhost;

use \Exception;

/**
 * Class Dreamhost
 *
 * @package DanielCosta\Dreamhost
 * @author  Daniel Costa
 */
class Dreamhost
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var Enum\Format
     */
    private $format = Enum\Format::JSON;

    /**
     * @var Modules\AnnouncementList
     */
    private $moduleAnnouncementList;

    /**
     * @var Modules\Account
     */
    private $moduleAccount;

    /**
     * @var Modules\Api
     */
    private $moduleApi;

    /**
     * @var Modules\DNS
     */
    private $moduleDNS;

    /**
     * @var Modules\Domain
     */
    private $moduleDomain;

    /**
     * @var Modules\Jabber
     */
    private $moduleJabber;

    /**
     * @var Modules\Mail
     */
    private $moduleMail;

    /**
     * @var Modules\MySQL
     */
    private $moduleMySQL;

    /**
     * @var Modules\PrivateServer
     */
    private $modulePrivateServer;

    /**
     * @var Modules\Rewards
     */
    private $moduleRewards;

    /**
     * @var Modules\ServiceControl
     */
    private $moduleServiceControl;

    /**
     * @var Modules\User
     */
    private $moduleUser;

    public function __construct($key, $format = null)
    {
        $this->setKey($key);

        if (empty($format)) {
            $format = Enum\Format::JSON;
        }
        $this->setFormat(new Enum\Format($format));
    }

    /**
     * Set return format
     *
     * @param Enum\Format $format
     *
     * @return Dreamhost
     * @throws \Exception
     */
    public function setFormat(Enum\Format $format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Set API auth key
     *
     * @param string $key
     *
     * @return Dreamhost
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get Account module
     *
     * @return \DanielCosta\Dreamhost\Modules\Account
     */
    public function getAccount()
    {
        if (!($this->moduleAccount instanceof Modules\Account)) {
            $this->moduleAccount = new Modules\Account();
        }

        return $this->moduleAccount;
    }

    /**
     * Get API module
     *
     * @return \DanielCosta\Dreamhost\Modules\Api
     */
    public function getApi()
    {
        if (!($this->moduleApi instanceof Modules\Api)) {
            $this->moduleApi = new Modules\Api();
        }

        return $this->moduleApi;
    }

    /**
     * Get Announcement List module
     *
     * @return \DanielCosta\Dreamhost\Modules\AnnouncementList
     */
    public function getAnnouncementList()
    {
        if (!($this->moduleAnnouncementList instanceof Modules\AnnouncementList)) {
            $this->moduleAnnouncementList = new Modules\AnnouncementList();
        }

        return $this->moduleAnnouncementList;
    }

    /**
     * Get DNS module
     *
     * @return \DanielCosta\Dreamhost\Modules\DNS
     */
    public function getDNS()
    {
        if (!($this->moduleDNS instanceof Modules\DNS)) {
            $this->moduleDNS = new Modules\DNS();
        }

        return $this->moduleDNS;
    }

    /**
     * Get Domain module
     *
     * @return \DanielCosta\Dreamhost\Modules\Domain
     */
    public function getDomain()
    {
        if (!($this->moduleDomain instanceof Modules\Domain)) {
            $this->moduleDomain = new Modules\Domain();
        }

        return $this->moduleDomain;
    }

    /**
     * Get Jabber module
     *
     * @return \DanielCosta\Dreamhost\Modules\Jabber
     */
    public function getJabber()
    {
        if (!($this->moduleJabber instanceof Modules\Jabber)) {
            $this->moduleJabber = new Modules\Jabber();
        }

        return $this->moduleJabber;
    }

    /**
     * Get Mail module
     *
     * @return \DanielCosta\Dreamhost\Modules\Mail
     */
    public function getMail()
    {
        if (!($this->moduleMail instanceof Modules\Mail)) {
            $this->moduleMail = new Modules\Mail();
        }

        return $this->moduleMail;
    }

    /**
     * Get MySQL module
     *
     * @return \DanielCosta\Dreamhost\Modules\MySQL
     */
    public function getMySQL()
    {
        if (!($this->moduleMySQL instanceof Modules\MySQL)) {
            $this->moduleMySQL = new Modules\MySQL();
        }

        return $this->moduleMySQL;
    }

    /**
     * Get Private Server module
     *
     * @return \DanielCosta\Dreamhost\Modules\PrivateServer
     */
    public function getPrivateServer()
    {
        if (!($this->modulePrivateServer instanceof Modules\PrivateServer)) {
            $this->modulePrivateServer = new Modules\PrivateServer();
        }

        return $this->modulePrivateServer;
    }

    /**
     * Get Rewards module
     *
     * @return \DanielCosta\Dreamhost\Modules\Rewards
     */
    public function getRewards()
    {
        if (!($this->moduleRewards instanceof Modules\Rewards)) {
            $this->moduleRewards = new Modules\Rewards();
        }

        return $this->moduleRewards;
    }

    /**
     * Get Service Control module
     *
     * @return \DanielCosta\Dreamhost\Modules\ServiceControl
     */
    public function getServiceControl()
    {
        if (!($this->moduleServiceControl instanceof Modules\ServiceControl)) {
            $this->moduleServiceControl = new Modules\ServiceControl();
        }

        return $this->moduleServiceControl;
    }

    /**
     * Get User module
     *
     * @return \DanielCosta\Dreamhost\Modules\User
     */
    public function getUser()
    {
        if (!($this->moduleUser instanceof Modules\User)) {
            $this->moduleUser = new Modules\User;
        }

        return $this->moduleUser;
    }
}
