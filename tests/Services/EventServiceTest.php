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
use Twig\Environment;

final class EventServiceTest extends TestCase
{
    public function testHandleEvent(): void
    {
        $eventDispatcher = $this->createMock(EventDispatcher::class);
        $requestStack    = $this->createMock(RequestStack::class);
        $environment     = $this->createMock(Environment::class);

        $handler = $this->createMock(HandlerInterface::class);
        $handler->method('handle')->willReturnOnConsecutiveCalls('foo', 'bar');
        $className = $handler::class;

        $handlerManager = new HandlerManager();
        $handlerManager->addHandler($handler);

        $sut = new EventService(
            $eventDispatcher,
            $requestStack,
            $handlerManager,
        );

        $code1 = $this->createMock(TwigEventCodeInterface::class);
        $code1->method('getHandlerName')->willReturn($className);
        $code1->method('getPriority')->willReturn(2);

        $code2 = $this->createMock(TwigEventCodeInterface::class);
        $code2->method('getHandlerName')->willReturn($className);
        $code2->method('getPriority')->willReturn(1);

        $eventDispatcher
            ->expects(self::once())
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
