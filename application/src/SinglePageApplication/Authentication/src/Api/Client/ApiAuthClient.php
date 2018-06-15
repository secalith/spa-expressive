<?php

namespace Authentication\Api\Client;

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Json\Decoder as JsonDecoder;
use Zend\Json\Json;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

/**
 * This client manages all the operations needed to interface with the
 * authentication API
 *
 * @package default
 */
class ApiAuthClient {

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

    public function setEndpoint($endpoint) {
        self::$endpointHost = $endpoint;
    }

    public function getEndpoint() {
        return self::$endpointHost;
    }

    /**
     * Perform an API request to PATCH
     *
     * @param array $data
     * @return Zend\Http\Response
     */
    public static function authenticate($url, $data)
    {
        $url = self::$endpointHost . $url;
        return self::doRequest($url, $data, Request::METHOD_PATCH);
    }

    /**
     * Perform an API request to POST register user
     *
     * @param array $data
     * @return Zend\Http\Response
     */
    public static function resetPassword($url, $data)
    {
        $url = self::$endpointHost . $url;
        return self::doRequest($url, $data, Request::METHOD_POST);
    }

    public static function logout($url, $data)
    {
        $url = self::$endpointHost . $url;
        return self::doRequest($url, $data, Request::METHOD_PUT);
    }


    public static function get($url)
    {
        $logger = new Logger;
        $logger->addWriter(new Stream('data/logs/apiclient.log'));

        $url = self::$endpointHost . $url;
        return self::doRequest($url, array(), Request::METHOD_GET);
    }

    public static function getUserDetails( $uid )
    {
        $url = sprintf(self::$endpointHost . self::$endpointUserAction, $uid );
        return self::doRequest($url, array(), Request::METHOD_GET);
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
            self::$client->setHeaders(array('Accept'=>'application/json','Content-Type'=>'application/json'));
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
        $logger = new Logger;
        $logger->addWriter(new Stream('data/logs/apiclient.log'));

        //echo $url;
        $client = self::getClientInstance();

        $client->setUri($url);
        $client->setMethod($method);
        if (! empty($postData)) {

            //$client->setParameterPost($postData);
            $client->setRawBody(Json::encode($postData));
            $logger->debug(var_export($postData,true));
            $logger->debug('OINK' . $method);
        }
        $logger->debug($url);
        $response = $client->send();

        //$logger->debug($response->getBody());

        /*echo '<pre>';
        var_dump($response);
        var_dump(JsonDecoder::decode($response->getBody(), Json::TYPE_ARRAY));
        echo '</pre>';*/
        $logger->debug(var_export($response->isSuccess(),true));
        //self::$logService->info('Something else...');


        // echo '<pre>';
        // var_dump();
        // echo '</pre>';
        // exit;

        if ( ! $response->isSuccess() || $response->getStatusCode()!==200) {
            $logger->debug("Status: " . $response->getStatusCode() . " happened with msg: " . $response->getReasonPhrase() . " , is client error? " . $response->isClientError());
            $logger->debug(var_export($response->getBody(),true));
            return JsonDecoder::decode($response->getBody(), Json::TYPE_ARRAY);
        } else {
            $logger->debug(var_export($response->getBody(),true));
            return JsonDecoder::decode($response->getBody(), Json::TYPE_ARRAY);
        }
    }
}