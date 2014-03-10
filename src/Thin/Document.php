<?php namespace Thin;

use Thin\Interfaces\DocumentInterface;
use Thin\Interfaces\ParserInterface;
use Thin\Parsers\MarkdownParser;

class Document implements DocumentInterface {

    protected $metadata;
    protected $content;
    protected $parser;

    public function __construct(ParserInterface $parser = null)
    {
        $this->parser = ($parser === null) ? new MarkdownParser : $parser;
    }

    public function getMetadata($key)
    {
        return $this->metadata[$key];
    }

    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getHtmlContent(ParserInterface $parser = null)
    {
        if ($parser === null)
            return $this->parser->parse($this->content);

        return $parser->parse($this->content);
    }

    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function __call($key, $arguments)
    {
        return $this->getMetadata($key);
    }

    public function __get($name)
    {
        if (property_exists($this, $name))
        {
            return $this->$name;
        }
    }
}