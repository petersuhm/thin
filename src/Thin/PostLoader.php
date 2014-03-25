<?php namespace Thin;

use Thin\Interfaces\DocumentLoaderInterface;
use Thin\DocumentCollection;
use Thin\Post;
use Petersuhm\Configure\ConfigurationRepository;

class PostLoader implements DocumentLoaderInterface {

    protected $settings;

    public function __construct($settings = null)
    {
        if ($settings == null)
            $this->settings = new ConfigurationRepository();
        else
            $this->settings = $settings;
    }

    public function config($settings)
    {
        $this->settings->set($settings);
    }

    public function all()
    {
        $documentCollection = new DocumentCollection;

        $files = glob($this->settings->get('document_path') . '/*' . $this->settings->get('document_ext'));

        foreach ($files as $file)
        {
            $source = file_get_contents($file);
            $content = explode("\n\n", $source, 2);

            $post = new Post;
            $post->setMetadata(json_decode($content[0], true));
            $post->setContent($content[1]);
            $post->setSlug(basename($file, $this->settings->get('document_ext')));

            $documentCollection->add($post);
        }

        return $documentCollection;
    }

    public function find($slug)
    {
        $file = $this->settings->get('document_path') . '/' . $slug . $this->settings->get('document_ext');
        $source = file_get_contents($file);
        $content = explode("\n\n", $source, 2);

        $post = new Post;
        $post->setMetadata(json_decode($content[0], true));
        $post->setContent($content[1]);
        $post->setSlug(basename($file, $this->settings->get('document_ext')));

        return $post;
    }

    public function setting($key)
    {
        return $this->settings[$key];
    }
}
