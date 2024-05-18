<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['user']['role'] !== 'Entry') {
    header("Location: index.php");
    exit();
}

include ("connection.php");

$title = "Entry";
if (isset($_GET['title'])) {
    $title = htmlspecialchars($_GET['title']);
}

$dashboard = "Entry";
if (isset($_GET['h1'])) {
    $dashboard = htmlspecialchars($_GET['h1']);
}

$name = $description = $price = "";
$errors = array();

if (isset($_POST['create'])) {
    if (empty($_POST['name'])) {
        $errors['name'] = "Name is required";
    } else {
        $name = $_POST['name'];
    }

    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (empty($_POST['price'])) {
        $errors['price'] = "Price is required";
    } else {
        $price = $_POST['price'];
        if (!is_numeric($price)) {
            $errors['price'] = "Price must be a numeric value";
        }
    }

    if (count($errors) === 0) {
        $query = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";
        mysqli_query($conn, $query);

        header("Location: entry_dashboard.php");
        exit();
    }
}

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

?>


<body>
    <H1>Hello Entry User</H1>
</body>

</html>