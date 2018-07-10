<?php

namespace Authentication\Service;

use Authentication\Service\AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Authentication\Storage\Session;

class AuthManager
{
    private $authStorage;
    private $authAdapter;
    private $authService;

    public function __construct(
        Session $authStorage,
        AuthAdapter $authAdapter,
        AuthenticationService $authService)
    {
        $this->authStorage = $authStorage;
        $this->authAdapter = $authAdapter;
        $this->authService = $authService;
    }

    /**
     * Performs a login attempt. If $rememberMe argument is true, it forces the session
     * to last for one month (otherwise the session expires on one hour).
     */
    public function login($email, $password, $rememberMe=0)
    {
        // Check if user has already logged in. If so, do not allow to log in
        // twice.
        if ($this->authService->getIdentity()!=null) {
            throw new \Exception('Already logged in');
        }
        // Authenticate with login/password.
        $this->authService->getAdapter()
            ->setEmail($email)
            ->setCredentials($password);

        $result = $this->authService->authenticate();

        if ($result->getCode()==Result::SUCCESS && $rememberMe) {
            // Session cookie will expire in 1 month (30 days).
            $this->sessionManager->rememberMe(60*60*24*30);
        }

        return $result;
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

        // Remove identity from session.
        $this->authService->clearIdentity();
    }
}