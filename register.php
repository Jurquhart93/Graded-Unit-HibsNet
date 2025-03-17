<!-- Inlcuding Database Files Start -->
<?php include_once(__DIR__ . '/database/conn.php'); ?>
<!-- Inlcuding Database Files End -->

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
                <input class="form__input" type="text" name="username" id="username">
                <!-- Form Labels & Inputs End -->
            </div>
            <!-- Form Field End -->

            <!-- Form Field Start -->
            <div class="form__field">
                <!-- Form Labels & Inputs Start -->
                <label class="form__label" for="email">Email:</label>
                <input class="form__input" type="email" name="email" id="email">
                <!-- Form Labels & Inputs End -->
            </div>
            <!-- Form Field End -->

            <!-- Form Field Start -->
            <div class="form__field">
                <!-- Form Labels & Inputs Start -->
                <label class="form__label" for="password">Password:</label>
                <input class="form__input" type="password" name="password" id="password">
                <!-- Form Labels & Inputs End -->
            </div>
            <!-- Form Field End -->

            <!-- Form Field Start -->
            <div class="form__field">
                <!-- Form Labels & Inputs Start -->
                <label class="form__label" for="repeat-password">Repeat Password:</label>
                <input class="form__input" type="password" name="repeat-password" id="repeat-password">
                <!-- Form Labels & Inputs End -->
            </div>
            <!-- Form Field End -->

            <!-- Form Checkbox Start -->
            <div class="form__checkbox">
                <!-- Form Labels & Inputs Start -->
                <input class="form__input" type="checkbox" name="admin" id="admin">
                <label class="form__label" for="admin">Agree to <a href="#">Terms & Conditions</a></label>
                <!-- Form Labels & Inputs End -->
            </div>
            <!-- Form Checkbox End -->

            <!-- Form Button Start -->
            <div class="form__button">
                <button type="submit" name="submit">Create Account</button>
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