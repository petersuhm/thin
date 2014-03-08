<?php

namespace spec\Thin\Parsers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Mockery as m;

class MarkdownParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thin\Parsers\MarkdownParser');
        $this->markdown->shouldHaveType('Michelf\Markdown');
        $this->shouldImplement('Thin\Interfaces\ParserInterface');
    }

    function it_parses_markdown(\Michelf\Markdown $markdown)
    {
        $markdown->transform('# Markdown')
                 ->shouldBeCalled()
                 ->willReturn('<h1>Markdown</h1>');

        $this->beConstructedWith($markdown);
        $this->parse('# Markdown')->shouldReturn('<h1>Markdown</h1>');
    }
}
