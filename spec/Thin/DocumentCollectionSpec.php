<?php namespace spec\Thin;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DocumentCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thin\DocumentCollection');
    }

    function it_adds_document(\Thin\Document $document)
    {
        $this->add($document);

        $this->documents->shouldHaveCount(1);
    }

    function it_adds_documents_from_array(\Thin\Document $document1, \Thin\Document $document2)
    {
        $this->add(array($document1, $document2));

        $this->documents->shouldHaveCount(2);
    }
}