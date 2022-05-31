<?php // Script 13.10 - delete_quote.php
/* This script deletes a quote. */

// Include the header:
define('TITLE', 'Delete a Quote');
include('templates/header.php');

print '<h2>Delete a Quotation</h2>';

// Restrict access to administrators only:
include('includes/functions.php');
if(!is_administrator()) {
    print '<h2>Access Denied!</h2><p class="error">You do not have permission to access this page.</p>';
    include('templates/footer.php');
    exit();
}

// Need the database connection:
include('../mysqli_connect.php');
$conn = OpenCon();

if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0) ) { // Display the quote in form:

    // Define the query:
    $query = "SELECT quotes, author, favorite FROM quotes WHERE id={$_GET['id']}";
    if ($result = mysqli_query($conn, $query)) { // Run the query:

        $row = mysqli_fetch_array($result);

        // Make the form
        print '<form action="delete_quote.php" method="post">
        <p>Are you sure you want to delete this quote?</p>
        <div><blockquote>' . $row['quotes'] . '</blockquote>- ' . $row['author'];

        // Is this a favorite?
        if($row['favorite'] == 1) {
            print ' <strong>Favorite!</strong>';
        }

        print '</div><br><input type="hidden" name="id" value="' . $_GET['id'] . '">
        <p><input type="submit" name="submit" value="Delete this quote!"></p>
        </form>';

    } else { // Couldn't get the information.
        print '<p class="error">Could not retrieve the quote because:<br>' . mysqli_error($conn) . '</p><p>The query being run was: ' . $query . '</p>';
    }

} else if (isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id']) > 0 ) { // Handle the form.

    // Define the query:
    $query = "DELETE FROM quotes WHERE id={$_POST['id']} LIMIT 1";
    $result = mysqli_query($conn, $query); // Execute the query.
    
    // Report on the result:
    if (mysqli_affected_rows($conn) == 1) {
        print '<p>The quote entry has been deleted</p>';
    } else {
        print '<p class="error">Could not delete this quotation because:<br>' . mysqli_error($conn) . '</p><p>The query being run was: ' . $query . '</p>';          
    }

} else {  // No ID received
    print '<p class="error">This page has been accessed in error.</p>';
} // End of main if.

CloseCon($conn);

include('templates/footer.php');

?>