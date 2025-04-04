<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<!-- PHP Login Code Start -->
<?php
// Declaring Variables Start
$usernameSession = "";
// Declaring Variables End

// Checking if Username Session Is Set Start
if (isset($_SESSION['username'])) {
    $usernameSession = $_SESSION['username'];
}
// Checking if Username Session Is Set End

// If the Login Form Has Been Submitted Start
if (isset($_POST['login'])) {
    // Get and Sanatize Form Data Start
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // Get and Sanatize Form Data End

    // Checking If Fields Are Empty Start
    RequiredField('username', $username, $formErrors);
    RequiredField('password', $password, $formErrors);
    // Checking If Fields Are Empty End

    // If Form Erros Array Is Empty Start
    if (empty($formErrors)) {
        // Checking Username Exists Start
        $stmt = $conn->prepare("SELECT id, username, password FROM gu_members WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            // Checking Password Against Hashed Password Start
            if (password_verify($password, $stored_password)) {
                // Storing Users ID Into The Session
                $_SESSION['user'] = $row['id'];

                // Creating a Status Session
                setStatus("Successfully Logged In!");

                // Redirecting
                header("Location: " . $baseUrl);

                // Exit
                exit();
            } else {
                // Setting Form Errors To Invalid Start
                $formErrors['invalid_credentials'] = "Invalid Credentials";
                // Setting Form Errors To Invalid End
            }
            // Checking Password Against Hashed Password End
        } else {
            // Setting Form Errors To Invalid Start
            $formErrors['invalid_credentials'] = "Invalid Credentials";
            // Setting Form Errors To Invalid End
        }
        // Checking Username Exists End

        // Closing Statement and Connection Start
        $stmt->close();
        $conn->close();
        // Closing Statement and Connection End
    }
    // If Form Erros Array Is Empty End
}
// If the Login Form Has Been Submitted End
?>
<!-- PHP Login Code End -->

<!-- Setting Page Title Start -->
<?php $pageTitle = "Login"; ?>
<!-- Setting Page Title Start -->

<!-- Including Header Start -->
<?php include_once(__DIR__ . "/partials/header.php"); ?>
<!-- Including Header End -->

<!-- Main Content Start -->
<main class="main">
    <section class="container">
        <!-- Form Start -->
        <form method="POST" class="form">
            <!-- Form Field Start -->
            <div class="form__field">
                <!-- Form Labels & Inputs Start -->
                <label class="form__label" for="username">Username:</label>
                <input class="form__input" type="text" name="username" id="username" value="<?php echo $usernameSession; ?>">
                <!-- Form Labels & Inputs End -->

                <p class="error"><?php echo FormErrors('username', $formErrors); ?></p>
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

            <!-- Form Button Start -->
            <div class="form__button">
                <button type="submit" name="login">Login</button>
            </div>
            <!-- Form Button End -->

            <!-- Displaying Error Message Start -->
            <p class="error"><?php echo FormErrors('invalid_credentials', $formErrors); ?></p>
            <!-- Displaying Error Message End -->
        </form>
        <!-- Form End -->
    </section>
</main>
<!-- Main Content End -->

<!-- Unsetting Username Session Start -->
<?php unset($_SESSION['username']); ?>
<!-- Unsetting Username Session End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->