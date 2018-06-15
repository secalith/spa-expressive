<?php

declare(strict_types=1);

namespace Auth\Adapter;

use	Zend\Authentication\Adapter\AdapterInterface;
use	Zend\Authentication\Result;

class AuthAdapter implements AdapterInterface
{
    private $password;
    private $username;
    public function __construct(/*	any	dependencies	*/)
    {
        //	Likely	assign	dependencies	to	properties
    }
    public function setPassword(string $password) : void
    {
        $this->password  = $password;
    }
    public function setUsername(string $username) : void
    {
        $this->username	= $username;
    }
    /**
     *	Performs	an	authentication	attempt
     *
     *	@return	Result
     */
    public function authenticate()
    {
        //	Retrieve	the	user's	information	(e.g.	from	a	database)
        //	and	store	the	result	in	$row	(e.g.	associative	array).
        //	If	you	do	something	like	this,	always	store	the	passwords	using	the
        //	PHP	password_hash()	function!
        if (password_verify($this->password, $row['password'])) {
            return new	Result(Result::SUCCESS, $row);
        }
        return new Result(Result::FAILURE_CREDENTIAL_INVALID,	$this->username);
    }
}