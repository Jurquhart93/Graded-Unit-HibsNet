<!-- Inlcuding Database Files Start -->
<?php include_once(__DIR__ . '/database/conn.php'); ?>
<!-- Inlcuding Database Files End -->

<!-- Setting Page Title Start -->
<?php $pageTitle = "Home"; ?>
<!-- Setting Page Title Start -->

<!-- Including Header Start -->
<?php include_once(__DIR__ . "/partials/header.php"); ?>
<!-- Including Header End -->

<!-- Main Content Start -->
<main class="main">
    <section class="landing-image">
        <div class="container">
            <!-- Upcoming Match Start -->
            <div id="fs-upcoming"><!-- Dynamically Generated Upcoming Match Day --></div>
            <!-- Upcoming Match End -->
        </div>
    </section>

    <!-- Recent Forum Activity Start -->
    <section class="container">
        <h1 class="title title--h1">Recent Forum Activity</h1>

        <!-- Including Post(s) Start -->
        <?php include("./components/post.php"); ?>
        <?php include("./components/post.php"); ?>
        <!-- Including Post(s) End -->
    </section>
    <!-- Recent Forum Activity End -->

    <!-- Hibernian Widgets Start -->
    <section class="widgets container">
        <!-- Hibernian Stats Widget Start -->
        <div>
            <h2 class="title title--h2">Hibernian Stats</h2>

            <!-- Hibernian Stats Start -->
            <iframe src="https://footystats.org/api/club?id=1017" height="100%" width="100%" style="height:420px; width:100%;" frameborder="0" class="fs-embed-wrapper"></iframe>
            <!-- Hibernian Stats End -->
        </div>
        <!-- Hibernian Stats Widget End -->

        <!-- League Table Start -->
        <div>
            <h3 class="title title--h2">League Table</h3>

            <!-- SPFL League Table Widget Start -->
            <div id="fs-standings"><!-- Dynamically Generated League Table --></div>
            <!-- SPFL League Table Widget End -->
        </div>
        <!-- League Table End -->
    </section>
    <!-- Hibernian Widgets End -->
</main>
<!-- Main Content End -->

<script>
    (function(w, d, s, o, f, js, fjs) {
        w['fsUpcomingEmbed'] = o;
        w[o] = w[o] || function() {
            (w[o].q = w[o].q || []).push(arguments)
        };
        js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];
        js.id = o;
        js.src = f;
        js.async = 1;
        fjs.parentNode.insertBefore(js, fjs);
    }(window, document, 'script', 'fsUpcoming', 'https://cdn.footystats.org/embeds/upcoming.js'));
    fsUpcoming('params', {
        teamID: 1017
    });

    (function(w, d, s, o, f, js, fjs) {
        w['fsStandingsEmbed'] = o;
        w[o] = w[o] || function() {
            (w[o].q = w[o].q || []).push(arguments)
        };
        js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];
        js.id = o;
        js.src = f;
        js.async = 1;
        fjs.parentNode.insertBefore(js, fjs);
    }(window, document, 'script', 'mw', 'https://cdn.footystats.org/embeds/standings.js'));
    mw('params', {
        leagueID: 12455
    });
</script>

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/partials/footer.php"); ?>
<!-- Including Footer End -->