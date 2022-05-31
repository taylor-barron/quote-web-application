<?php
/* This script edits a quote */

// Include the header:
define('TITLE', 'Edit a Quote');
include('templates/header.php');

print '<h2>Edit a Quotation</h2>';

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

if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0) ) { // Display the entry in form:

    // Define the query:
    $query = "SELECT quotes, author, favorite FROM quotes WHERE id={$_GET['id']}";
    if ($result = mysqli_query($conn, $query)) {

        $row = mysqli_fetch_array($result);

        // Make the Form:
        print '<form action="edit_quote.php" method="post">
            <p><label>Quote <textarea name="quote" rows="5" cols="30">' .
            htmlentities($row['quotes']) . '</textarea></label></p>
            <p><label>Source <textarea name="source" rows="5" cols="30">' .
            htmlentities($row['author']) . '</textarea></label></p>
            <p><label>Is this a favorite? <input type="checkbox" name="favorite" value="yes"
        ';

        // Check the box if it is a favorite:
        if ($row['favorite'] == 1 ) {
            print ' checked="checked"';
        }

        // Complete the form:
        print'></label></p>
            <input type="hidden" name="id" value=" '. $_GET['id'] . ' ">
            <p><input type="submit" name="submit" value="Update This Quote!"></p>
        </form>';

    } else { // Couldn't get the information
        print '<p class="error">Could not retrieve this quotation because:<br>' . mysqli_error($conn) . '</p><p>The query being run was: ' . $query . '</p>';
    }

} else if (isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id']) > 0 ) { // Handle the form.

    // Validate and secure the form data:
    $problem = FALSE;
    if ( !empty($_POST['quotes']) && !empty($_POST['author']) ) {

        // Prepare the values for storing:
        $quote = mysqli_real_escape_string($conn, trim(strip_tags($_POST['quotes'])));
        $source = mysqli_real_escape_string($conn, trim(strip_tags($_POST['author'])));

        // Create the favorite value:
        if (isset($_POST['favorite'])) {
            $favorite = 1;
        } else {
            $favorite = 0;
        }

    } else {
        print'<p class="error">Please submit both a quotation and a source.</p>';
        $problem = TRUE;
    }

    if (!$problem) {

        // Define the query.
        $query = "UPDATE quotes SET quotes='$quote', author='$source', favorite=$favorite WHERE id={$_POST['id']}";
        if ($result = mysqli_query($conn, $query)) {
            print'<p>The quotation has been updated.</p>';
        } else {
            print '<p class="error">Could not update this quotation because:<br>' . mysqli_error($conn) . '</p><p>The query being run was: ' . $query . '</p>';            
        }

    } // No problem!

} else { // No ID set.
    print '<p class="error">This page has been accessed in error.</p>';
} // End of main if.

CloseCon($conn);

include('templates/footer.php');
?>