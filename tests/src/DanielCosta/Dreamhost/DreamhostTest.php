<?php

namespace DanielCosta\Dreamhost;

use Exception;
use PHPUnit_Framework_TestCase;

class DreamhostTest extends PHPUnit_Framework_TestCase {

    protected $apiKey = '6SHU5P2HLDAYECUM';

    public function testConstructSetApiKey()
    {
        $dh = new Dreamhost($this->apiKey);
        $result = $dh->getKey();
        $this->assertEquals($result, $this->apiKey);
    }

    public function testSetApiKey()
    {
        $dh = new Dreamhost('dummy');
        $dh->setKey($this->apiKey);
        $result = $dh->getKey();
        $this->assertEquals($result, $this->apiKey);
    }

    public function testSetValidFormat()
    {
        $dh = new Dreamhost($this->apiKey);
        $dh->setFormat('tab');
        $result = $dh->getFormat();
        $this->assertEquals($result, 'tab');

        $dh->setFormat('xml');
        $result = $dh->getFormat();
        $this->assertEquals($result, 'xml');

        $dh->setFormat('json');
        $result = $dh->getFormat();
        $this->assertEquals($result, 'json');

        $dh->setFormat('perl');
        $result = $dh->getFormat();
        $this->assertEquals($result, 'perl');

        $dh->setFormat('php');
        $result = $dh->getFormat();
        $this->assertEquals($result, 'php');

        $dh->setFormat('vaml');
        $result = $dh->getFormat();
        $this->assertEquals($result, 'vaml');

        $dh->setFormat('html');
        $result = $dh->getFormat();
        $this->assertEquals($result, 'html');
    }

    /**
     * @expectedException Exception
     */
    public function testSetInvalidFormat()
    {
        $dh = new Dreamhost($this->apiKey);
        $dh->setFormat('txt');
    }

}
