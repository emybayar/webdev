<?php

    include('config.php');
    $db = new SQLite3($path . '/chatroom.db');

    //grab the incoming data
    $text = $_POST['message'];
    $username = $_POST['name'];
    $room_id = $_POST['room_id'];
    $timestamp = $_POST['timestamp'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    //make sure we have both valeus
    if ($text && $username && room_id) {

        //construct SQL to store this message
        $sql = "INSERT INTO chat_history (name, message, room_id, timestamp, ip_address) VALUES (:username, :text, :room_id, :timestamp, :ip_address)";
        $statement = $db->prepare($sql);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':text', $text);
        $statement->bindParam(':room_id', $room_id);
        $statement->bindValue(':timestamp', time());
        $statement->bindValue(':ip_address', $ip_address);

        //store the msg
        $statement->execute();

        //get the 'id' value that was just inserted
        $id = $db->lastInsertRowID();

        $db->close();
        unset($db);

        print($id);
        exit();
    }

    print ("Error Encountered.");
    exit();
?>
