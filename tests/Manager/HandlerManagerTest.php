<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Tests\Manager;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\RenderHandler;
use Shapecode\Bundle\TwigTemplateEventBundle\Manager\HandlerManager;
use Symfony\Component\HttpKernel\Fragment\FragmentHandler;

final class HandlerManagerTest extends TestCase
{
    public function testGet(): void
    {
        $handler = new RenderHandler($this->createMock(FragmentHandler::class));
        $sut     = new HandlerManager();
        $sut->addHandler($handler);

        self::assertSame($handler, $sut->getHandler(RenderHandler::class));
    }

    public function testAlreadyExists(): void
    {
        $handler = new RenderHandler($this->createMock(FragmentHandler::class));
        $sut     = new HandlerManager();
        $sut->addHandler($handler);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('handler Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\RenderHandler already exists');
        $this->expectExceptionCode(1596984981559);

        $sut->addHandler($handler);
    }

    public function testMissingHandler(): void
    {
        $sut = new HandlerManager();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('handler test not found');
        $this->expectExceptionCode(1596984726680);

        $sut->getHandler('test');
    }
}
