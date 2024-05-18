<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';

?>

<style>
    .custom-login {
        background: none;
        max-width: 400px;
        margin: 0 auto;
    }

    main {
        margin-bottom: 11rem;
    }

    label {
        color: white;
    }

    .card-title {
        color: white;
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
        <div class="container mt-5">
            <?php
            if (isset($_SESSION['status'])) {
                ?>
                <div class="alert alert-success">
                    <h5><?= $_SESSION['status']; ?></h5>
                </div>
                <?php
                unset($_SESSION['status']);
            }
            ?>
            <div class="card custom-login">
                <div class="card-body">
                    <h1 class="card-title">Login</h1>

                    <form id="loginForm" onsubmit="return validateForm()" action="process_login.php" method="post">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-warning">Login</button>
                    </form>
                    <div class="mt-3">
                        <a href="forgot_password.php" class="text-white">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

</section>
<script>
    function validateForm() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        if (email == "" || password == "") {
            alert("Email and password are required");
            return false;
        }
        return true;
    }
</script>

<?php include 'includes/footer.php'; ?>