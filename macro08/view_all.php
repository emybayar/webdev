<?php
    // Step 1: Import the file path variable ($path)
    include('config.php');

    // Step 2: Connect to the database
    $db = new SQLite3($path.'/movies.db');

    // Step 3: Check if the delete action is requested
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        // Step 4: Construct the DELETE query
        $sql = "DELETE FROM items WHERE id = $id";
        // Step 5: Execute the DELETE query
        $db->exec($sql);
        // Redirect back to index.php after deletion
        header("Location: index.php");
        exit();
    }

    // Step 6: Construct a SELECT query to retrieve all data from the items table
    $sql = "SELECT * FROM items";

    // Step 7: Execute the SELECT query
    $result = $db->query($sql);

    // Step 8: Display the data in an HTML table
    echo '<style>';
    echo 'table { width: 50%; border-collapse: collapse; }';
    echo 'th, td { padding: 10px; border: 1px solid #ddd; }';
    echo 'th { background-color: #f0f0f0; }';
    echo '</style>';

    echo '<table>';
    echo '<tr><th>Title</th><th>Year</th><th>Options</th></tr>';

    while ($row = $result->fetchArray()) {
        echo '<tr>';
        echo '<td>'. $row['title']. '</td>';
        echo '<td>'. $row['year']. '</td>'; 
        // Step 9: Add a delete link with the movie ID as a parameter and a confirmation message
        echo '<td><a href="' . $_SERVER['PHP_SELF'] . '?action=delete&id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this movie?\')">Delete</a></td>';
        echo '</tr>';
    }

    echo '</table>';

    // Step 10: Close the database connection
    $db->close();
?>
