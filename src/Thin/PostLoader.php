<?php namespace Thin;

use Thin\Interfaces\DocumentLoaderInterface;
use Thin\DocumentCollection;
use Thin\Post;

class PostLoader implements DocumentLoaderInterface {

    public $settings = array();

    public function config($settings)
    {
        $this->settings = array_merge($this->settings, $settings);
    }

    public function all()
    {
        $documentCollection = new DocumentCollection;

        $files = glob($this->settings['document_path'] . '/*' . $this->settings['document_ext']);

        foreach ($files as $file)
        {
            $source = file_get_contents($file);
            $content = explode("\n\n", $source, 2);

            $post = new Post;
            $post->metadata = json_decode($content[0], true);
            $post->content = $content[1];
            $post->slug = basename($file, '.md');

            $documentCollection->add($post);
        }

        return $documentCollection;
    }

    public function find($slug)
    {
        $file = $this->settings['document_path'] . '/' . $slug . $this->settings['document_ext'];
        $source = file_get_contents($file);
        $content = explode("\n\n", $source, 2);

        $post = new Post;
        $post->metadata = json_decode($content[0], true);
        $post->content = $content[1];
        $post->slug = basename($file, $this->settings['document_ext']);

        return $post;
    }
}