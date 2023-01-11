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
        'path' => 'hr/staff/contract', // eg: hr/contract
        'name' => 'working hours',
        'title' => 'contract',
    ];

    // path start string
    $path_start = date('Y-m-d-') . getRandomString(4);

    // array of named arrays for source stubs and destination files
    $stubs = [
        "view-main" => [
            'source' => 'stubs/view-main.blade.php',
            'destination' => 'resources/views/contract/index.blade.php',
        ],
        "view-table" => [
            'source' => 'stubs/view-table.blade.php',
            'destination' => 'resources/views/contract/table.blade.php',
        ],
        "view-modal" => [
            'source' => 'stubs/view-modal.blade.php',
            'destination' => 'resources/views/contract/modal.blade.php',
        ],
    ];

    // array of replaceable fields
    $replaceable = [
        'path' => replaceSlashesWithDot($crud['path']),
        'view_main' => toCamelCase($crud['name']),
        'title' => toSentenceCase($crud['name']),
    ];

    // add replaceable fields to search and replace array if they are not empty
    foreach ($replaceable as $field => $value) {
        if (isset($replaceable[$field]) and $replaceable[$field] != "") {
            $search_replace_arr[$field] = $value;
        }
    }

    // open file and process text
    $results = $instance->fileToString("stubs/view-main.blade.php")
        ->searchReplace($search_replace_arr);
    //->toArray();

    // print results
    echo "<pre>";
    print_r($results);
    echo "</pre>";
} //end if
?>