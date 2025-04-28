<?php

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/auth/sessions.php');
require_once(__DIR__ . '/database/conn.php');
require_once(__DIR__ . '/database/queries.php');
require_once(__DIR__ . '/components/functions.php');
require_once(__DIR__ . '/partials/status.php');

if (!empty($memberId)) {
    $member = PreparedSelectStmt($conn, "SELECT * FROM gu_members WHERE id = ?", "i", [$memberId]);
}

// Declaring Variables Start
$formErrors = array();
$oldFormData = $_POST;
// Declaring Variables End

// $zeroOne = 0;
// $zeroTwo = 0;

if (isset($_POST['report-sub_reply'])) {
    $subReplyId = $_POST['report-sub_reply'];

    $stmt = $conn->prepare("INSERT INTO gu_reports (sub_reply_id) VALUES (?)");
    $stmt->bind_param("i", $subReplyId);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    setStatus("Post Reported");

    header("Location: " . $baseUrl . "/thread.php?id=" . $_GET['id'] . "&page=1");
} elseif (isset($_POST['report-reply'])) {
    $replyId = $_POST['report-reply'];

    $stmt = $conn->prepare("INSERT INTO gu_reports (reply_id) VALUES (?)");
    $stmt->bind_param("i", $replyId);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    setStatus("Post Reported");

    header("Location: " . $baseUrl . "/thread.php?id=" . $_GET['id'] . "&page=1");
} elseif (isset($_POST['report-post'])) {
    $postId = $_POST['report-post'];

    $stmt = $conn->prepare("INSERT INTO gu_reports (post_id) VALUES (?)");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    setStatus("Post Reported");

    header("Location: " . $baseUrl . "/thread.php?id=" . $_GET['id'] . "&page=1");
}
