<?php

class SalaryDetails
{

    public static function saveSalaryDetails($userId, $data,$connection)
    {

        $sql = "INSERT INTO salary_details (candidate_id, basic_salary, house_rent,transportation, other_allowance, gross)
                    VALUES (:candidate_id, :basic_salary, :house_rent,:transportation, :other_allowance, :gross)";
        // Prepare the statement
        $stmt = $connection->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':candidate_id', $userId);
        $stmt->bindParam(':basic_salary', $data['basic_salary']);
        $stmt->bindParam(':house_rent', $data['house_rent']);
        $stmt->bindParam(':transportation', $data['transport_allowance']);
        $stmt->bindParam(':other_allowance', $data['other_allowance']);
        $stmt->bindParam(':gross', $data['gross_salary']);

        // Execute the statement
        $stmt->execute();

        return true;
    }
    public static function getSalaryDetails($id, $connection)
    {
        $salary_details = "SELECT * FROM salary_details WHERE candidate_id={$id}";
        $salary_detail = $connection->prepare($salary_details);
        $salary_detail->execute();
        return $salary_detail->fetch(PDO::FETCH_ASSOC);
    }
}