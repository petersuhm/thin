<?php namespace Thin;

class DocumentCollection implements \Iterator
{
    public $documents = array();
    protected $position = 0;

    public function add($var)
    {
        if (is_array($var))
            return array_map([$this, 'add'], $var);

        array_unshift($this->documents, $var);
    }

    public function all()
    {
        return $this->documents;
    }

    public function current()
    {
        return $this->documents[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position++;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return isset($this->documents[$this->position]);
    }
}