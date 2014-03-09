<?php namespace Thin\Interfaces;

interface DocumentInterface {

    public function getMetadata($key);
    public function getContent();
    public function getHtmlContent(ParserInterface $parser = null);

    // For dynamic accessing metadata
    public function __call($key, $arguments);
}