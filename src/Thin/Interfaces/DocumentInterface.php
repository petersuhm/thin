<?php namespace Thin\Interfaces;

interface DocumentInterface {

    public function getMetadata($key);
    public function getContent();
    public function getHtmlContent(ParserInterface $parser = null);
}