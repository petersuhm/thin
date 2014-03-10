<?php namespace Thin\Interfaces;

interface DocumentInterface {

    public function getMetadata($key);
    public function getContent();
    public function getHtmlContent(ParserInterface $parser = null);

    // For dynamic accessing properties and metadata
    public function __get($name);
}