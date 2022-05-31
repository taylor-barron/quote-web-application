<!-- END CHANGEABLE CONTENT -->
<?php // Script 13.4 - footer.html

// Display general admin links...
// - if the user is an administrator and it's not the logout.php page
// - or if the $loggedin variable is true (i.e., the user jsut logged in)

if ( (is_administrator() && (basename($_SERVER['PHP_SELF']) != 'logout.php')) OR (isset($loggedin) && $loggedin) ) {

    // Create the links:
    print '<hr><h3>Site Admin</h3><p><a href = "add_quote.php">Add Quotes</a> <->
    <a href="view_quotes.php">View All Quotes</a> <->
    <a href="logout.php">Logout</a></p>';

} else {

    // Create the links:
    print '<hr><h3>Site Admin</h3><p><a href = "add_quote.php">Add Quotes</a> <->
    <a href="view_quotes.php">View All Quotes</a> <->
    <a href="login.php">Login</a></p>';
}

?>

</div> <!-- Container -->
<div id="footer">Content &copy; 2016</div>
</body>
</html>