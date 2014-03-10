<?php namespace spec\Thin;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thin\Post');
        $this->shouldHaveType('Thin\Document');
    }

    function it_sets_and_gets_slug()
    {
        $this->setSlug('some-slug');
        $this->getSlug()->shouldReturn('some-slug');
    }
}
