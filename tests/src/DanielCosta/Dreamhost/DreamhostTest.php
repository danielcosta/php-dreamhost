<?php

namespace DanielCosta\Dreamhost;

use Exception;
use PHPUnit_Framework_TestCase;

class DreamhostTest extends PHPUnit_Framework_TestCase {

    /**
     * @var string
     */
    protected $apiKey = '6SHU5P2HLDAYECUM';

    /**
     * @var string
     */
    protected $apiListAccessibleCmdsExpectedResult = 'a:20:{i:0;a:4:{s:3:"cmd";s:28:"announcement_list-list_lists";s:5:"order";s:8:"see_docs";s:4:"args";s:8:"see_docs";s:7:"optargs";s:8:"see_docs";}i:1;a:4:{s:3:"cmd";s:34:"announcement_list-list_subscribers";s:5:"order";s:8:"see_docs";s:4:"args";s:8:"see_docs";s:7:"optargs";s:8:"see_docs";}i:2;a:4:{s:3:"cmd";s:24:"api-list_accessible_cmds";s:5:"order";a:4:{i:0;s:3:"cmd";i:1;s:4:"args";i:2;s:7:"optargs";i:3;s:5:"order";}s:4:"args";a:0:{}s:7:"optargs";a:0:{}}i:3;a:4:{s:3:"cmd";s:16:"dns-list_records";s:5:"order";s:8:"see_docs";s:4:"args";s:8:"see_docs";s:7:"optargs";s:8:"see_docs";}i:4;a:4:{s:3:"cmd";s:19:"domain-list_domains";s:5:"order";a:16:{i:0;s:10:"account_id";i:1;s:6:"domain";i:2;s:4:"home";i:3;s:4:"type";i:4;s:9:"unique_ip";i:5;s:12:"hosting_type";i:6;s:4:"user";i:7;s:4:"path";i:8;s:11:"outside_url";i:9;s:10:"www_or_not";i:10;s:3:"php";i:11;s:8:"security";i:12;s:7:"fastcgi";i:13;s:6:"xcache";i:14;s:9:"php_fcgid";i:15;s:9:"passenger";}s:4:"args";a:0:{}s:7:"optargs";a:0:{}}i:5;a:4:{s:3:"cmd";s:25:"domain-list_registrations";s:5:"order";a:56:{i:0;s:10:"account_id";i:1;s:6:"domain";i:2;s:7:"expires";i:3;s:7:"created";i:4;s:8:"modified";i:5;s:9:"autorenew";i:6;s:6:"locked";i:7;s:7:"expired";i:8;s:3:"ns1";i:9;s:3:"ns2";i:10;s:3:"ns3";i:11;s:3:"ns4";i:12;s:10:"registrant";i:13;s:14:"registrant_org";i:14;s:18:"registrant_street1";i:15;s:18:"registrant_street2";i:16;s:15:"registrant_city";i:17;s:16:"registrant_state";i:18;s:14:"registrant_zip";i:19;s:18:"registrant_country";i:20;s:16:"registrant_phone";i:21;s:14:"registrant_fax";i:22;s:16:"registrant_email";i:23;s:4:"tech";i:24;s:8:"tech_org";i:25;s:12:"tech_street1";i:26;s:12:"tech_street2";i:27;s:9:"tech_city";i:28;s:10:"tech_state";i:29;s:8:"tech_zip";i:30;s:12:"tech_country";i:31;s:10:"tech_phone";i:32;s:8:"tech_fax";i:33;s:10:"tech_email";i:34;s:7:"billing";i:35;s:11:"billing_org";i:36;s:15:"billing_street1";i:37;s:15:"billing_street2";i:38;s:12:"billing_city";i:39;s:13:"billing_state";i:40;s:11:"billing_zip";i:41;s:15:"billing_country";i:42;s:13:"billing_phone";i:43;s:11:"billing_fax";i:44;s:13:"billing_email";i:45;s:5:"admin";i:46;s:9:"admin_org";i:47;s:13:"admin_street1";i:48;s:13:"admin_street2";i:49;s:10:"admin_city";i:50;s:11:"admin_state";i:51;s:9:"admin_zip";i:52;s:13:"admin_country";i:53;s:11:"admin_phone";i:54;s:9:"admin_fax";i:55;s:11:"admin_email";}s:4:"args";a:0:{}s:7:"optargs";a:0:{}}i:6;a:4:{s:3:"cmd";s:28:"dreamhost_ps-list_pending_ps";s:5:"order";a:4:{i:0;s:10:"account_id";i:1;s:2:"ip";i:2;s:4:"type";i:3;s:5:"stamp";}s:4:"args";a:0:{}s:7:"optargs";a:0:{}}i:7;a:4:{s:3:"cmd";s:20:"dreamhost_ps-list_ps";s:5:"order";a:8:{i:0;s:10:"account_id";i:1;s:2:"ps";i:2;s:11:"description";i:3;s:6:"status";i:4;s:4:"type";i:5;s:9:"memory_mb";i:6;s:10:"start_date";i:7;s:2:"ip";}s:4:"args";a:0:{}s:7:"optargs";a:0:{}}i:8;a:4:{s:3:"cmd";s:32:"dreamhost_ps-list_reboot_history";s:5:"order";a:1:{i:0;s:5:"stamp";}s:4:"args";a:1:{i:0;s:2:"ps";}s:7:"optargs";a:0:{}}i:9;a:4:{s:3:"cmd";s:26:"dreamhost_ps-list_settings";s:5:"order";a:2:{i:0;s:7:"setting";i:1;s:5:"value";}s:4:"args";a:1:{i:0;s:2:"ps";}s:7:"optargs";a:0:{}}i:10;a:4:{s:3:"cmd";s:30:"dreamhost_ps-list_size_history";s:5:"order";a:5:{i:0;s:5:"stamp";i:1;s:14:"period_seconds";i:2;s:9:"memory_mb";i:3;s:12:"monthly_cost";i:4;s:11:"period_cost";}s:4:"args";a:1:{i:0;s:2:"ps";}s:7:"optargs";a:0:{}}i:11;a:4:{s:3:"cmd";s:23:"dreamhost_ps-list_usage";s:5:"order";a:3:{i:0;s:5:"stamp";i:1;s:9:"memory_mb";i:2;s:4:"load";}s:4:"args";a:1:{i:0;s:2:"ps";}s:7:"optargs";a:0:{}}i:12;a:4:{s:3:"cmd";s:19:"dreamhost_ps-reboot";s:5:"order";a:0:{}s:4:"args";a:1:{i:0;s:2:"ps";}s:7:"optargs";a:0:{}}i:13;a:4:{s:3:"cmd";s:25:"dreamhost_ps-set_settings";s:5:"order";a:2:{i:0;s:7:"setting";i:1;s:5:"value";}s:4:"args";a:1:{i:0;s:2:"ps";}s:7:"optargs";a:0:{}}i:14;a:4:{s:3:"cmd";s:21:"dreamhost_ps-set_size";s:5:"order";a:2:{i:0;s:9:"memory_mb";i:1;s:5:"token";}s:4:"args";a:2:{i:0;s:2:"ps";i:1;s:4:"size";}s:7:"optargs";a:1:{i:0;s:5:"force";}}i:15;a:4:{s:3:"cmd";s:17:"mail-list_filters";s:5:"order";s:8:"see_docs";s:4:"args";s:8:"see_docs";s:7:"optargs";s:8:"see_docs";}i:16;a:4:{s:3:"cmd";s:14:"mysql-list_dbs";s:5:"order";s:8:"see_docs";s:4:"args";s:8:"see_docs";s:7:"optargs";s:8:"see_docs";}i:17;a:4:{s:3:"cmd";s:20:"mysql-list_hostnames";s:5:"order";s:8:"see_docs";s:4:"args";s:8:"see_docs";s:7:"optargs";s:8:"see_docs";}i:18;a:4:{s:3:"cmd";s:16:"mysql-list_users";s:5:"order";s:8:"see_docs";s:4:"args";s:8:"see_docs";s:7:"optargs";s:8:"see_docs";}i:19;a:4:{s:3:"cmd";s:21:"user-list_users_no_pw";s:5:"order";a:8:{i:0;s:10:"account_id";i:1;s:8:"username";i:2;s:4:"type";i:3;s:5:"shell";i:4;s:4:"home";i:5;s:12:"disk_used_mb";i:6;s:8:"quota_mb";i:7;s:5:"gecos";}s:4:"args";a:0:{}s:7:"optargs";a:0:{}}}';

    public function testConstructSetApiKey()
    {
        $dh = new Dreamhost($this->apiKey);
        $this->assertEquals($dh->getUser()->getUsers(), true);
//        $result = $dh->getKey();
//        $this->assertEquals($this->apiKey, $result);
    }

//    public function testSetApiKey()
//    {
//        $dh = new Dreamhost('dummy');
//        $dh->setKey($this->apiKey);
//        $result = $dh->getKey();
//        $this->assertEquals($this->apiKey, $result);
//    }
//
//    public function testSetValidFormat()
//    {
//        $dh = new Dreamhost($this->apiKey);
//        $dh->setFormat('tab');
//        $result = $dh->getFormat();
//        $this->assertEquals('tab', $result);
//
//        $dh->setFormat('xml');
//        $result = $dh->getFormat();
//        $this->assertEquals('xml', $result);
//
//        $dh->setFormat('json');
//        $result = $dh->getFormat();
//        $this->assertEquals('json', $result);
//
//        $dh->setFormat('perl');
//        $result = $dh->getFormat();
//        $this->assertEquals('perl', $result);
//
//        $dh->setFormat('php');
//        $result = $dh->getFormat();
//        $this->assertEquals('php', $result);
//
//        $dh->setFormat('vaml');
//        $result = $dh->getFormat();
//        $this->assertEquals('vaml', $result);
//
//        $dh->setFormat('html');
//        $result = $dh->getFormat();
//        $this->assertEquals('html', $result);
//    }
//
//    /**
//     * @expectedException Exception
//     */
//    public function testSetInvalidFormat()
//    {
//        $dh = new Dreamhost($this->apiKey);
//        $dh->setFormat('txt');
//        $result = $dh->getFormat();
//        $this->assertEquals('txt', $result);
//    }
//
//    public function testApiCall()
//    {
//        $dh = new Dreamhost($this->apiKey);
//        $result = $dh->exec('api-list_accessible_cmds');
//        $this->assertJson(json_encode(unserialize($this->apiListAccessibleCmdsExpectedResult)), json_encode($result));
//    }
//
//    public function testApiMagicCall()
//    {
//        $dh = new Dreamhost($this->apiKey);
//        $method = 'api-list_accessible_cmds';
//        $result = $dh->$method();
//        $this->assertJson(json_encode(unserialize($this->apiListAccessibleCmdsExpectedResult)), json_encode($result));
//    }

}
