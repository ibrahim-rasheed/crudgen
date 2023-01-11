<?php

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

//function to convert phrase to sentence case [Sentence case]
function toSentenceCase($phrase)
{
    $result = ucfirst(strtolower($phrase));
    return $result;
}

//function to replace all slashed with a dot
function replaceSlashesWithDot($phrase)
{
    $result = str_replace('/', '.', $phrase);
    return $result;
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
