<?php namespace Thin;

class Post extends Document {

    public $slug;

    public function getSlug()
    {
        return $this->slug;
    }
}