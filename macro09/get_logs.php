<?php
    include('config.php');
    $db = new SQLite3($path . '/chatroom.db');
    $stmt =$db->prepare('SELECT * FROM chat_history ORDER BY timestamp');
    $stmt->bindParam(':timestamp', $timestamp, SQLITE3_TEXT);
    $stmt->execute();
    $logs = [];
    while ($row = $stmt->fetchArray()) {
        $logs[] = [
            'timestamp' => date('Y-m-d H:i:s', $row['timestamp']),
            'name' => $row['name'],
            'ip_address' => $row['ip_address'],
        ];
    }
    $db->close();
    unset($db);
    print json_encode($logs);
    exit();
?>