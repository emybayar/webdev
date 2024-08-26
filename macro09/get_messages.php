
<?php
    //open db
    include('config.php');
    $db = new SQLite3($path . '/chatroom.db');
    $room_id = $_GET['room_id'];
    
    // database contains a single table named 'chat_history' with the following properties:
    // id      INTEGER PRIMARY KEY AUTOINCREMENT
    // name  TEXT
    // message TEXT
    // room_id INTEGER

    //extract all messages from chatroom.db
    $sql = "SELECT * FROM chat_history WHERE room_id = :room_id";
    // $sql = "SELECT * FROM chat_history";
    $statement = $db->prepare($sql);
    $statement->bindParam(':room_id', $room_id);
    $result = $statement->execute();

    //store all results in an associative array that'll send back to html page
    $send_back = array();

    //visit all records
    while ($row = $result->fetchArray()) {
        //create a mini-array to hold each record
        $record = array();
        $record['id'] = $row['id'];
        $record['name'] = $row['name'];
        $record['message'] = $row['message'];
        $record['room_id'] = $row['room_id'];
        $record['timestamp'] = $row['timestamp'];
        $ip_address['ip_address'] = $row['ip_address'];

        //add record to the main array
        array_push($send_back, $record);
    }

    //close the db
    $db->close();
    unset($db);

    //turn the array into a JSON object and print it to the browser
    print json_encode($send_back);
    exit();
?>

