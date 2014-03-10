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

        $this->all()->shouldHaveCount(1);
    }

    function it_adds_documents_from_array(Document $document1, Document $document2)
    {
        $this->add(array($document1, $document2));

        $this->all()->shouldHaveCount(2);
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

    function it_should_be_countable()
    {
        $this->shouldImplement('Countable');
    }

    function it_should_count_documents(Document $document1)
    {
        $this->add($document1);

        $this->count()->shouldReturn(1);
    }

    function it_should_be_accessible_like_an_array()
    {
        $this->shouldImplement('ArrayAccess');
    }

    function it_tells_if_offset_exists(Document $document1)
    {
        $this->add($document1);

        $this->offsetExists(0)->shouldBe(true);
        $this->offsetExists(1)->shouldBe(false);
    }

    function it_gets_by_offset(Document $document1)
    {
        $this->add($document1);

        $this->offsetGet(0)->shouldReturn($document1);
    }

    function it_sets_by_offset()
    {
        $this->offsetSet(0, 'foo');

        $this->offsetGet(0)->shouldReturn('foo');
    }

    function it_sets_by_offset_given_null()
    {
        $this->offsetSet(null, array('bar'));

        $this->offsetGet(0)->shouldReturn('bar');
    }

    function it_unset_by_offset()
    {
        $this->offsetSet(0, 'foo');
        $this->offsetGet(0)->shouldReturn('foo');

        $this->offsetUnset(0);
        $this->offsetGet(0)->shouldReturn(null);
    }
}