<?php

namespace spec\Thin\Parsers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MarkdownExtraParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thin\Parsers\MarkdownExtraParser');
        $this->markdownExtra->shouldHaveType('Michelf\MarkdownExtra');
        $this->shouldImplement('Thin\Interfaces\ParserInterface');
    }

    function it_parses_markdown(\Michelf\MarkdownExtra $markdownExtra)
    {
        $markdownExtra->transform('# Markdown')
                      ->shouldBeCalled()
                      ->willReturn('<h1>Markdown</h1>');

        $this->beConstructedWith($markdownExtra);
        $this->parse('# Markdown')->shouldReturn('<h1>Markdown</h1>');
    }
}
