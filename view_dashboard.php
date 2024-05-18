<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['user']['role'] !== 'View') {
    header("Location: index.php");
    exit();
}

include ("connection.php");

$title = "View";
if (isset($_GET['title'])) {
    $title = htmlspecialchars($_GET['title']);
}

$dashboard = "View";
if (isset($_GET['h1'])) {
    $dashboard = htmlspecialchars($_GET['h1']);
}


$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>



<body>
    <h1>Hello View User</h1>
</body>

</html>