
<?php
    include('config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $year = $_POST["year"];

        //see if both fields are not empty
        if (!empty($title) && !empty($year)) {
            //connect to db
            $db = new SQLite3($path.'/movies.db');

            //insert sql
            $sql = "INSERT INTO items (title, year) VALUES ('$title', $year)";
            $result = $db->query($sql);

            $db->close();
            exit();
        }
    }
?>