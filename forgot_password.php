<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';

?>

<style>
    .custom-card {
        background-color: #02474d; 
        max-width: 400px;
        margin: 0 auto;
    }

    main {
        margin-bottom: 18rem;
    }

    label {
        color: white;
    }

    .card-title {
        color: white;
    }
</style>
<main role="main">
    <div class="container mt-5">
        <div class="card custom-card">
            <div class="card-body">
                <h1 class="card-title">Forgot Password</h1>
                <?php 
                    if(isset($_SESSION['forgot_password_success'])) {
                        echo '<div class="alert alert-success">'.$_SESSION['forgot_password_success'].'</div>';
                        unset($_SESSION['forgot_password_success']);
                    }
                    if(isset($_SESSION['forgot_password_error'])) {
                        echo '<div class="alert alert-danger">'.$_SESSION['forgot_password_error'].'</div>';
                        unset($_SESSION['forgot_password_error']);
                    }
                ?>
                <form id="forgotPasswordForm" action="process_forgot_password.php" method="post">
                    <div class="form-group">
                        <label for="email">Enter your email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
