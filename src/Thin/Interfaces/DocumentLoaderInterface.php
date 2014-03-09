<?php namespace Thin\Interfaces;

interface DocumentLoaderInterface {

    public function config($settings);
    public function all();
    public function find($key);
}