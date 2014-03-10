<?php namespace Thin\Interfaces;

interface DocumentLoaderInterface {

    public function config($settings);
    public function setting($key);
    public function all();
    public function find($key);
}