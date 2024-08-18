CREATE TABLE candidates (
                                            id INT AUTO_INCREMENT PRIMARY KEY,
                                            full_name VARCHAR(100) NOT NULL,
                                            email_id VARCHAR(100) NOT NULL,
                                            contact_number VARCHAR(20),
                                            dob DATE,
                                            contact_address VARCHAR(50),
                                            marital_status ENUM('single', 'married', 'divorced', 'widowed'),
                                            gender ENUM('male', 'female', 'other'),
                                            job_position VARCHAR(50)
                );

CREATE TABLE academic_qualifications (
                                         id INT AUTO_INCREMENT PRIMARY KEY,
                                         candidate_id INT,
                                         degree VARCHAR(100) NOT NULL,
                                         institute_name VARCHAR(100) NOT NULL,
                                         specialization VARCHAR(100),
                                         year_of_passing INT,
                                         percentage_grade VARCHAR(20),
                                         FOREIGN KEY (candidate_id) REFERENCES candidates(id)
);

CREATE TABLE work_experiences (
                                  id INT AUTO_INCREMENT PRIMARY KEY,
                                  candidate_id INT,
                                  company VARCHAR(100) NOT NULL,
                                  position VARCHAR(100) NOT NULL,
                                  duration VARCHAR(100),
                                  salary_drawn DECIMAL(10, 2),
                                  reason_of_leaving TEXT,
                                  FOREIGN KEY (candidate_id) REFERENCES candidates(id)
);

CREATE TABLE reference (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           candidate_id INT,
                           name VARCHAR(255) NOT NULL,
                           designation VARCHAR(255),
                           company VARCHAR(255),
                           address VARCHAR(255),
                           official_contact VARCHAR(15),
                           personal_contact VARCHAR(15),
                           FOREIGN KEY (candidate_id) REFERENCES candidates(id)
);

CREATE TABLE salary_details (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                candidate_id INT,
                                basic_salary DECIMAL(10, 2),
                                house_rent DECIMAL(10, 2),
                                transportation DECIMAL(10, 2),
                                other_allowance DECIMAL(10, 2),
                                gross DECIMAL(10, 2),
                                FOREIGN KEY (candidate_id) REFERENCES candidates(id)
);

CREATE TABLE other_details (
                               id INT AUTO_INCREMENT PRIMARY KEY,
                               candidate_id INT,
                               interests text,
                               joining_reason VARCHAR(255),
                               languages VARCHAR(255),
                               relative_working ENUM('yes','no'),
                               crime ENUM('yes','no'),
                               medical_issue ENUM('yes','no'),
                               other_benefits text,
                               driving_license ENUM('yes','no'),
                               notice_period VARCHAR(255),
                               expected_salary DECIMAL(10, 2),
                               hierarchy_structure longtext,
                               date DATE,
                               place VARCHAR(255),
                               candidate_signature longtext,
                               FOREIGN KEY (candidate_id) REFERENCES candidates(id)
);