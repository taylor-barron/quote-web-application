<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        function OpenCon() {

            $dbhost = "localhost";
            $dbuser = "taylor";
            $dbpass = "pass";
            $db = "quotes";

            $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connection failed: %s\n" . $conn -> error);

            return $conn;
        }

        function CloseCon($conn) {
            $conn -> close();
        }
    ?>
</body>
</html>