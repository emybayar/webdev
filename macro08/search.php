<?php
  // Step 1: Import the file path variable ($path)
  include('config.php');

  // Step 2: Connect to the database
  $db = new SQLite3($path.'/movies.db');

  // Step 3: Retrieve search parameters
  $title = $_POST['title'];
  $year = $_POST['year'];

  // Step 4: Construct the SQL query
  $query = "SELECT * FROM items WHERE 1=1";

  if (!empty($title)) {
      $query .= " AND title LIKE '%$title%'";
  }

  if (!empty($year)) {
      $query .= " AND year = '$year'";
  }

  // Step 5: Execute the query and fetch results
  $result = $db->query($query);

  // Step 6: Display search results
  echo "<h3>Search Results:</h3>";
  echo "<ul>";
  while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
      echo "<li>{$row['title']} ({$row['year']})</li>";
  }
  echo "</ul>";
?>
