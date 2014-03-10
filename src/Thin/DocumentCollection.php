<?php namespace Thin;

class DocumentCollection implements \Iterator, \Countable, \ArrayAccess
{
    protected $documents = array();
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

    public function limit($limit)
    {
        return array_slice($this->documents, 0, $limit);
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

    public function count()
    {
        return count($this->documents);
    }

    public function offsetExists($offset)
    {
        return isset($this->documents[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->documents[$offset]) ? $this->documents[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset))
            $this->documents = $value;
        else
            $this->documents[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->documents[$offset]);
    }
}