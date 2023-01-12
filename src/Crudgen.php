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

    // read folder and get the file names as an array without "." and "..". Method chainable.
    public function getFilesInFolder($folder)
    {
        $this->result = array_diff(scandir($folder), array('.', '..'));
        return $this;
    }

    //get directory name from path. Method chainable.
    public function getDirName($path)
    {
        $this->result = dirname($path);
        return $this;
    }

    //create directory. Method chainable.
    public function createDir($path)
    {
        //create directory if it does not exist
        if (!file_exists($path)) {
            $this->result = mkdir($path, 0777, true);
        }
        return $path;
    }

    //create directory, create file, write content. Method chainable.
    public function createFile($path, $content)
    {
        //create directory
        $this->getDirName($path)->createDir($this->result);

        //create file
        $this->result = file_put_contents($path, $content);
        return $this;
    }

    //convert object to array and return
    public function toArray()
    {
        return (array) $this->result;
    }

    //return result as string
    public function toString()
    {
        return (string) $this->result;
    }
}
