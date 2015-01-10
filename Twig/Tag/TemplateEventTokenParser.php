<?php
namespace Shapecode\Bundle\TwigTemplateEventBundle\Twig\Tag;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Twig_TokenParser;
use Twig_Token;

/**
 * Class TemplateEventTokenParser
 * dispatches an event
 *
 * @package Shapecode\Bundle\TwigTemplateEventBundle\Twig\Tag
 * @author Nikita Loges
 * @date 10.01.2015
 *
 * <pre>
 *   {% event 'your_top_event' %}
 *     Body
 *   {% event 'your_bottom_event' %}
 * </pre>
 */
class TemplateEventTokenParser extends Twig_TokenParser
{

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(Twig_Token $token)
    {
        $parser = $this->parser;
        $stream = $parser->getStream();

        $expr = $this->parser->getExpressionParser()->parseExpression();

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new TemplateEventNode($expr, $this->dispatcher, $token->getLine(), $this->getTag());
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return 'event';
    }
}