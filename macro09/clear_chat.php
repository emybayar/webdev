
<?php
    include('config.php');
    $db = new SQLite3($path . '/chatroom.db');
    $db->exec('DELETE FROM chat_history');
    $db->close();
    echo 'Chat rooms cleared successfully!';
?>