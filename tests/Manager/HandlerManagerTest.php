<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Tests\Manager;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Shapecode\Bundle\TwigTemplateEventBundle\Manager\HandlerManager;
use Symfony\Contracts\Service\ServiceProviderInterface;

final class HandlerManagerTest extends TestCase
{
    public function testMissingHandler(): void
    {
        $sut = new HandlerManager(self::createStub(ServiceProviderInterface::class));

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('handler test not found');
        $this->expectExceptionCode(1596984726680);

        $sut->getHandler('test');
    }
}
