<?php

namespace LittleNinja\Contracts;

interface Search
{
    public function index($index);

    public function get($query);
}
