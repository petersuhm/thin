<?php namespace Thin;

class DocumentCollection
{
    public $documents = array();

    public function add($var)
    {
        if (is_array($var))
            return array_map([$this, 'add'], $var);

        array_push($this->documents, $var);
    }
}
