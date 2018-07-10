<?php
namespace Auth\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use Auth\Model\UserEntity;

class AuthenticationAdapter implements AdapterInterface
{
    private $userTable;
    private $credentialsTable;
    /**
     * User email.
     * @var string
     */
    private $email;

    /**
     * Password
     * @var string
     */
    private $password;

    /**
     * Constructor.
     */
    public function __construct($userTable,$credentialsTable)
    {
        $this->userTable = $userTable;
        $this->credentialsTable = $credentialsTable;
    }

    /**
     * Sets user email.
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setCredentials($password){
        $this->password = (string)$password;
        return $this;
    }
    /**
     * Sets password.
     */
    public function setPassword($password)
    {
        $this->password = (string)$password;
        return $this;
    }

    /**
     * Performs an authentication attempt.
     */
    public function authenticate()
    {
        $user = $this->userTable->select(['email'=>$this->email])->current();
//        $user = $user->current();
        $credentials = $this->credentialsTable->select(['uid'=>$user->getUid()])->current();

        if( $user==null || $credentials==null ) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                ['Invalid credentials..']);
        }

        $bcrypt = new Bcrypt();

        $passwordHash = $credentials->getPassword();
        if ($bcrypt->verify($this->password, $passwordHash)) {
            return new Result(
                Result::SUCCESS,
                $this->email,
                ['Authenticated successfully.']);
        }

        // If password check didn't pass return 'Invalid Credential' failure status.
        return new Result(
            Result::FAILURE_CREDENTIAL_INVALID,
            null,
            ['Invalid credentials.']
        );

    }
}