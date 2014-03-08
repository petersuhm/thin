<?php namespace Thin;

use Thin\Interfaces\DocumentInterface;
use Thin\Interfaces\ParserInterface;
use Thin\Parsers\MarkdownParser;

class Document implements DocumentInterface {

    public $metadata;
    public $content;

    public function __construct(ParserInterface $parser = null)
    {
        $this->parser = ($parser === null) ? new MarkdownParser : $parser;
    }

    public function getMetadata($key)
    {
        return $this->metadata[$key];
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getHtmlContent(ParserInterface $parser = null)
    {
        return $parser->parse($this->content);
    }
}