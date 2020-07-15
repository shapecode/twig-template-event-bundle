<?php

declare(strict_types=1);

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventRender;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Symfony\Component\HttpKernel\Fragment\FragmentHandler;
use Twig\Environment;

use function assert;

class RenderHandler implements HandlerInterface
{
    /** @var FragmentHandler */
    protected $fragment;

    public function __construct(FragmentHandler $fragment)
    {
        $this->fragment = $fragment;
    }

    /**
     * @inheritDoc
     */
    public function handle(TwigEventCodeInterface $code, Environment $env, array $context = []): string
    {
        assert($code instanceof TwigEventRender);

        $reference = new ControllerReference($code->getController(), $code->getAttributes(), $code->getQuery());

        return (string) $this->fragment->render($reference, $code->getStrategy());
    }
}
