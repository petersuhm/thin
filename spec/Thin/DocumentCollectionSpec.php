<?php namespace spec\Thin;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Thin\Document;

class DocumentCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thin\DocumentCollection');
    }

    function it_adds_document(Document $document)
    {
        $this->add($document);

        $this->documents->shouldHaveCount(1);
    }

    function it_adds_documents_from_array(Document $document1, Document $document2)
    {
        $this->add(array($document1, $document2));

        $this->documents->shouldHaveCount(2);
    }

    function it_add_documents_in_descending_order(Document $document1, Document $document2)
    {
        $this->add(array($document1, $document2));

        $this->all()[0]->shouldEqual($document2);
    }

    function it_return_all_documents(Document $document1, Document $document2)
    {
        $this->add(array($document1, $document2));

        $this->all()->shouldHaveCount(2);
    }

    function it_is_iteratable()
    {
        $this->shouldImplement('Iterator');
    }

    function it_returns_current_element(Document $document)
    {
        $this->add($document);

        $this->current()->shouldReturn($document);
    }

    function it_returns_key_of_current_element(Document $document)
    {
        $this->add($document);

        $this->key()->shouldReturn(0);
    }

    function it_moves_forward_to_next_element(Document $document1, Document $document2)
    {
        $this->add(array($document1, $document2));

        $this->next();

        $this->current()->shouldReturn($document1);
    }

    function it_rewinds_to_first_element(Document $document1, Document $document2)
    {
        $this->add(array($document1, $document2));

        $this->next();
        $this->rewind();

        $this->current()->shouldReturn($document2);
    }

    function it_can_be_valid(Document $document)
    {
        $this->add($document);

        $this->valid()->shouldReturn(true);
    }

    function it_can_be_invalid()
    {
        $this->valid()->shouldReturn(false);
    }

    function it_limit_documents(Document $document1, Document $document2)
    {
        $this->add(array($document1, $document2));

        $documents = $this->limit(1);

        $documents->shouldHaveCount(1);
        $documents[0]->shouldEqual($document2);
    }
}