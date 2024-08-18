<?php

class WorkExperience
{
    public static function saveWorkExperiences($user_id, $work_experiences,$connection)
    {
        foreach ($work_experiences as $work_experience)
        {
            $sql = "INSERT INTO work_experiences(candidate_id, company, position, duration, salary_drawn, reason_of_leaving)
        VALUES (:candidate_id, :company, :job_position, :duration, :salary_drawn, :reason_of_leaving)";

            $stmt = $connection->prepare($sql);
            // Bind parameters
            $stmt->bindParam(':candidate_id', $user_id);
            $stmt->bindParam(':company', $work_experience['company']);
            $stmt->bindParam(':job_position', $work_experience['position']);
            $stmt->bindParam(':duration', $work_experience['duration']);
            $stmt->bindParam(':salary_drawn', $work_experience['salary_drawn']);
            $stmt->bindParam(':reason_of_leaving', $work_experience['reason_of_leaving']);

            // Execute the statement
            $stmt->execute();
        }
        return true;
    }

    public static function getWorkExperiences($id, $connection){
        $work_experiences = "SELECT * FROM work_experiences WHERE candidate_id={$id}";
        $experience = $connection->prepare($work_experiences);
        $experience->execute();
        return $experience->fetchAll(PDO::FETCH_ASSOC);
    }
}