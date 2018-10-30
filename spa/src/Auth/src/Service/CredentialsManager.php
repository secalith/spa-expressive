<?php

namespace Auth\Service;

use Auth\Model\CredentialsResetTable;
use Auth\Adapter\AuthenticationAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Authentication\Storage\Session;

class CredentialsManager
{
    private $userTable;
    private $credentialsTable;
    private $credentialsResetTable;

    public function __construct(
        $userTable,
        $credentialsTable,
        CredentialsResetTable $credentialsResetTable
    )
    {
        $this->userTable = $userTable;
        $this->credentialsTable = $credentialsTable;
        $this->credentialsResetTable = $credentialsResetTable;
    }

    /**
     * Performs a login attempt. If $rememberMe argument is true, it forces the session
     * to last for one month (otherwise the session expires on one hour).
     */
    public function checkUserExists($email)
    {
        return $this->credentialsTable->fetchBy($email,'email')!=null;

    }

    public function saveResetToken($data)
    {
        $this->credentialsResetTable->saveItem($data);
    }

    /**
     * Performs user logout.
     */
    public function logout()
    {
        // Allow to log out only when user is logged in.
        if ($this->authService->getIdentity()==null) {
            throw new \Exception('The user is not logged in');
        }

//        $this->authService->getStorage()->forgetMe();

        // Remove identity from session.
        return $this->authService->clearIdentity();
    }
}