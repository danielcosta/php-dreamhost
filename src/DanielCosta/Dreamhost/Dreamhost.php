<?php

namespace DanielCosta\Dreamhost;

use \Exception;

/**
 * Class Dreamhost
 *
 * @package Dreamhost
 * @author  Daniel Costa <danielcosta@gmail.com>
 * @version 1.0
 */
class Dreamhost {

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $format = 'json';

    public function __construct($key, $format = null)
    {
        $this->key = $key;

        if (!empty($format)) {
            $this->setFormat($format);
        }
    }

    /**
     * @param $cmd
     * @param $args
     *
     * @return mixed
     */
    public function __call($cmd, $args)
    {
        return $this->exec($cmd, $args);
    }

    /**
     * @param       $cmd
     * @param array $args
     *
     * @return mixed
     * @throws \Exception
     */
    public function exec($cmd, $args = Array())
    {
        $args['cmd'] = $cmd;
        $args['key'] = $this->key;
        $args['format'] = 'json';

        $ch = curl_init('https://api.dreamhost.com');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $error = curl_error($ch);
        $errorNumber = curl_errno($ch);
        curl_close($ch);

        if (!$result) {
            throw new Exception($error, $errorNumber);
        }

        $data = json_decode($result, 1);

        if (!$data) {
            throw new Exception('JSON parse error on: ' . $result);
        }

        if ('error' === $data['result']) {
            throw new Exception($data['data']);
        } else {
            return $data['data'];
        }
    }

    /**
     * Set return format
     *
     * @param $format
     */
    public function setFormat($format)
    {
        if (!$this->isValidFormat($format)) {
            throw new Exception('Invalid return format');
        }

        $this->format = $format;

        return $this;
    }

    /**
     * Get available return format
     *
     * @return array
     */
    private function getAvailableFormats()
    {
        return array(
            'tab',
            'xml',
            'json',
            'perl',
            'php',
            'vaml',
            'html',
        );
    }

    /**
     * @param $format
     *
     * @return bool
     */
    private function isValidFormat($format)
    {
        return in_array($format, $this->getAvailableFormats());
    }

}