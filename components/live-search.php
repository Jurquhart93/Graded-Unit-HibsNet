<?php
include_once(__DIR__ . '/../includes.php');

if (isset($_POST['input'])) {

    $input = $_POST['input'];

    $sql = "SELECT *
            FROM gu_members 
            WHERE username LIKE '{$input}%'";

    $query = mysqli_query($conn, $sql) or die("Error: " . mysqli_error($conn));

    if (mysqli_num_rows($query) == 0) {
        echo "<p>No user found.</p>";
    } else {
        $users = array();

        while ($row = mysqli_fetch_assoc($query)) {
            $users[] = $row;
        }
    }


    if (!empty($users)) {

        // Fetch and display the results
        foreach ($users as $user) { ?>
            <div class="search__result">
                <p><?php echo $user['username']; ?></p>
                <a href="<?php echo $baseUrl; ?>/profile.php?id=<?php echo $user['id']; ?>">View Profile</a>
            </div>
<?php
        }
    }
}
?>