<?php

namespace Authentication\Client;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Json\Decoder as JsonDecoder;
use Zend\Json\Json;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

/**
 * This client manages all the operations needed to interface with the
 * social network API
 *
 * @package default
 */
class ApiClient {
    
    public static $logService;
    
    /**
     * Holds the client we will reuse in this class
     *
     * @var Client
     */
    protected static $client = null;
    
    /**
     * Holds the endpoint urls
     *
     * @var string
     */
    protected static $endpointHost = 'http://app-ecancer-api';

    protected static $endpointUsers = '/ci-auth/users';
    protected static $endpointGetUser = '/ci-auth/users/%s';

    protected static $endpointUserLogin = '/authenticate?profile';

    protected static $endpointForgottenStepOne = '/authenticate/forgotten';
    protected static $endpointForgottenStepTwo = '/authenticate/forgotten/code';
    protected static $endpointForgottenStepThree = '/authenticate/forgotten/password';

    
    public static function setLogService( $logService)
    {
        self::$logService = $logService;
    }

    /**
     * Perform an API request to authenticate a user
     *
     * @param array $postData Array containing username and password on their respective keys
     * @return Zend\Http\Response
     */
    public static function authenticate($postData)
    {
        $url = self::$endpointHost . self::$endpointUserLogin;
        return self::doRequest($url, $postData, Request::METHOD_POST);
    }

    /**
     * Perform an API request to POST register user
     *
     * @param array $data 
     * @return Zend\Http\Response
     */
    public static function postJson($url, $data)
    {
        $url = self::$endpointHost . $url;
        return self::doRequest($url, $data, Request::METHOD_POST);
    }
    
    /**
     * Perform an API request to POST register user
     *
     * @param array $data
     * @return Zend\Http\Response
     */
    public static function post($url, $data)
    {
        $url = self::$endpointHost . $url;
        return self::doRequest($url, $data, Request::METHOD_POST);
    }
    
    /**
     * Create a new instance of the Client if we don't have it or 
     * return the one we already have to reuse
     *
     * @return Client
     */
    protected static function getClientInstance()
    {
        if (self::$client === null) {
            self::$client = new Client();
            self::$client->setEncType(Client::ENC_URLENCODED);
            self::$client->setHeaders(array('Accept'=>'application/vnd.xadmin.v1+json','Content-Type'=>'application/vnd.xadmin.v1+json'));
            self::$client->setOptions(['sslverifypeer' => false]);
        }
        return self::$client;
    }
    
    /**
     * Perform a request to the API
     *
     * @param string $url
     * @param array $postData
     * @param Client $client
     * @return Zend\Http\Response
     */
    protected static function doRequest($url, array $postData = null, $method = Request::METHOD_GET)
    {
        //echo $url;
        $client = self::getClientInstance();
        
        $client->setUri($url);
        $client->setMethod($method);
        if (! empty($postData)) {
            
            //$client->setParameterPost($postData);
            $client->setRawBody(Json::encode($postData));
            $client->setEncType(Client::ENC_FORMDATA);
        }
        $response = $client->send();
        
        if ( ! $response->isSuccess() || $response->getStatusCode()!==200) {
            //$logger->debug("Status: " . $response->getStatusCode() . " happened with msg: " . $response->getReasonPhrase() . " , is client error? " . $response->isClientError());
            //$logger->debug(var_export($response->getBody(),true));
            return JsonDecoder::decode($response->getBody(), Json::TYPE_ARRAY);
        } else {
            //$logger->debug(var_export($response->getBody(),true));
            return JsonDecoder::decode($response->getBody(), Json::TYPE_ARRAY);
        }
    }
}