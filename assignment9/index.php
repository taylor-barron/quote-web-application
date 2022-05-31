<?php // Script 13.1 - index.php
/* This is the home page for the site
- The most recent quote (default)
- OR, a RANDOM quote
- OR, a random favorite quote */

// Include the header:
include("templates/header.php");

// Need the database connection
include('../mysqli_connect.php');
include('includes/functions.php');
$conn = OpenCon();

// Define the query...
// Change the particulars depending up values pass in the URL:
if (isset($_GET['random'])) {
    $query = "SELECT id, quotes, author, favorite FROM quotes ORDER BY RAND() DESC LIMIT 1";
} else if (isset($_GET['favorite'])) {
    $query = "SELECT id, quotes, author, favorite FROM quotes WHERE favorite=1 ORDER BY RAND() LIMIT 1";
} else {
    $query = "SELECT id, quotes, author, favorite FROM quotes ORDER BY id DESC LIMIT 1";
}

// Run the query:
if ($result = mysqli_query($conn, $query)) {

    // Retrieve the returned record:
    $row = mysqli_fetch_array($result);

    // Print the record.
    print "<div><blockquote>{$row['quotes']}</blockquote>- {$row['author']}";

    // Is this a favorite?
    if ($row['favorite'] == 1 ) {
        print ' <strong>Favorite!</strong>';
    }

    // Complete the div:
    print "</div>";

    // If the admin is logged in, display admin links for this record:
    if (is_administrator()) {
        print "<p><b>Quote Admin:</b> <a href=\"edit_quote.php?id={$row['id']}\">Edit</a> <->
        <a href\"delete_quote.php?id={$row['id']}\">Delete</a>
        </p>\n";
    }

} else { // Query didn't run
    print '<p class="error">Could not retrieve the data because:<br>' . mysqli_error($conn) . '</p><p>The query being run was: ' . $query . '</p>';
}

// Close the connection:
CloseCon($conn);

print '<p><a href="index.php">Latest</a> <-> <a href="index.php?random=true">Random</a> <-> <a href="index.php?favorite=true">Favorite</a></p>';

include('templates/footer.php');
?>