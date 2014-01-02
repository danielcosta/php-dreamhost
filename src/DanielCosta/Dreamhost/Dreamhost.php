<?php namespace DanielCosta\Dreamhost;

use \Exception;
use \InvalidArgumentException;

/**
 * Class Dreamhost
 *
 * @package DanielCosta\Dreamhost
 * @author  Daniel Costa <danielcosta@gmail.com>
 * @version 2.0.0
 */
class Dreamhost
{

    /**
     * @var string
     */
    private $http_code;

    /**
     * @var array
     */
    private $http_info = array();

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $error;

    /**
     * @var string
     */
    private $error_number;

    private $config;

    /*
     * Create a new Dreamhost instance.
     *
     * @return void
     */
    #public function __construct($config)
    public function __construct($config = null)
    {
        if (isset($config)) {
            $this->api_url = $config['api_url'];
            $this->format  = $config['format'];
            $this->key     = $config['key'];
        }
    }

    /**
     * Call to execute commands
     *
     * @param string $cmd
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($cmd, array $args)
    {
        return $this->cmdApi($cmd, $args);
    }

    /**
     * Set return format
     *
     * @param $format
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setFormat($format)
    {
        if (!$this->isValidFormat($format)) {
            throw new InvalidArgumentException('Invalid return format');
        }

        $this->format = $format;

        return $this;
    }

    /**
     * Get expected API return format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set API auth key
     *
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Get API auth key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
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
     * Returns if format is valid from available formats
     *
     * @param string $format
     *
     * @return bool
     */
    private function isValidFormat($format)
    {
        return in_array($format, $this->getAvailableFormats());
    }

    /**
     * Returns a properly formatted semi-random and unique UUID that
     * the helps make sure we don't submit the same command twice.
     *
     * @return string
     */
    private function generateUuid()
    {
        /*
          Calculate an MD5 of milliseconds & seconds since epoch
          and a random number between 0 and getrandmax()

          Example:
            0.84404300 1359380852 1828891132
         */
        $uuid = md5( microtime( FALSE ) . rand() );

        /*
          Format like a UUID

          Example:
            before: 550e8400e29b41d4a716446655440000
            after:  550e8400-e29b-41d4-a716-446655440000

         */
        $uuid = substr( $uuid, 0, 8 ) .
            "-" . substr( $uuid, 8, 4 ) .
            "-" . substr( $uuid, 12, 4 ) .
            "-" . substr( $uuid, 16, 4 ) .
            "-" . substr( $uuid, 20, 12 );

        return $uuid;

    }

    /** 
     *
     * Get header info to store.  Used by CURLOPT_HEADERFUNCTION
     *
     * @param object $ch
     * @param string $header
     *
     * @return integer
     */
    private function getHeader($ch, $header) {
        $i = strpos($header, ':');
        if (!empty($i)) {
            $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->http_header[$key] = $value;
        }

        return strlen($header);

    }

    /**
     * Retrieve http response API call
     *
     * @param string $cmd
     * @param array  $args
     *
     * @return mixed
     */
    public function cmdApi($cmd, array $args = array())
    {
        $baseparams = array(
            'key'       => $this->key,
            'unique_id' => $this->generateUuid(),
            'cmd'       => trim($cmd),
            'format'    => $this->format,
        );

        if (is_array($args)) {
            $parameters = array_merge($baseparams, $args);
        } else {
            $parameters = $baseparams;
        }

        return $this->getHttp($this->api_url, 'GET', $parameters);

    }

    /*
     * Make an HTTP request and return API results
     *
     * @param string $url
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    private function getHttp($url, $method, $parameters = NULL) {

        /* setup CURL */
        $ch = curl_init();

        /* Setup some default CURL options */
        curl_setopt($ch, CURLOPT_USERAGENT, 'UserAgent/1.0');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_VERBOSE, FALSE);
    
        switch ($method) {
          case 'GET':
            $pcount = 0;
            foreach ($parameters as $key=>$value)
            {
                if (!$pcount)
                  $url .= '?'.$key.'='.urlencode($value);
                else
                  $url .= '&'.$key.'='.urlencode($value);
                $pcount++;
            }
            break;
          case 'POST':
            $postfields = $parameters;
            curl_setopt($ch, CURLOPT_POST, TRUE);
            if (!empty($postfields)) {
              curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
            }
            break;
          case 'DELETE':
            $postfields = $parameters;
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            if (!empty($postfields)) {
              $url = "{$url}?{$postfields}";
            }
            break;
        }

        /* Make CURL call */
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
   
        /* Save some information about this CURL call */ 
        $this->http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->http_info = array_merge($this->http_info, curl_getinfo($ch));
        $this->url = $url;
        $this->error = curl_error($ch);
        $this->error_number = curl_errno($ch);
   
        if (!$result) {
            throw new Exception($this->error, $this->error_number);
        }

        curl_close($ch);

        return $result;

    }

    /*
     * Return the last HTTP status code.
     *
     * @return string
     */
    public function getHttpCode()
    {
        return $this->http_code;
    }

    /*
     * Return the last HTTP headers returned.
     *
     * @return string
     */
    public function getHttpInfo()
    {
        return $this->http_info;
    }

    /*
     * Return the last API call URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /*
     * Return the last curl error number
     *
     * @return string
     */
    public function getErrorNumber()
    {
        return $this->error_number;
    }

    /*
     * Return the last curl error string
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

}
