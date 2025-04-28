<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/../includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
if (!isset($_SESSION['user']) || !$member['admin']) {
    header("Location: " . $baseUrl . "/404.php");
}
?>

<!-- Setting Page Title Start -->
<?php $pageTitle = "Admin Panel | Members"; ?>
<!-- Setting Page Title Start -->

<!-- Including Header Start -->
<?php include_once(__DIR__ . "/../partials/header.php"); ?>
<!-- Including Header End -->

<!-- Main Content Start -->
<main class="main">
    <!-- Admin Panel Start -->
    <section class="container admin">
        <!-- Requiring Admin Nav Start -->
        <?php require(__DIR__ . "/../partials/admin-nav.php"); ?>
        <!-- Requiring Admin Nav End -->

        <!-- Admin Content Start -->
        <section class="admin__content">
            <h1>Members</h1>

            <div class="search">
                <form action="<?php echo $baseUrl; ?>search/search.php">
                    <input type="text" placeholder="Search.." name="search_query" class="search__input" id="live-search" autocomplete="off">
                </form>

                <div class="search__results" id="search-result">

                </div>
            </div>
        </section>
        <!-- Admin Content End -->
    </section>
    <!-- Admin Panel End -->
</main>
<!-- Main Content End -->

<script type="text/javascript">
    $(document).ready(function() {
        // STORING VALUE OF THE SEARCH BOX INTO INPUT VARIABLE
        $('#live-search').keyup(function() {
            var input = $(this).val();

            if (input !== "") {
                $.ajax({
                    url: "<?php echo $baseUrl; ?>/components/live-search.php",
                    method: "POST",
                    data: {
                        input: input
                    },
                    success: function(data) {
                        $("#search-result").html(data);
                        $("#search-result").css("display", "block");
                    }
                });
            } else {
                $("#search-result").html(""); // Clear the search results when input is empty
                $("#search-result").css("display", "none");
            }
        });
    });
</script>

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/../partials/footer.php"); ?>
<!-- Including Footer End -->