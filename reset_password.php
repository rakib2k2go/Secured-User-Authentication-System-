<?php 
session_start(); 
include 'includes/header.php'; 
include 'includes/navbar.php';

if(isset($_GET['token'])) {
    $token = $_GET['token']; 
} else {
    header("Location: forgot_password.php");
    exit();
}

?>

<style>
    .custom-card {
        background-color: #02474d; 
        max-width: 400px;
        margin: 0 auto;
    }

    main {
        margin-bottom: 13rem;
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
                <h1 class="card-title">Reset Password</h1>
                <?php 
                if(isset($_SESSION['reset_password_error'])) {
                    echo '<div class="alert alert-danger">'.$_SESSION['reset_password_error'].'</div>';
                    unset($_SESSION['reset_password_error']);
                }
                ?>
                <?php 
                if(isset($_SESSION['reset_password_success'])) {
                    echo '<div class="alert alert-success">'.$_SESSION['reset_password_success'].'</div>';
                    unset($_SESSION['reset_password_success']);
                }
                ?>
                <form id="resetPasswordForm" action="process_reset_password.php?token=<?php echo $token; ?>" method="post">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" name="reset_password_btn" class="btn btn-warning">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php';?>


