<?php

class OtherDetails
{

    public static function saveOtherDetails($userId, $data, $connection)
    {
        // Prepare the SQL query
        $sql = "INSERT INTO other_details (candidate_id, interests, joining_reason, languages, relative_working, crime, medical_issue,
                       other_benefits, driving_license, notice_period, expected_salary, hierarchy_structure ,date, place, candidate_signature)
                    VALUES (:candidate_id, :interests, :joining_reason, :languages, :relative_working, :crime, :medical_issue,
                            :other_benefits, :driving_license, :notice_period, :expected_salary ,:hierarchy_structure, :submission_date, :place, :candidate_signature)";

        $stmt = $connection->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':candidate_id', $userId);
        $stmt->bindParam(':interests', $data['interests']);
        $stmt->bindParam(':joining_reason', $data['reasonsForChoosing']);
        $stmt->bindParam(':languages', $data['languages']);
        $stmt->bindParam(':relative_working', $data['friendsOrRelatives']);
        $stmt->bindParam(':crime', $data['legalIssues']);
        $stmt->bindParam(':medical_issue', $data['medicalConditions']);
        $stmt->bindParam(':other_benefits', $data['other_benefits']);
        $stmt->bindParam(':driving_license', $data['drivingLicense']);
        $stmt->bindParam(':notice_period', $data['joining']);
        $stmt->bindParam(':expected_salary', $data['expected_salary']);
        $stmt->bindParam(':hierarchy_structure', $data['hierarchy']);
        $stmt->bindParam(':submission_date', $data['submission_date']);
        $stmt->bindParam(':place', $data['candidate_place']);
        $stmt->bindParam(':candidate_signature', $data['candidate_signature']);

        // Execute the statement
        $stmt->execute();
        return true;
    }

    public static function getOtherDetails($id, $connection)
    {
        $other_details = "SELECT * FROM other_details WHERE candidate_id={$id}";
        $other_detail = $connection->prepare($other_details);
        $other_detail->execute();
        return $other_detail->fetch(PDO::FETCH_ASSOC);
    }
}