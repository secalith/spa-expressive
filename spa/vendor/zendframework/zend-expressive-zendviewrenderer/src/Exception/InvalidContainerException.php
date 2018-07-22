<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-zendviewrenderer for the canonical source repository
 * @copyright Copyright (c) 2017 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-zendviewrenderer/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Zend\Expressive\ZendView\Exception;

use RuntimeException;

class InvalidContainerException extends RuntimeException implements ExceptionInterface
{
}
