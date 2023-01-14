<html>

<head>
    <style>
        pre code {
            background-color: #eee;
            border: 1px solid #999;
            display: block;
            padding: 20px;
        }
    </style>
</head>

<body>

    <a href="example.php">REFRESH</a>
    <form action="example.php" method="get">
        <input type="hidden" name="action" value="generate">
        <input type="submit" value="generate">
    </form>


</body>

</html>


<?php
if (isset($_GET["action"]) and $_GET["action"] != "") {

    // include class
    require_once("src/Crudgen.php");
    require_once("src/Functions.php");

    // initialize class
    $instance = new Crudgen();

    // array of crud information
    $crud = [
        'path' => 'duty.working-hour', // words separated by a hyphen (-) and folder names separated by a dot (.) eg: working-hour.another-hour
        'name' => 'working hour', // Preferably singular tense, one word. If more than one word, use space to separate. eg: working hour
    ];


    // prepared variables
    $random_string = date('Y-m-d-') . getRandomString(4);
    $path_with_slashes = pathWithSlashes($crud['path']);
    $path_with_dots = $crud['path'];
    $name_in_camel_case = toCamelCase($crud['name']);
    $name_in_pascal_case = toPascalCase($crud['name']);
    $name_in_sentence_case = toSentenceCase($crud['name']);

    // array of named arrays for source stubs and destination files
    $stubs = [
        "route-line" => [
            'source' => 'stubs/route.php',
            'destination' => 'route.php',
        ],
        "controller" => [
            'source' => 'stubs/controller.php',
            'destination' => 'app/Http/Controllers/' . $name_in_pascal_case . 'Controller.php',
        ],
        "view-main" => [
            'source' => 'stubs/view-main.blade.php',
            'destination' => 'resources/views/' . $path_with_slashes . '/' . $name_in_camel_case . '.blade.php',
        ],
        "view-table" => [
            'source' => 'stubs/view-table.blade.php',
            'destination' => 'resources/views/livewire/' . $path_with_slashes . '/table.blade.php',
        ],
        "view-modal" => [
            'source' => 'stubs/view-modal.blade.php',
            'destination' => 'resources/views/livewire/' . $path_with_slashes . '/modal.blade.php',
        ],
    ];

    // array of replaceable fields
    $replaceable = [
        //route
        'url' => toKebabCase($crud['name']),
        'controller' => $name_in_pascal_case . 'Controller',
        'route_name' => $name_in_camel_case . '.index',
        //controller
        'view_main' => $path_with_dots . '.' . $name_in_camel_case,
        //view-main
        'view_path' => $path_with_dots . '.' . $name_in_camel_case,

        'view_table_path' => $path_with_dots . '.table',
        'title' => $name_in_sentence_case,
    ];

    // add replaceable fields to search and replace array if they are not empty
    foreach ($replaceable as $field => $value) {
        if (isset($replaceable[$field]) and $replaceable[$field] != "") {
            $search_replace_arr[$field] = $value;
        }
    }

    print_r($search_replace_arr);

    foreach ($stubs as $stub) {

        //get dir name
        $dir = dirname($stub['destination']);
        //get file content
        $content = fileToString($stub['source']);
        //replace fields
        $replaced = searchReplace($search_replace_arr, $content);
        //encode html
        $encoded = htmlEncode($replaced);
        //create file
        $file = '_cruds' . '/' . $stub['destination'];
        $instance->createFile($file, $content);

        echo "<div style='background-color:LightBlue;padding: 10px;'>";
        echo $stub['destination'] . "<br>";
        echo $dir . "<br>";
        echo "</div>";
        echo "<pre><code>";
        echo $encoded;
        echo "</code></pre>";
    }
} //end if
?>