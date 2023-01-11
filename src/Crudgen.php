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
        //wrap curly braces around keys
        $find = array_map(function ($key) {
            return "{{ " . $key . " }}";
        }, array_flip($searchReplace));

        //replace
        $replace = array_values($searchReplace);

        //replace and return
        $this->result = str_replace($find, $replace, $this->result);
        return $this;
    }
}
