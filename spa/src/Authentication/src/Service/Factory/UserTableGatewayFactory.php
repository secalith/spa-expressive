<?php
namespace Authentication\Service\Factory;

use Common\Service\Factory\CommonTableGatewayFactory;

class UserTableGatewayFactory extends CommonTableGatewayFactory
{
    protected $identifier = "user";
    protected $model = \Authentication\Model\UserModel::class;
}
