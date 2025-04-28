<!-- Inlcuding Session and DB Files Start -->
<?php include_once(__DIR__ . '/../includes.php'); ?>
<!-- Inlcuding Session and DB Files End -->

<?php
if (!isset($_SESSION['user'])) {
    if (!$member['admin'] || !$member['moderator']) {
        header("Location: " . $baseUrl . "/404.php");
    }
}

$reports = PreparedSelectStmt($conn, "SELECT * FROM gu_reports");

if (isset($reports['id'])) {
    $reports = [$reports];
}

if (isset($_POST['check_post']) || isset($_POST['delete_post'])) {
    $id = $_POST['check_post'] ?? $_POST['delete_post'];
    $paramName = "post_id";
} elseif (isset($_POST['check_reply']) || isset($_POST['delete_reply'])) {
    $id = $_POST['check_reply'] ?? $_POST['delete_reply'];
    $paramName = "reply_id";
} elseif (isset($_POST['check_sub_reply']) || isset($_POST['delete_sub_reply'])) {
    $id = $_POST['check_sub_reply'] ?? $_POST['delete_sub_reply'];
    $paramName = "sub_reply_id";
}

if (isset($_POST['check_post']) || isset($_POST['check_reply']) || isset($_POST['check_sub_reply'])) {
    $stmt = $conn->prepare("DELETE FROM gu_reports WHERE $paramName = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    setStatus("Post Checked");

    header("Location: " . $baseUrl . "/admin/");
}

if (isset($_POST['delete_post']) || isset($_POST['delete_reply']) || isset($_POST['delete_sub_reply'])) {
    // Transaction Start
    $conn->begin_transaction();
    // Transaction End

    try {
        if (isset($_POST['delete_sub_reply'])) {
            // Deleting Sub Reply Start
            $stmt = $conn->prepare("DELETE FROM gu_sub_replies WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            // Deleting Sub Reply End
        } elseif (isset($_POST['delete_reply'])) {
            // Selecting All Sub Replies That Are Associated With The Reply Start
            $subReplies = PreparedSelectStmt($conn, "SELECT * FROM gu_sub_replies WHERE reply_id = ?", "i", [$id]);
            // Selecting All Sub Replies That Are Associated With The Reply End

            if (isset($subReplies['id'])) {
                $subReplies = [$subReplies];
            }

            // If Sub Replies Is Not Empty Start
            if (!empty($subReplies)) {
                // For Each Sub Reply Start
                foreach ($subReplies as $subReply) {
                    // Checking If Sub Replies Also Appear In The Gu_Reports Table Start
                    $checkReports = $conn->prepare("SELECT * FROM gu_reports WHERE sub_reply_id = ?");
                    $checkReports->bind_param("i", $subReply['id']);
                    $checkReports->execute();
                    $checkReports->store_result();

                    // Deleting Sub Replies From Gu_Reports Start
                    if ($checkReports->num_rows > 0) {
                        $stmt = $conn->prepare("DELETE FROM gu_reports WHERE sub_reply_id = ?");
                        $stmt->bind_param("i", $subReply['id']);
                        $stmt->execute();
                        $stmt->close();
                    }
                    // Deleting Sub Replies From Gu_Reports End

                    $checkReports->close();
                    // Checking If Sub Replies Also Appear In The Gu_Reports Table End
                }
                // For Each Sub Reply End

                // Delete Record Whenever The Replies Id Appears In The Gu_Sub_Replies Table Start
                $stmt = $conn->prepare("DELETE FROM gu_sub_replies WHERE reply_id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
                // Delete Record Whenever The Replies Id Appears In The Gu_Sub_Replies Table End
            }
            // If Sub Replies Is Not Empty End

            // Deleting Reply Start
            $stmt = $conn->prepare("DELETE FROM gu_replies WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            // Deleting Reply End
        } elseif (isset($_POST['delete_post'])) {
            // Selecting All Replies Associated With The Post Start
            $replies = PreparedSelectStmt($conn, "SELECT * FROM gu_replies WHERE post_id = ?", "i", [$id]);
            // Selecting All Replies Associated With The Post End

            if (isset($replies['id'])) {
                $replies = [$replies];
            }

            // If Replies Is Not Empty Start
            if (!empty($replies)) {
                // For Each Reply Start
                foreach ($replies as $reply) {
                    // Selecting All Sub Replies Associated With The Reply Start
                    $subReplies = PreparedSelectStmt($conn, "SELECT * FROM gu_sub_replies WHERE reply_id = ?", "i", [$reply['id']]);
                    // Selecting All Sub Replies Associated With The Reply End

                    if (isset($subReplies['id'])) {
                        $subReplies = [$subReplies];
                    }

                    // If Sub Replies Is Not Empty Start
                    if (!empty($subReplies)) {
                        // For Each Sub Reply Start
                        foreach ($subReplies as $subReply) {
                            // Checking If Sub Replies Also Appear In The Gu_Reports Table Start
                            $checkReports = $conn->prepare("SELECT * FROM gu_reports WHERE sub_reply_id = ?");
                            $checkReports->bind_param("i", $subReply['id']);
                            $checkReports->execute();
                            $checkReports->store_result();

                            // Deleting Sub Replies From Gu_Reports Start
                            if ($checkReports->num_rows > 0) {
                                $stmt = $conn->prepare("DELETE FROM gu_reports WHERE sub_reply_id = ?");
                                $stmt->bind_param("i", $subReply['id']);
                                $stmt->execute();
                                $stmt->close();
                            }
                            // Deleting Sub Replies From Gu_Reports End

                            $checkReports->close();
                            // Checking If Sub Replies Also Appear In The Gu_Reports Table End
                        }
                        // For Each Sub Reply End

                        // Delete Record Whenever The Replies Id Appears In The Gu_Sub_Replies Table Start
                        $stmt = $conn->prepare("DELETE FROM gu_sub_replies WHERE reply_id = ?");
                        $stmt->bind_param("i", $reply['id']);
                        $stmt->execute();
                        $stmt->close();
                        // Delete Record Whenever The Replies Id Appears In The Gu_Sub_Replies Table End
                    }
                    // If Sub Replies Is Not Empty End

                    // Checking If Replies Also Appear In The Gu_Reports Table Start
                    $checkReports = $conn->prepare("SELECT * FROM gu_reports WHERE reply_id = ?");
                    $checkReports->bind_param("i", $reply['id']);
                    $checkReports->execute();
                    $checkReports->store_result();

                    // Deleting Replies From Gu_Reports Start
                    if ($checkReports->num_rows > 0) {
                        $stmt = $conn->prepare("DELETE FROM gu_reports WHERE reply_id = ?");
                        $stmt->bind_param("i", $reply['id']);
                        $stmt->execute();
                        $stmt->close();
                    }
                    // Deleting Replies From Gu_Reports End

                    $checkReports->close();
                    // Checking If Replies Also Appear In The Gu_Reports Table End

                    // Delete Reply Start
                    $stmt = $conn->prepare("DELETE FROM gu_replies WHERE id = ?");
                    $stmt->bind_param("i", $reply['id']);
                    $stmt->execute();
                    $stmt->close();
                    // Delete Reply End
                }
                // For Each Reply End
            }
            // If Replies Is Not Empty End

            // Deleting Post Start
            $stmt = $conn->prepare("DELETE FROM gu_posts WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            // Deleting Post End
        }

        // Deleting The Original Report Start
        $stmt = $conn->prepare("DELETE FROM gu_reports WHERE $paramName = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        // Deleting The Original Report End

        // Commiting The Changes Start
        $conn->commit();
        // Commiting The Changes End

        // Set Status Message Start
        setStatus("Post Deleted");
        // Set Status Message End
    } catch (Exception $e) {

        // Rolling Back The Changes If Something Failed Start
        $conn->rollback();
        // Rolling Back The Changes If Something Failed End

        // Set Status Message Start
        setStatus("Delete Failed: " . $e->getMessage());
        // Set Status Message End
    }

    // Redirecting Start
    header("Location: " . $baseUrl . "/admin/reports.php");
    // Redirecting End
}
?>

<!-- Setting Page Title Start -->
<?php $pageTitle = "Admin Panel | Reports"; ?>
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
            <h1>Reports</h1>
            <!-- Displaying All Reports Start -->
            <div class="admin__reports">
                <!-- If The Reports Is Not Empty Start -->
                <?php if (!empty($reports)) { ?>

                    <?php foreach ($reports as $report) { ?>

                        <?php
                        // Assigning Variables To Allow For Re-Usable Code Start
                        if (!empty($report['post_id'])) {
                            $id = $report['post_id'];
                            $tableName = "gu_posts";
                            $contentName = "post_content";
                            $checkName = "check_post";
                            $deleteName = "delete_post";
                        } elseif (!empty($report['reply_id'])) {
                            $id = $report['reply_id'];
                            $tableName = "gu_replies";
                            $contentName = "reply_content";
                            $checkName = "check_reply";
                            $deleteName = "delete_reply";
                        } elseif (!empty($report['sub_reply_id'])) {
                            $id = $report['sub_reply_id'];
                            $tableName = "gu_sub_replies";
                            $contentName = "sub_reply_content";
                            $checkName = "check_sub_reply";
                            $deleteName = "delete_sub_reply";
                        }
                        // Assigning Variables To Allow For Re-Usable Code End

                        $post = PreparedSelectStmt($conn, "SELECT * FROM $tableName WHERE id = ?", "i", [$id]);
                        ?>

                        <!-- Displaying Individual Reports Start -->
                        <div class="post">
                            <div class="post__wrapper">
                                <?php echo $post[$contentName]; ?>
                            </div>
                            <div class="post__controls">
                                <form method="POST">
                                    <div class="form__button">
                                        <button name="<?php echo $checkName; ?>" value="<?php echo e($post['id']); ?>">Check</button>
                                    </div>
                                </form>
                                <form method="POST">
                                    <div class="form__button">
                                        <button name="<?php echo $deleteName; ?>" value="<?php echo e($post['id']); ?>">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Displaying Individual Reports End -->
                    <?php } ?>
                    <!-- If The Reports Is Not Empty End -->
                    <!-- Else Display That No Reports Found Start -->
                <?php } else { ?>
                    <p>No reports found.</p>
                <?php } ?>
                <!-- Else Display That No Reports Found End -->
            </div>
            <!-- Displaying All Reports End -->
        </section>
        <!-- Admin Content End -->
    </section>
    <!-- Admin Panel End -->
</main>
<!-- Main Content End -->

<!-- Including Footer Start -->
<?php include_once(__DIR__ . "/../partials/footer.php"); ?>
<!-- Including Footer End -->