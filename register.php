<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
?>

<style>
    .custom-card {

        max-width: 400px;
        margin: 0 auto;
        background: none;
    }

    label {
        color: white;
    }

    .card-title {
        color: white;
    }

    main {
        margin-bottom: 0px;
    }

    .full {
        background-image: url('https://static.vecteezy.com/system/resources/previews/022/478/385/non_2x/abstract-light-blue-watercolor-for-background-vector-soft-watercolor-splash-smudge-background-background-blob-free-png.png');
        /* Replace 'image.jpg' with the path to your image */
        background-size: cover;
        width: 100%;
        /* Cover the entire background */
        background-position: center;
    }
</style>
<section class="full">
    <main role="main">
        <div class="container mt-4">
            <div class="alert">
                <?php
                if (isset($_SESSION['status'])) {
                    echo "<h4>" . $_SESSION['status'] . "<h4>";
                    unset($_SESSION["status"]);
                }
                ?>
            </div>
            <div class="card custom-card">
                <div class="card-body">
                    <h1 class="card-title">Registration</h1>
                    <form action="registercode.php" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="Admin">Admin</option>
                                <option value="Entry">Entry</option>
                                <option value="View">View</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirm">Confirm Password</label>
                            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm"
                                placeholder="Confirm password">
                        </div>
                        <button type="submit" name="register_btn" class="btn btn-warning">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

</section>

<?php include 'includes/footer.php'; ?>
<script>
    function validateForm() {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var passwordConfirm = document.getElementById('passwordConfirm').value;

        if (name == "" || email == "" || password == "" || passwordConfirm == "") {
            alert("All fields are required");
            return false;
        }

        if (password != passwordConfirm) {
            alert("Passwords do not match");
            return false;
        }

        return true;
    }
</script>