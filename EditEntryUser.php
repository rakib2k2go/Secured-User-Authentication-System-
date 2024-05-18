<?php
session_start(); // Start the session
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
if ($_SESSION['user']['role'] !== 'Entry') {
    header("Location: index.php");
    exit();
}

include ("connection.php");

$title = "Edit Entry User";
if (isset($_GET['title'])) {
    $title = htmlspecialchars($_GET['title']);
}

$dashboard = "Entry";
if (isset($_GET['h1'])) {
    $dashboard = htmlspecialchars($_GET['h1']);
}

if (!isset($_GET['id'])) {
    header("Location: Entry_dashboard.php");
    exit();
}

$id = $_GET['id'];

$query = "SELECT * FROM products WHERE id='$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) !== 1) {
    header("Location: Entry_dashboard.php");
    exit();
}

$product = mysqli_fetch_assoc($result);

$name = $product['name'];
$description = $product['description'];
$price = $product['price'];
$errors = array();

if (isset($_POST['update'])) {
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
        $query = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id='$id'";
        mysqli_query($conn, $query);

        header("Location: Entry_dashboard.php");
        exit();
    }
}
?>

<?php include 'includes/sidebar.php'; ?>

<div class="content">
    <h1>Edit Product</h1>
    <form action="EditEntryUser.php?id=<?php echo $id; ?>" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name"
                value="<?php echo htmlspecialchars($name); ?>">
            <span><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description"
                name="description"><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price"
                value="<?php echo htmlspecialchars($price); ?>">
            <span><?php echo isset($errors['price']) ? $errors['price'] : ''; ?></span>
        </div>
        <div>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
        </div>
    </form>
</div>
</body>

</html>