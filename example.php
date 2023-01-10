<html>

<body>

    <a href="example.php">REFRESH</a>

    <form action="example.php" method="post">
        title: <input type="text" name="title"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit" value="Generate">
    </form>
    <p>Route::get('/contract', 'ContractTypesController@index')->name('contract.index');</p>

</body>

</html>


<?php
if (isset($_POST["title"]) and $_POST["title"] != "") {
    $title = $_POST["title"];


    // include class
    require_once("Crudgen.php");

    // initialize class
    $instance = new Crudgen();

    // open file and process text
    $results = $instance->fileToString("stubs/view-main.blade.php");
    //->hasAnyRepeated(['b'], 2)
    //->hasConsecutive(3)
    //->hasAny(['i', 'b', 'b', 'e'])
    // ->hasAll(['i', 'b', 'e', 'r'])
    //->toArray();

    $replaced = str_replace("{{ title }}", $title, $results->result);

    // print results
    echo "<pre>";
    print_r($replaced);
    echo "</pre>";
} //end if
?>