<?php namespace Thin\Parsers;

use Thin\Interfaces\ParserInterface;
use Michelf\Markdown;

class MarkdownParser implements ParserInterface {

    public function __construct(Markdown $markdown = null)
    {
        $this->markdown = ($markdown === null) ? new Markdown : $markdown;
    }

    public function parse($source)
    {
        return $this->markdown->transform($source);
    }
}