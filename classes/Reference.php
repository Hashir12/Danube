<?php

class Reference
{
    public static function saveReferences($userId, $referees,$connection)
    {
        foreach($referees as $referee) {
            // Prepare the SQL query
            $sql = "INSERT INTO reference (candidate_id, name, designation, company, address, official_contact, personal_contact)
                    VALUES (:candidate_id, :referee_name, :designation, :company, :address, :official_contact, :personal_contact)";

            // Prepare the statement
            $stmt = $connection->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':candidate_id', $userId);
            $stmt->bindParam(':referee_name', $referee['name']);
            $stmt->bindParam(':designation', $referee['designation']);
            $stmt->bindParam(':company', $referee['company']);
            $stmt->bindParam(':address', $referee['address']);
            $stmt->bindParam(':official_contact', $referee['office_number']);
            $stmt->bindParam(':personal_contact', $referee['mobile']);

            // Execute the statement
            $stmt->execute();
        }
        return true;
    }

    public static function getReferences($id, $connection)
    {
        $references = "SELECT * FROM reference WHERE candidate_id={$id}";
        $reference = $connection->prepare($references);
        $reference->execute();
        return $reference->fetchAll(PDO::FETCH_ASSOC);
    }
}