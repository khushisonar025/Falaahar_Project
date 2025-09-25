<?php
// $db_name = 'mysql:host=localhost;dbname=grocery;port=3307'; // Correct DSN string
// $user_name = 'root';
// $user_password = '';

// try {
//     $conn = new PDO($db_name, $user_name, $user_password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $connectionStatus = "success";
// } catch (PDOException $e) {
//     $connectionStatus = "failure: " . $e->getMessage(); // Include error message for debugging
// }

$db_name = 'mysql:host=localhost;dbname=grocery;port=3307';
$user_name = 'root';
$user_password = '';

try {
    $conn = new PDO($db_name, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Ensure the path is correct -->
<!-- </head>
<body> --> 
<!-- 
<script>
    const connectionStatus = "<?php echo addslashes($connectionStatus); ?>"; // Safeguard quotes
    if (connectionStatus.includes("success")) {
        console.log('Connected successfully');
    } else {
        console.error('Connection failed:', connectionStatus);
    }
</script> -->

<!-- </body>
</html> -->
