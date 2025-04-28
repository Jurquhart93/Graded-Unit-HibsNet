<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<!-- PHP Registration Code Start -->
<?php
// If the Register Form Has Been Submitted Start
if (isset($_POST['register'])) {
    // Get and Sanatize Form Data Start
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $repeatPassword = trim($_POST['repeat-password']);
    $tac = isset($_POST['tac']) ? 1 : 0;
    $admin = 0;
    $moderator = 0;
    $privateMember = 0;
    // Get and Sanatize Form Data End

    // Sanatize and Validate Email Start
    ValidateEmail('email', $email, $formErrors, 'Invalid Email Format');
    // Sanatize and Validate Email End

    // Validating Password Start
    ComparePasswords('repeat-password', $password, $repeatPassword, $formErrors, 'Passwords Do Not Match');
    // Validating Password End

    // Checking If TaC Have Been Accepted Start
    TermsAndConditions('tac', $tac, $formErrors, 'You need to accept our Terms and Conditions.');
    // Checking If TaC Have Been Accepted End

    // Checking If Fields Are Empty Start
    RequiredField('username', $username, $formErrors);
    RequiredField('email', $email, $formErrors);
    RequiredField('password', $password, $formErrors);
    RequiredField('repeat-password', $repeatPassword, $formErrors);
    // Checking If Fields Are Empty End

    // Hashing Password Start
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Hashing Password End

    // If Form Erros Array Is Empty Start
    if (empty($formErrors)) {
        // Escaping Special Characters For SQL Start
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $tac = mysqli_real_escape_string($conn, $tac);
        // Escaping Special Characters For SQL Ends

        // Preparing SQL Statement Start
        $stmt = $conn->prepare("INSERT INTO gu_members (username, email, password, tac, admin, moderator, private_member) VALUES (?, ?, ?, ?, ?, ?, ?)");
        // Preparing SQL Statement End

        // Binding Parameters Start
        $stmt->bind_param("sssiiii", $username, $email, $hashed_password, $tac, $admin, $moderator, $privateMember);
        // Binding Parameters End

        // Executing Statement Start
        $stmt->execute();
        // Executing Statement End

        $_SESSION['username'] = $username;

        // Closing Statement and Connection Start
        $stmt->close();
        $conn->close();
        // Closing Statement and Connection End

        // Creating a Status Session Start
        setStatus("Successfully Registered!");
        // Creating a Status Session End

        // Redirecting Start
        header("Location: " . $baseUrl . "/login.php");
        // Redirecting End
    }
    // If Form Erros Array Is Empty End
}
// If the Register Form Has Been Submitted End
?>
<!-- PHP Registration Code End -->

<!-- Setting Page Title Start -->
<?php $pageTitle = "Register"; ?>
<!-- Setting Page Title Start -->

<!-- Including Header Start -->
<?php include_once(__DIR__ . "/partials/header.php"); ?>
<!-- Including Header End -->

<!-- Main Content Start -->
<main class="main">
    <!-- Register Section Start -->
    <section class="register container">
        <!-- Logo Start -->
        <?php include(__DIR__ . "/components/logo.php"); ?>
        <!-- Logo End -->

        <!-- Form Start -->
        <form method="POST" class="form">
            <!-- Form Field Start -->
            <div class="form__field">
                <!-- Form Labels & Inputs Start -->
                <label class="form__label" for="username">Username:</label>
                <input class="form__input" type="text" name="username" id="username" value="<?php echo e(OldFormData('username', $oldFormData)); ?>">
                <!-- Form Labels & Inputs End -->

                <p class="error"><?php echo FormErrors('username', $formErrors); ?></p>
            </div>
            <!-- Form Field End -->

            <!-- Form Field Start -->
            <div class="form__field">
                <!-- Form Labels & Inputs Start -->
                <label class="form__label" for="email">Email:</label>
                <input class="form__input" type="email" name="email" id="email" value="<?php echo e(OldFormData('email', $oldFormData)); ?>">
                <!-- Form Labels & Inputs End -->

                <p class="error"><?php echo FormErrors('email', $formErrors); ?></p>
            </div>
            <!-- Form Field End -->

            <!-- Form Field Start -->
            <div class="form__field">
                <!-- Form Labels & Inputs Start -->
                <label class="form__label" for="password">Password:</label>
                <input class="form__input" type="password" name="password" id="password">
                <!-- Form Labels & Inputs End -->

                <p class="error"><?php echo FormErrors('password', $formErrors); ?></p>
            </div>
            <!-- Form Field End -->

            <!-- Form Field Start -->
            <div class="form__field">
                <!-- Form Labels & Inputs Start -->
                <label class="form__label" for="repeat-password">Repeat Password:</label>
                <input class="form__input" type="password" name="repeat-password" id="repeat-password">
                <!-- Form Labels & Inputs End -->

                <p class="error"><?php echo FormErrors('repeat-password', $formErrors); ?></p>
            </div>
            <!-- Form Field End -->

            <!-- Form Checkbox Start -->
            <div class="form__field">
                <!-- Form Labels & Inputs Start -->
                <div class="form__checkbox">
                    <input class="form__input" type="checkbox" name="tac" id="tac">
                    <label class="form__label" for="tac">Agree to <a href="#">Terms & Conditions</a></label>
                </div>
                <!-- Form Labels & Inputs End -->

                <p class="error"><?php echo FormErrors('tac', $formErrors); ?></p>
            </div>
            <!-- Form Checkbox End -->

            <!-- Form Button Start -->
            <div class="form__button">
                <button type="submit" name="register">Register Account</button>
            </div>
            <!-- Form Button End -->
        </form>
        <!-- Form End -->
    </section>
    <!-- Register Section End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->