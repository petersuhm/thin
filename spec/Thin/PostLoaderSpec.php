<?php namespace spec\Thin;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostLoaderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Thin\PostLoader');
        $this->shouldImplement('Thin\Interfaces\DocumentLoaderInterface');
    }

    function it_is_configurable()
    {
        $settings = array(
            'document_path' => 'spec/fixtures',
            'document_ext' => '.md'
        );

        $this->config($settings);

        $this->setting('document_path')->shouldEqual($settings['document_path']);
        $this->setting('document_ext')->shouldEqual($settings['document_ext']);
    }

    function it_return_markdown_files_as_documents()
    {
        $metadata1 = array('title' => 'First post', 'date' => '2014-03-09');
        $metadata2 = array('title' => 'Second post', 'date' => '2014-03-10');

        $this->config(array(
            'document_path' => 'spec/fixtures',
            'document_ext' => '.md'
        ));

        $documents = $this->all();

        $documents->shouldHaveType('Thin\DocumentCollection');
        $documents->all()[1]->getMetadata('title')->shouldEqual($metadata1['title']);
        $documents->all()[1]->getMetadata('date')->shouldEqual($metadata1['date']);
        $documents->all()[1]->getContent()->shouldEqual('# First post');
        $documents->all()[1]->getSlug()->shouldEqual('first-post');
        $documents->all()[0]->getMetadata('title')->shouldEqual($metadata2['title']);
        $documents->all()[0]->getMetadata('date')->shouldEqual($metadata2['date']);
        $documents->all()[0]->getContent()->shouldEqual('# Second post');
        $documents->all()[0]->getSlug()->shouldEqual('second-post');
    }

    function it_finds_post_from_slug()
    {
        $metadata = array('title' => 'Second post', 'date' => '2014-03-10');

        $this->config(array(
            'document_path' => 'spec/fixtures',
            'document_ext' => '.md'
        ));

        $post = $this->find('second-post');

        $post->shouldHaveType('Thin\Post');
        $post->getMetadata('title')->shouldEqual($metadata['title']);
        $post->getMetadata('date')->shouldEqual($metadata['date']);
        $post->getContent()->shouldEqual('# Second post');
        $post->getSlug()->shouldEqual('second-post');
    }
}