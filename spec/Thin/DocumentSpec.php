<?php

namespace spec\Thin;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DocumentSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thin\Document');
        $this->shouldImplement('Thin\Interfaces\DocumentInterface');
    }

    function it_is_constructed_with_a_parser(\Thin\Parsers\MarkdownParser $parser)
    {
        $this->beConstructedWith($parser);
        $this->parser->shouldHaveType('Thin\Parsers\MarkdownParser');
    }

    function it_gets_metadata()
    {
        $this->metadata = array('title' => 'The title');

        $this->getMetadata('title')->shouldReturn('The title');
    }

    function it_gets_content()
    {
        $this->content = '# Markdown';

        $this->getContent()->shouldReturn('# Markdown');
    }

    function it_gets_htmlContent(\Thin\Parsers\MarkdownParser $parser)
    {
        $parser->parse('# Markdown')->shouldBeCalled()->willReturn('<h1>Markdown</h1>');

        $this->content = '# Markdown';
        $this->getHtmlContent($parser);
    }

    function it_gets_htmlContent_with_no_parser(\Thin\Parsers\MarkdownParser $parser)
    {
        $parser->parse('# Markdown')->shouldBeCalled()->willReturn('<h1>Markdown</h1>');

        $this->beConstructedWith($parser);
        $this->content = '# Markdown';
        $this->getHtmlContent();
    }
}
