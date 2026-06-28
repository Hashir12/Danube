<?php
require_once('../autoload.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $candidate = new Candidate();
    // Call the insertCandidate method with form data as parameters
    $inserted = $candidate->insertCandidate($_POST);

    if ($inserted) {
        header("Location: ../views/thanks.html");
    } else {
        echo "Failed to insert candidate data!";
    }
}