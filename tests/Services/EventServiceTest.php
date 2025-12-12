<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Tests\Services;

use PHPUnit\Framework\TestCase;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler\HandlerInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\TwigTemplateEvent;
use Shapecode\Bundle\TwigTemplateEventBundle\Manager\HandlerManager;
use Shapecode\Bundle\TwigTemplateEventBundle\Services\EventService;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Service\ServiceProviderInterface;
use Twig\Environment;

final class EventServiceTest extends TestCase
{
    public function testHandleEvent(): void
    {
        $eventDispatcher = $this->createMock(EventDispatcher::class);
        $requestStack    = self::createStub(RequestStack::class);
        $environment     = self::createStub(Environment::class);

        $handler = self::createStub(HandlerInterface::class);
        $handler->method('handle')->willReturnOnConsecutiveCalls('foo', 'bar');
        $className = $handler::class;

        $serviceProvider = self::createStub(ServiceProviderInterface::class);
        $serviceProvider->method('has')->willReturn(true);
        $serviceProvider->method('get')->willReturn($handler);
        $handlerManager = new HandlerManager($serviceProvider);

        $sut = new EventService(
            $eventDispatcher,
            $requestStack,
            $handlerManager,
        );

        $code1 = self::createStub(TwigEventCodeInterface::class);
        $code1->method('getHandlerName')->willReturn($className);
        $code1->method('getPriority')->willReturn(2);

        $code2 = self::createStub(TwigEventCodeInterface::class);
        $code2->method('getHandlerName')->willReturn($className);
        $code2->method('getPriority')->willReturn(1);

        $eventDispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->willReturnCallback(static function (TwigTemplateEvent $event) use ($code1, $code2): TwigTemplateEvent {
                self::assertSame('test', $event->getEventName());
                self::assertSame([
                    'parameter' => 'foo',
                ], $event->getParameters());
                self::assertSame([
                    'context' => 'bar',
                ], $event->getContext());
                self::assertSame('test', $event->getEventName());

                $event->addCode($code1);
                $event->addCode($code2);

                return $event;
            });

        $compiled = $sut->handleEvent(
            'test',
            $environment,
            [
                'parameter' => 'foo',
            ],
            [
                'context' => 'bar',
            ],
        );

        self::assertSame('foobar', $compiled);
    }
}
