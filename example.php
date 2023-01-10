<html>

<body>

    <a href="example.php">REFRESH</a>

    <form action="example.php" method="post">
        path: <input type="text" name="path" value="<?php $_POST[" path"] ??= 'emp'; ?>"><br>
        name: <input type="text" name="name"><br>
        title: <input type="text" name="title"><br>

        <input type="submit" value="Generate">
    </form>
    <p>Route::get('/contract', 'ContractTypesController@index')->name('contract.index');</p>

</body>

</html>


<?php
if (isset($_POST["title"]) and $_POST["title"] != "") {

    // include class
    require_once("Crudgen.php");

    // initialize class
    $instance = new Crudgen();

    // aray of strings to search and replace
    $search_replace_arr = [
        "path" => $_POST["path"],
        "name" => $_POST["name"],
        "title" => $_POST["title"],
    ];

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