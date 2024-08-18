<?php
require_once(__DIR__.'/Database.php');
require_once(__DIR__.'/AcademicQualification.php');
require_once(__DIR__.'/WorkExperience.php');
require_once(__DIR__.'/Reference.php');
require_once(__DIR__.'/SalaryDetails.php');
require_once(__DIR__.'/OtherDetails.php');
class Candidate
{
    protected $connection;

    public function __construct() {
        // Create a new instance of the database connection
        $db = new Database();
        // Get database connection
        $this->connection = $db->getConnection();
    }

    public function insertCandidate($data)
    {
        try {
            // Start a transaction
            $this->connection->beginTransaction();

            // Retrieve form data
            $full_name = $data['full_name'];
            $email_id = $data['email'];
            $contact_number = $data['contact'];
            $dob = $data['dob'];
            $contact_address = $data['address'];
            $marital_status = $data['marital_status'];
            $gender = $data['gender'];
            $job_position = $data['position'];


            // Prepare the SQL query
            $sql = "INSERT INTO candidates (full_name, email_id, contact_number, dob, contact_address, marital_status, gender, job_position)
                    VALUES (:full_name, :email_id, :contact_number, :dob, :contact_address, :marital_status, :gender, :job_position)";

            // Prepare the statement
            $stmt = $this->connection->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':email_id', $email_id);
            $stmt->bindParam(':contact_number', $contact_number);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':contact_address', $contact_address);
            $stmt->bindParam(':marital_status', $marital_status);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':job_position', $job_position);

            // Execute the statement
            $stmt->execute();

            $lastInsertId = $this->connection->lastInsertId();

            AcademicQualification::saveAcademicQualifications($lastInsertId, $data['academic_qualification'],$this->connection); //saving data into academic_qualification table
            WorkExperience::saveWorkExperiences($lastInsertId, $data['work_experience'],$this->connection); //saving data into wor_experience table
            Reference::saveReferences($lastInsertId, $data['referee'],$this->connection);
            SalaryDetails::saveSalaryDetails($lastInsertId, $data,$this->connection);
            OtherDetails::saveOtherDetails($lastInsertId, $data,$this->connection);
            $this->connection->commit();
            return true;
        } catch (PDOException $e) {
            $this->connection->rollback();
            return false;
        }
    }

    public function getCandidates()
    {
        $sql = "SELECT * FROM candidates";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        // Fetch all rows as associative array
        $candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $candidates;

    }

    public function getCandidateDetails($id)
    {
        //Candidate Data
        $candidate = "SELECT * from candidates where id= $id";
        $candidate_stmt = $this->connection->prepare($candidate);
        $candidate_stmt->execute();
        $data['candidate'] = $candidate_stmt->fetch(PDO::FETCH_ASSOC);
        if ($data['candidate']) {
            //Candidate Qualification Data
            $data['qualification'] = AcademicQualification::getAcademicDetails($data['candidate']['id'], $this->connection);

            //Candidate Work Experiences
            $data['experience'] = WorkExperience::getWorkExperiences($data['candidate']['id'], $this->connection);

            //Candidate reference
            $data['references'] = Reference::getReferences($data['candidate']['id'], $this->connection);

            //Candidate Salary Details
            $data['salary_detail'] = SalaryDetails::getSalaryDetails($data['candidate']['id'], $this->connection);

            //Candidate Other Details
            $data['other_detail'] = OtherDetails::getOtherDetails($data['candidate']['id'], $this->connection);

            return $data;
        } else {
            return false;
        }

    }

}