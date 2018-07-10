<?php
namespace Authentication\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Authentication\Client\ApiClient as ApiClient;
use Zend\Stdlib\Hydrator\ClassMethods;
use Authentication\Entity\UserBasicEntity as UserEntity;
use Authentication\Entity\UserProfileEntity as UserProfileEntity;

class ApiAuthenticationAdapter implements AdapterInterface
{

    /**
     * Holds username or email
     *
     * @var unknown
     */
    protected $username;

    /**
     * Holds Password value
     *
     * @var string
     */
    protected $password;

    /**
     * Holds Users' Unique ID and better keep it safe
     *
     * @var string
     */
    protected  $uniqueid;

    function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface
     *               If authentication cannot be performed
     */
    public function authenticate()
    {

        $result = ApiClient::authenticate(array(

            'username' => $this->username,
            'password' => $this->password
        ));

        if (isset($result['data'],$result['data']['basic'])) {
            $hydrator = new ClassMethods();

            $user = new \stdClass();

            $user->basic = $hydrator->hydrate($result['data']['basic'], new UserEntity());

            if(isset($result['data']['profile'])) {
                $user->profile = $hydrator->hydrate($result['data']['profile'], new UserEntity());
            }
            $response = new Result(Result::SUCCESS, $user, array('Authentication successful.'));
        } else {
            $response = new Result(Result::FAILURE, NULL , array('Invalid credentials.'));
        }

        return $response;
    }

    public function setIdentity($username)
    {
        $this->username = $username;
    }

    public function setCredential($password)
    {
        $this->password = $password;
    }

    private function getResult($type, $identity, $message)
    {
        return new Result($type, $identity, array(
            $message
        ));
    }
}