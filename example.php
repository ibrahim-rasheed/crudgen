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

    // object of crud information
    $crud = (object) [
        'path' => 'duty.working-hours', // words separated by a hyphen (-) and folder names separated by a dot (.) eg: working-hour.another-hour
        'name' => 'working hours', // Preferably singular tense, one word. If more than one word, use space to separate. eg: working hour
    ];


    // prepared variables
    $random_string = date('Y-m-d-') . getRandomString(4);

    echo toKebabCase($crud->name);

    $path_with_backslashes = pathWithBackSlashes($crud->path);
    $path_with_dots = toPascalCase($crud->path);
    $path_with_dots_in_camel = toCamelCase($path_with_dots);

    $name_in_pascal_case = toPascalCase($crud->name);
    $name_in_sentence_case = toSentenceCase($crud->name);
    $name_in_kebab_case = toKebabCase($crud->name);
    $name_in_snake_case = toSnakeCase($crud->name);

    // array of named arrays for source stubs and destination files
    $stubs = [
        "route-line" => [
            'source' => 'stubs/route.php',
            'destination' => 'route.php',
        ],
        "controller" => [
            'source' => 'stubs/controller.php',
            'destination' => 'app/Http/Controllers/' . toPascalCase($crud->name) . 'Controller.php',
        ],
        "view-main" => [
            'source' => 'stubs/view-main.blade.php',
            'destination' => 'resources/views/' . pathProcessor($crud->path, 'toSnakeCase', '/') . '/' . toSnakeCase($crud->name) . '.blade.php',
        ],
        "view-table" => [
            'source' => 'stubs/view-table.blade.php',
            'destination' => 'resources/views/livewire/' . pathProcessor($crud->path, 'toSnakeCase', '/') . '/table.blade.php',
        ],
        "view-modal" => [
            'source' => 'stubs/view-modal.blade.php',
            'destination' => 'resources/views/livewire/' . pathProcessor($crud->path, 'toSnakeCase', '/') . '/modal.blade.php',
        ],
        "class-table" => [
            'source' => 'stubs/class-table.php',
            'destination' => 'app/Http/Livewire/' . pathProcessor($crud->path, 'toPascalCase', '/') . '/Table.php',
        ],
        "class-modal" => [
            'source' => 'stubs/class-modal.php',
            'destination' => 'app/Http/Livewire/' . pathProcessor($crud->path, 'toPascalCase', '/') . '/Modal.php',
        ],
    ];

    // array of replaceable fields
    $replaceable = [
        // route
        'url' => toKebabCase($crud->name),
        'controller' => toPascalCase($crud->name) . 'Controller',
        'route_name' => toCamelCase($crud->name) . '.index',
        // controller
        'view_main' => pathProcessor($crud->path, 'toSnakeCase', '.') . '.' . toSnakeCase($crud->name),
        // view-main
        'title' => toSentenceCase($crud->name),
        'view_table_path' => pathProcessor($crud->path, 'toSnakeCase', '.') . '.table',
        'view_modal_path' => pathProcessor($crud->path, 'toSnakeCase', '.') . '.modal',
        // table class
        'path_with_backslashes' => pathProcessor($crud->path, 'toPascalCase', '\\'),
        'model' => toPascalCase($crud->name),
        'name_in_snake_case' => toSnakeCase($crud->name),
    ];

    // add replaceable fields to search and replace array if they are not empty
    foreach ($replaceable as $field => $value) {
        if (isset($replaceable[$field]) and $replaceable[$field] != "") {
            $search_replace_arr[$field] = $value;
        }
    }


    foreach ($stubs as $stub) {

        //get dir name
        $dir = dirname($stub['destination']);
        //get file content
        $content = fileToString($stub['source']);
        //replace fields
        $replaced = searchReplace($search_replace_arr, $content);
        //encode html
        $encoded = htmlEncode($replaced);
        //file path
        $file = '_cruds' . '/' . $stub['destination'];
        //create file
        $instance->createFile($file, $replaced);

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