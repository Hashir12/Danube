<?php
require_once('../classes/Candidate.php');
$submit = true;
if (isset($_GET['id'])) {
    $candidate_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($candidate_id === false) {
        echo 'Invalid candidate ID';
        return;
    }

    $candidate = new Candidate();
    $candidate_data = $candidate->getCandidateDetails($candidate_id);
    $submit = false;
    if (!$candidate_data) {
        print_r('No candidate found');
        return ;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Interview Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/pre-interview.css">
</head>
<body>
<div class="container">
    <div class="card">
        <form action="../database/sql_functions.php" method="post" id="pre_interview_form">
            <div class="card-body">
                <hr class="head_border">
                <div class="text-center">
                    <h4><b>Pre-Interview Form</b></h4>
                </div>
                <!-- Personal Details -->
                <div>
                    <hr class="personal_details_border">
                    <h4>Personal Details</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="positionAppliedFor"><b>* Position Applied for</b></label>
                                <input type="text"
                                       class="form-control"
                                       name="position"
                                       id="positionAppliedFor"
                                       placeholder="Position Applied For"
                                       value="<?php echo isset($candidate_data['candidate']) ? $candidate_data['candidate']['job_position'] : ''; ?>"
                                    <?php echo isset($candidate_data['candidate']['job_position']) ? 'readonly' : ''; ?>
                                       >

                            </div>
                            <div class="form-group">
                                <label for="fullname"><b>* Name in Full</b></label>
                                <input type="text" class="form-control" name="full_name" id="fullname" placeholder="Name in Full" required
                                       value="<?php echo isset($candidate_data['candidate']) ? $candidate_data['candidate']['full_name'] : ''; ?>"
                                    <?php echo isset($candidate_data['candidate']['full_name']) ? 'readonly' : ''; ?>>
                            </div>
                            <div class="form-group">
                                <label for="contactNumber"><b>* Mobile No</b></label>
                                <input type="text" class="form-control" name="contact" id="contactNumber" placeholder="+971 55 1234567" pattern="^\+971(\s?[\-]?)?\d{2,3}(\s?[\-]?)?\d{7}$" required
                                       value="<?php echo isset($candidate_data['candidate']) ? $candidate_data['candidate']['contact_number'] : ''; ?>"
                                    <?php echo isset($candidate_data['candidate']['contact_number']) ? 'readonly' : ''; ?>>
                            </div>
                            <div class="form-group">
                                <label for="email"><b>* Email Id</b></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Id" required
                                       value="<?php echo isset($candidate_data['candidate']) ? $candidate_data['candidate']['email_id'] : ''; ?>"
                                    <?php echo isset($candidate_data['candidate']['email_id']) ? 'readonly' : ''; ?>>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender"><b>* Gender</b></label>
                                <select class="form-control" id="gender" name="gender" required  <?php echo isset($candidate_data['candidate']['gender']) ? 'readonly' : ''; ?>>
                                    <option value="">--Select--</option>
                                    <option value="male" <?php echo isset($candidate_data['candidate']['gender']) ? ($candidate_data['candidate']['gender'] == 'male' ? 'selected' : '') : ''; ?>>Male</option>
                                    <option value="female" <?php echo isset($candidate_data['candidate']['gender']) ? ($candidate_data['candidate']['gender'] == 'female' ? 'selected' : '') : ''; ?>>Female</option>
                                    <option value="other" <?php echo isset($candidate_data['candidate']['gender']) ? ($candidate_data['candidate']['gender'] == 'other' ? 'selected' : '') : ''; ?>>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="maritalStatus"><b>* Marital Status</b></label>
                                <select class="form-control" id="maritalStatus" name="marital_status" required  <?php echo isset($candidate_data['candidate']['marital_status']) ? 'readonly' : ''; ?>>
                                    <option value="">--Select--</option>
                                    <option value="single" <?php echo isset($candidate_data['candidate']['marital_status']) ? ($candidate_data['candidate']['marital_status'] == 'single' ? 'selected' : '') : ''; ?>>Single</option>
                                    <option value="married" <?php echo isset($candidate_data['candidate']['marital_status']) ? ($candidate_data['candidate']['marital_status'] == 'married' ? 'selected' : '') : ''; ?>>Married</option>
                                    <option value="divorced" <?php echo isset($candidate_data['candidate']['marital_status']) ? ($candidate_data['candidate']['marital_status'] == 'divorced' ? 'selected' : '') : ''; ?>>Divorced</option>
                                    <option value="widowed" <?php echo isset($candidate_data['candidate']['marital_status']) ? ($candidate_data['candidate']['marital_status'] == 'widowed' ? 'selected' : '') : ''; ?>>Widowed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dob"><b>* Date of Birth</b></label>
                                <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of Birth" pattern="\d{4}-\d{2}-\d{2}" required
                                       value="<?php echo isset($candidate_data['candidate']) ? $candidate_data['candidate']['dob'] : ''; ?>"
                                    <?php echo isset($candidate_data['candidate']['dob']) ? 'readonly' : ''; ?>>
                            </div>
                            <div class="form-group">
                                <label><b>* Contact Address</b></label>
                                <textarea class="form-control" name="address"
                                          id=""
                                          <?php echo isset($candidate_data['candidate']['contact_address']) ? 'readonly' : ''; ?>
                                          cols="30"
                                          rows="2"><?php echo isset($candidate_data['candidate']) ? $candidate_data['candidate']['contact_address'] : ''; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Academic Details -->
                <div>
                    <hr class="academic_qualification_border">
                    <h4>Academic Qualifications</h4>
                    <hr>
                    <?php if (isset($candidate_data['qualification'])) {
                        foreach ($candidate_data['qualification'] as $qualification) {
                        ?>
                    <div>
                        <div class="form-row mt-2">
                            <div class="col">
                                <input type="text" class="form-control qualificationName" placeholder="Degree/Diploma" value="<?php echo  $qualification['degree']; ?>" readonly>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control instituteName" placeholder="Institute Name" value="<?php echo  $qualification['institute_name']; ?>" readonly>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control specialization" placeholder="Specialization" value="<?php echo  $qualification['specialization']; ?>" readonly>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control yearOfPassing" placeholder="Year of Passing" value="<?php echo  $qualification['year_of_passing']; ?>" readonly>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control percentageGrade" placeholder="Percentage/Grade" value="<?php echo  $qualification['percentage_grade']; ?>" readonly>
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>
                    <?php } } else { ?>
                    <div id="academicQualifications">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="academic_qualification[0][degree]" class="form-control qualificationName" placeholder="Degree/Diploma">
                            </div>
                            <div class="col">
                                <input type="text" name="academic_qualification[0][institute_name]" class="form-control instituteName" placeholder="Institute Name">
                            </div>
                            <div class="col">
                                <input type="text" name="academic_qualification[0][specialization]" class="form-control specialization" placeholder="Specialization">
                            </div>
                            <div class="col">
                                <input type="number" name="academic_qualification[0][passing_year]" class="form-control yearOfPassing" placeholder="Year of Passing">
                            </div>
                            <div class="col">
                                <input type="text" name="academic_qualification[0][percentage]" class="form-control percentageGrade" placeholder="Percentage/Grade">
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mt-2" onclick="addAcademicQualification()">Add Academic Qualification</button>
                    <?php } ?>
                </div>
                <!-- Work Experience -->
                <div class="mt-5">
                    <hr class="work_exp_border">
                    <div class="d-flex align-items-baseline">
                        <h4>Work Experience&nbsp</h4>
                        <p>(Starting from current employer)</p>
                    </div>
                    <hr>
                    <?php if (isset($candidate_data['experience'])) {
                        foreach($candidate_data['experience'] as $experience) {
                        ?>
                        <div>
                            <div class="form-row mt-2">
                                <div class="col">
                                    <input type="text" class="form-control company" placeholder="Company" value="<?php echo $experience['company']; ?>" readonly>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control position" placeholder="Position" value="<?php echo $experience['position']; ?>" readonly>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control duration" placeholder="Duration" value="<?php echo $experience['duration']; ?>" readonly>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control salaryDrawn" placeholder="Salary Drawn" value="<?php echo $experience['salary_drawn']; ?>" readonly>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control reasonOfLeaving" placeholder="Reason of Leaving" value="<?php echo $experience['reason_of_leaving']; ?>" readonly>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                        </div>
                    <?php } } else { ?>
                    <div id="workExperiences">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="work_experience[0][company]" class="form-control company" placeholder="Company">
                            </div>
                            <div class="col">
                                <input type="text" name="work_experience[0][position]" class="form-control position" placeholder="Position">
                            </div>
                            <div class="col">
                                <input type="text" name="work_experience[0][duration]" class="form-control duration" placeholder="Duration">
                            </div>
                            <div class="col">
                                <input type="number" name="work_experience[0][salary_drawn]" class="form-control salaryDrawn" placeholder="Salary Drawn">
                            </div>
                            <div class="col">
                                <input type="text" name="work_experience[0][reason_of_leaving]" class="form-control reasonOfLeaving" placeholder="Reason of Leaving">
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mt-2" onclick="addWorkExperience()">Add Work Experience</button>
                    <?php } ?>
                </div>
                <!--Extra Curricular Activities-->
                <div class="mt-5">
                    <hr class="academic_qualification_border">
                    <h4>Extra Curricular Activities</h4>
                    <hr>
                    <div class="form-group">
                        <label for="hobbiesInterests"><b>* Hobbies/Interests</b></label>
                        <textarea name="interests"
                                  class="form-control"
                                  id="hobbiesInterests"
                                  <?php echo isset($candidate_data['other_detail']['interests']) ? 'readonly' : ''; ?>
                                  cols="30" rows="2" required><?php echo isset($candidate_data['other_detail']) ? $candidate_data['other_detail']['interests'] : 'Hobbies / Interests'; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reasonsForChoosing"><b>* What are your primary reasons for choosing Danube Group ?</b></label>
                        <select class="form-control" name="reasonsForChoosing" id="reasonsForChoosing" required  <?php echo isset($candidate_data['other_detail']['joining_reason']) ? 'readonly' : ''; ?>>
                            <option <?php echo isset($candidate_data['other_detail']['joining_reason']) ? ($candidate_data['other_detail']['joining_reason'] == 'job_nature' ? 'selected' : '') : ''; ?> value="job_nature">Nature of Job/Role</option>
                            <option <?php echo isset($candidate_data['other_detail']['joining_reason']) ? ($candidate_data['other_detail']['joining_reason'] == 'company_reput' ? 'selected' : '') : ''; ?> value="company_reput">Reputation of the company</option>
                            <option <?php echo isset($candidate_data['other_detail']['joining_reason']) ? ($candidate_data['other_detail']['joining_reason'] == 'career_growth' ? 'selected' : '') : ''; ?> value="career_growth">Career growth opportunities</option>
                            <option <?php echo isset($candidate_data['other_detail']['joining_reason']) ? ($candidate_data['other_detail']['joining_reason'] == 'attractive_salary' ? 'selected' : '') : ''; ?> value="attractive_salary">Attractive salary and benefits package</option>
                            <option <?php echo isset($candidate_data['other_detail']['joining_reason']) ? ($candidate_data['other_detail']['joining_reason'] == 'environment' ? 'selected' : '') : ''; ?> value="environment">Positive work culture and environment</option>
                            <option <?php echo isset($candidate_data['other_detail']['joining_reason']) ? ($candidate_data['other_detail']['joining_reason'] == 'balance' ? 'selected' : '') : ''; ?> value="balance">Work-life balance policies</option>
                            <option <?php echo isset($candidate_data['other_detail']['joining_reason']) ? ($candidate_data['other_detail']['joining_reason'] == 'flexible' ? 'selected' : '') : ''; ?> value="flexible working">Flexible work arrangements</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="languagesKnown"><b>* Language Known</b></label>
                        <input type="text" name="languages" class="form-control" id="languagesKnown" placeholder="Enter languages known" required
                            <?php echo isset($candidate_data['other_detail']['languages']) ? 'readonly' : ''; ?>
                            <?php echo isset($candidate_data['other_detail']) ? $candidate_data['other_detail']['languages'] : ''; ?>>
                    </div>
                    <div class="form-group">
                        <label><b>* Do you have any friends or relatives working in Danube?</b></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="friendsOrRelatives" id="friendsOrRelativesYes" value="yes"
                                <?php echo isset($candidate_data['other_detail']['relative_working']) ? ($candidate_data['other_detail']['relative_working'] == 'yes' ? 'checked' : '') : ''; ?>>
                            <label class="form-check-label" for="friendsOrRelativesYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="friendsOrRelatives" id="friendsOrRelativesNo" value="no"
                                <?php echo isset($candidate_data['other_detail']['relative_working']) ? ($candidate_data['other_detail']['relative_working'] == 'no' ? 'checked' : '') : ''; ?>>
                            <label class="form-check-label" for="friendsOrRelativesNo">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>* Legal issues: Have you ever been connected to a crime or is any criminal case pending against you?</b></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="legalIssues" id="legalIssuesYes" value="yes"
                                <?php echo isset($candidate_data['other_detail']['crime']) ? ($candidate_data['other_detail']['crime'] == 'yes' ? 'checked' : '') : ''; ?>>
                            <label class="form-check-label" for="legalIssuesYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="legalIssues" id="legalIssuesNo" value="no"
                                <?php echo isset($candidate_data['other_detail']['crime']) ? ($candidate_data['other_detail']['crime'] == 'no' ? 'checked' : '') : ''; ?>>
                            <label class="form-check-label" for="legalIssuesNo">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>* Any Medical Conditions / Issues?</b></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="medicalConditions" id="medicalConditionsYes" value="yes"
                                <?php echo isset($candidate_data['other_detail']['medical_issue']) ? ($candidate_data['other_detail']['medical_issue'] == 'yes' ? 'checked' : '') : ''; ?>>
                            <label class="form-check-label" for="medicalConditionsYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="medicalConditions" id="medicalConditionsNo" value="no"
                                <?php echo isset($candidate_data['other_detail']['medical_issue']) ? ($candidate_data['other_detail']['medical_issue'] == 'no' ? 'checked' : '') : ''; ?>>
                            <label class="form-check-label" for="medicalConditionsNo">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            <b>*  References: (will be strictly confidential)</b>
                            <table class="table border border-1" border="2">
                                <!--Header-->
                                <tr>
                                    <td class="reference-table"><b>Reference No 1 </b></td>
                                    <td class="reference-table"></td>
                                    <td class="reference-table"><b>Reference No 2 </b></td>
                                    <td class="reference-table"></td>
                                </tr>
                                <!--referee name-->
                                <tr>
                                    <td class="reference"><b>Name of referee</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[0][name]" class="form-control"
                                        value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][0]['name'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][0]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                    <td class="reference"><b>Name of referee</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[1][name]" class="form-control"
                                               value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][1]['name'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][1]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                </tr>
                                <!--Designation-->
                                <tr>
                                    <td class="reference"><b>Designation</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[0][designation]" class="form-control"
                                               value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][0]['designation'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][0]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                    <td class="reference"><b>Designation</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[1][designation]" class="form-control"
                                               value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][1]['designation'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][1]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                </tr>
                                <!--Company-->
                                <tr>
                                    <td class="reference"><b>Company</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[0][company]" class="form-control"
                                            value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][0]['company'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][0]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                    <td class="reference"><b>Company</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[1][company]" class="form-control"
                                               value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][1]['company'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][1]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                </tr>
                                <!--Address-->
                                <tr>
                                    <td class="reference"><b>Address</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[0][address]" class="form-control"
                                               value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][0]['address'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][0]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                    <td class="reference"><b>Address</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[1][address]" class="form-control"
                                               value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][1]['address'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][1]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                </tr>
                                <!--Office Contact #-->
                                <tr>
                                    <td class="reference"><b>Office phone No</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[0][office_number]" class="form-control"
                                               value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][0]['official_contact'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][0]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                    <td class="reference"><b>Office phone No</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[1][office_number]" class="form-control"
                                               value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][1]['official_contact'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][1]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                </tr>
                                <!--Mobile No-->
                                <tr>
                                    <td class="reference"><b>Mobile</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[0][mobile]" class="form-control"
                                               value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][0]['personal_contact'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][0]) ? 'readonly' : ''; ?>
                                        >
                                    </td>
                                    <td class="reference"><b>Mobile</b></td>
                                    <td class="reference">
                                        <input type="text" name="referee[1][mobile]" class="form-control"
                                               value="<?php echo isset($candidate_data['references']) ? $candidate_data['references'][1]['personal_contact'] : ''; ?>"
                                            <?php echo isset($candidate_data['references'][1]) ? 'readonly' : ''; ?>>
                                    </td>
                                </tr>
                            </table>
                        </label><br>
                    </div>
                    <div class="form-group">
                        <label>
                            <b>* Please provide your Present/Last drawn Salary Break Up</b>
                        </label><br>
                        <table border="2" class="border border-1">
                            <tr>
                                <th>Basic Salary</th>
                                <th>House Rent Allowance</th>
                                <th>Car/Transportation Allowance</th>
                                <th>Other Allowance</th>
                                <th>Gross Salary</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="basic_salary" placeholder="AED" class="form-control"
                                           value="<?php echo isset($candidate_data['salary_detail']) ? $candidate_data['salary_detail']['basic_salary'] : ''; ?>"
                                        <?php echo isset($candidate_data['salary_detail']['basic_salary']) ? 'readonly' : ''; ?>
                                    >
                                </td>
                                <td>
                                    <input type="number" name="house_rent" placeholder="AED" class="form-control"
                                           value="<?php echo isset($candidate_data['salary_detail']) ? $candidate_data['salary_detail']['house_rent'] : ''; ?>"
                                        <?php echo isset($candidate_data['salary_detail']['house_rent']) ? 'readonly' : ''; ?>
                                    >
                                </td>
                                <td>
                                    <input type="number" name="transport_allowance" placeholder="AED" class="form-control"
                                           value="<?php echo isset($candidate_data['salary_detail']) ? $candidate_data['salary_detail']['transportation'] : ''; ?>"
                                        <?php echo isset($candidate_data['salary_detail']['transportation']) ? 'readonly' : ''; ?>
                                    >
                                </td>
                                <td>
                                    <input type="number" name="other_allowance" placeholder="AED" class="form-control"
                                           value="<?php echo isset($candidate_data['salary_detail']) ? $candidate_data['salary_detail']['other_allowance'] : ''; ?>"
                                        <?php echo isset($candidate_data['salary_detail']['other_allowance']) ? 'readonly' : ''; ?>>
                                </td>
                                <td>
                                    <input type="number" name="gross_salary" placeholder="AED" class="form-control"
                                           value="<?php echo isset($candidate_data['salary_detail']) ? $candidate_data['salary_detail']['gross'] : ''; ?>"
                                        <?php echo isset($candidate_data['salary_detail']['gross']) ? 'readonly' : ''; ?>>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <label>
                            <b>* Please mention if you are entitled any other benefits apart from salary</b>
                        </label><br>
                        <textarea class="form-control" name="other_benefits"  <?php echo isset($candidate_data['other_detail']['other_benefits']) ? 'readonly' : ''; ?>><?php echo isset($candidate_data['other_detail']) ? $candidate_data['other_detail']['other_benefits'] : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><b>* UAE Driving License:</b></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="drivingLicense" id="drivingLicenseYes" value="yes"
                                <?php echo isset($candidate_data['other_detail']['driving_license']) ? ($candidate_data['other_detail']['driving_license'] == 'yes' ? 'checked' : '') : ''; ?>>
                            <label class="form-check-label" for="medicalConditionsYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="drivingLicense" id="drivingLicenseNo" value="no"
                                <?php echo isset($candidate_data['other_detail']['driving_license']) ? ($candidate_data['other_detail']['driving_license'] == 'no' ? 'checked' : '') : ''; ?>>
                            <label class="form-check-label" for="medicalConditionsNo">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for=""><b>* Joining time required(month(s)/days)</b></label>
                        <input type="text" name="joining" placeholder="month(s)/days" class="form-control" required
                               value="<?php echo isset($candidate_data['other_detail']) ? $candidate_data['other_detail']['notice_period'] : ''; ?>"
                            <?php echo isset($candidate_data['other_detail']['notice_period']) ? 'readonly' : ''; ?>
                        >
                    </div>
                    <div class="form-group">
                        <label for=""><b>* Expected Salary</b></label>
                        <input type="text" name="expected_salary" placeholder="AED (month)" class="form-control"
                               value="<?php echo isset($candidate_data['other_detail']) ? $candidate_data['other_detail']['expected_salary'] : ''; ?>"
                            <?php echo isset($candidate_data['other_detail']['expected_salary']) ? 'readonly' : ''; ?>
                        >
                    </div>
                    <div class="form-group">
                        <label for=""><b>* Please draw the reporting / hierarchy structure in your current company</b></label>
                        <div>
                            <canvas id="hierarchy" class="canvas"></canvas>
                            <input type="text" id="company_hierarchy" name="hierarchy" class="d-none">
                        </div>
                    </div>
                </div>
                <!--Declaration-->
                <div class="mt-5">
                    <hr class="declaration_border">
                    <div class="text-center">
                        <h5><b>DECLARATION</b></h5>
                        <div class="d-flex justify-content-center">
                            <input type="checkbox" id="declaration" name="declaration" <?php echo isset($candidate_data['other_detail']) ? 'checked' : ''; ?>>
                            <p class="m-0 ml-2">I declare that the particulars in this application are correct and that I have NOT knowingly withheld any facts</p>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="form-group text-left">
                                    <label for="submissionDate"><b>Date</b></label>
                                    <input type="date" class="form-control" name="submission_date" id="submissionDate"
                                           value="<?php echo $candidate_data['other_detail']['date'] ?? ''; ?>"
                                        <?php echo isset($candidate_data['other_detail']['date']) ? 'readonly' : ''; ?>
                                    >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-left">
                                    <label for="place"><b>Place</b></label>
                                    <input type="text" name="candidate_place" class="form-control" id="place"
                                           value="<?php echo $candidate_data['other_detail']['place'] ?? ''; ?>"
                                        <?php echo isset($candidate_data['other_detail']['place']) ? 'readonly' : ''; ?>
                                    >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-left">
                                    <label for="place"><b>Signature of Applicant</b></label>
                                    <canvas id="signature" class="canvas"></canvas>
                                    <input type="text" id="candidate_signature" name="signature" class="form-control d-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!empty($submit)) { ?>
            <div class="text-right">
                <button class="btn btn-success mb-3 mr-3" type="submit"><b>Submit</b></button>
            </div>
            <?php } ?>
        </form>
    </div>
    <div class="mb-5 d-flex justify-content-between">
        <p><b>Copyright © 2023 Danube Group (https://www.aldanube.com/).</b>  All rights reserved.</p>
        <b class="m-0">Version</b>1.0.0
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/pre_interview.js"></script>
<script>
    <?php if (isset($candidate_data['other_detail'])) { ?>

    let showHierarchy = document.getElementById("hierarchy");
    let hierarchyImg = new SignaturePad(showHierarchy);
    hierarchyImg.fromDataURL("<?= $candidate_data['other_detail']['hierarchy_structure'] ?>");

    let showSignature = document.getElementById("signature");
    let signatureImg = new SignaturePad(showSignature);
    signatureImg.fromDataURL("<?= $candidate_data['other_detail']['candidate_signature'] ?>");
    <?php } ?>
</script>
</body>
</html>
