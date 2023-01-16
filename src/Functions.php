<?php

//dd function
function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

//function to convert phrase to camel case [camelCase]
function toCamelCase($phrase)
{
    $result = str_replace(' ', '', ucwords(str_replace('_', ' ', $phrase)));
    $result[0] = strtolower($result[0]);
    return $result;
}

//function to convert phrase to pascal case [PascalCase]
function toPascalCase($phrase)
{
    $result = str_replace(' ', '', ucwords(str_replace('_', ' ', $phrase)));
    return $result;
}

//function to convert phrase to snake case [snake_case]
function toSnakeCase($phrase)
{
    $result = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $phrase));
    return $result;
}

//function to convert phrase to kebab case [kebab-case]
function toKebabCase($phrase)
{
    return \implode('-', \array_map('\strtolower', words(\preg_replace("/['\x{2019}]/u", '', $phrase))));
}

//function to convert phrase to sentence case [Sentence case]
function toSentenceCase($phrase)
{
    $result = ucfirst(strtolower($phrase));
    return $result;
}

//Splits string into an array of its words.
function words($value, $pattern = null)
{
    $pattern = $pattern ?: '/[^\pL\pM\pN\pP\pS]+/u';
    return preg_split($pattern, $value, -1, PREG_SPLIT_NO_EMPTY);
}

//function to replace all dots with slashes
function pathWithSlashes($string)
{
    $slashed = str_replace('.', '/', $string);
    return toKebabCase($slashed);
}

//function to replace all dots with back slashes
function pathWithBackSlashes($string)
{
    $slashed = str_replace('.', '\\', $string);
    return toKebabCase($slashed);
}

//function to get a random string of a given length
function getRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


//read file and get the content as a string.
function fileToString($file)
{
    return file_get_contents($file);
}

//HTML encode a string.
function htmlEncode($string)
{
    return htmlspecialchars($string);
}

//search and replace. Method chainable.
function searchReplace($searchReplace, $content)
{
    //wrap curly braces around keys
    $find = array_map(function ($key) {
        return "{{ " . $key . " }}";
    }, array_flip($searchReplace));

    //replace
    $replace = array_values($searchReplace);

    //replace and return
    return str_replace($find, $replace, $content);
}
