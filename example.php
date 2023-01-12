<html>

<body>

    <a href="example.php">REFRESH</a>
    <form action="example.php" method="get">
        <input type="hidden" name="action" value="generate">
        <input type="submit" value="generate">
    </form>


    <p>Route::get('/contract', 'ContractTypesController@index')->name('contract.index');</p>

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

    // path start string
    $path_start = date('Y-m-d-') . getRandomString(4);

    // array of named arrays for source stubs and destination files
    $stubs = [
        "route-line" => [
            'source' => 'stubs/route.php',
            'destination' => 'route.php',
        ],
        "controller" => [
            'source' => 'stubs/controller.php',
            'destination' => 'app/Http/Controllers/' . toPascalCase($crud['name']) . 'Controller.php',
        ],
        "view-main" => [
            'source' => 'stubs/view-main.blade.php',
            'destination' => 'resources/views/' . toKebabCase($crud['path']) . '/index.blade.php',
        ],
        "view-table" => [
            'source' => 'stubs/view-table.blade.php',
            'destination' => 'resources/views/livewire/' . toKebabCase($crud['path']) . '/table.blade.php',
        ],
        "view-modal" => [
            'source' => 'stubs/view-modal.blade.php',
            'destination' => 'resources/views/livewire/' . toKebabCase($crud['path']) . '/modal.blade.php',
        ],
    ];

    // array of replaceable fields
    $replaceable = [
        'view_path' => $crud['path'],

        'url' => toKebabCase($crud['name']),
        'route_name' => toCamelCase($crud['name']) . '.index',

        'controller' => toPascalCase($crud['name']) . 'Controller',
        'view_table_path' => toKebabCase($crud['path']) . '.table',
        'view_main' => toCamelCase($crud['name']),
        'title' => toSentenceCase($crud['name']),
    ];

    // add replaceable fields to search and replace array if they are not empty
    foreach ($replaceable as $field => $value) {
        if (isset($replaceable[$field]) and $replaceable[$field] != "") {
            $search_replace_arr[$field] = $value;
        }
    }

    foreach ($stubs as $stub) {

        $dir = $instance->getDirName($stub['destination'])
            ->createDir($instance->result);
        $content = $instance->fileToString($stub['source'])
            ->searchReplace($search_replace_arr);
        $instance->createFile('_cruds' . '/' . $stub['destination'], $content->result);

        echo "<hr>";
        echo $stub['destination'] . "<br>";
        echo $dir . "<br>";
        echo "<hr>";
        echo "<pre>";
        echo $content->result;
        echo "</pre>";
    }

    // open file and process text
    // $results = $instance->fileToString("stubs/view-main.blade.php")
    //     ->searchReplace($search_replace_arr);
    //->toArray();


} //end if
?>