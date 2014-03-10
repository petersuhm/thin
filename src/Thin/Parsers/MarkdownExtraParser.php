<?php namespace Thin\Parsers;

use Thin\Interfaces\ParserInterface;
use Michelf\MarkdownExtra;

class MarkdownExtraParser implements ParserInterface {

    public function __construct(MarkdownExtra $markdownExtra = null)
    {
        $this->markdownExtra = ($markdownExtra === null) ? new MarkdownExtra : $markdownExtra;
    }

    public function parse($source)
    {
        return $this->markdownExtra->transform($source);
    }
}
