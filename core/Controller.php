<?php
class Controller
{
    public function view($name, $data)
    {
        require "../app/Views/{$name}.php";
    }
}
