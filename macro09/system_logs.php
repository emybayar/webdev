<?php
    //Open database connection
    include('config.php');
    $db = new SQLite3($path . '/chatroom.db');

    //Fetch system usage logs from chat_history table
    $sql = "SELECT name, timestamp, ip_address FROM chat_history";
    $result = $db->query($sql);

    //Store logs in an array
    $logs = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $logs[] = $row;
    }

    //Close database connection
    $db->close();

    //Convert logs to JSON and output
    echo json_encode($logs);
?>
