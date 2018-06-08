<?php

namespace Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler;

use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventCodeInterface;
use Shapecode\Bundle\TwigTemplateEventBundle\Event\Code\TwigEventRender;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Symfony\Component\HttpKernel\Fragment\FragmentHandler;
use Twig\Environment;

/**
 * Class RenderHandler
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Event\Handler
 * @author  Nikita Loges
 */
class RenderHandler implements HandlerInterface
{

    /** @var FragmentHandler */
    protected $fragment;

    /**
     * @param FragmentHandler $fragment
     */
    public function __construct(FragmentHandler $fragment)
    {
        $this->fragment = $fragment;
    }

    /**
     * @inheritDoc
     *
     * @param TwigEventRender $code
     */
    public function handle(TwigEventCodeInterface $code, Environment $env, array $context = [])
    {
        $reference = new ControllerReference($code->getController(), $code->getAttributes(), $code->getQuery());

        return $this->fragment->render($reference, $code->getStrategy());
    }

}
