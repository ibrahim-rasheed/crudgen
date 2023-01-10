<?php

/**
 * @author Ibrahim Rasheed <ibrahim@kangathi.com>
 * version 0.0.1 - 2022-12-19
 *
 * 
 * 
 */
class Crudgen
{
    //properties
    public $result;

    //read file and get the content as a string. Method chainable.
    public function fileToString($file)
    {
        $this->result = file_get_contents($file);
        return $this;
    }

    //convert object to array and return
    public function toArray()
    {
        return (array) $this->result;
    }

    //search and replace. Method chainable.
    public function searchReplace($searchReplace)
    {
        $this->result = str_replace(array_keys($searchReplace), array_values($searchReplace), $this->result);
        return $this;
    }
}
