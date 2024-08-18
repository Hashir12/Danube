<?php
require_once('classes/Candidate.php');
$candidateObj = new Candidate();
$candidates = $candidateObj->getCandidates();
?>

<html>
<head>
    <title>Interview Forms List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Pre-Interview Form List</h4>
                    <a href="views/pre_interview.php" class="btn btn-success text-right">Add New Details</a>
                </div>
                <div class="card-body">
                    <?php if (count($candidates) > 0) { ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Position</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile #</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($candidates as $candidate) { ?>
                            <tr>
                                <td><?= $candidate['job_position'] ?></td>
                                <td><?= $candidate['full_name'] ?></td>
                                <td><?= $candidate['email_id'] ?></td>
                                <td><?= $candidate['contact_number'] ?></td>
                                <td>
                                    <a href="views/pre_interview.php?id=<?= $candidate['id'] ?>" class="btn btn-primary">See Full Details</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php } else { ?>
                        <div class="d-flex flex-column align-items-center">
                            <img src="image/undraw_no_data_re_kwbl.svg" alt="">
                            <h2 class="text-center mt-2">No Record Found</h2>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
</body>
</html>
