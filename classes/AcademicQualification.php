<?php

class AcademicQualification {

    public static function saveAcademicQualifications($user_id, $academic_qualifications,$connection){

        foreach ($academic_qualifications as $qualification) {
            $sql = "INSERT INTO academic_qualifications (candidate_id, degree, institute_name, specialization, year_of_passing, percentage_grade)
                VALUES (:candidate_id, :qualification_degree, :institute_name, :specialization, :year_of_passing, :percentage_grade)";

            $stmt = $connection->prepare($sql);

            $stmt->bindParam(':candidate_id', $user_id);
            $stmt->bindParam(':qualification_degree', $qualification['degree']);
            $stmt->bindParam(':institute_name', $qualification['institute_name']);
            $stmt->bindParam(':specialization', $qualification['specialization']);
            $stmt->bindParam(':year_of_passing', $qualification['passing_year']);
            $stmt->bindParam(':percentage_grade', $qualification['percentage']);

            $stmt->execute();
        }
        return true;
    }

    public static function getAcademicDetails($id,$connection)
    {
        $academic_qualifications = "SELECT * FROM academic_qualifications WHERE candidate_id={$id}";
        $qualification = $connection->prepare($academic_qualifications);
        $qualification->execute();
        return $qualification->fetchAll(PDO::FETCH_ASSOC);
    }

}
