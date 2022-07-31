CREATE TABLE HOSPITAL(
Hospital_id INT NOT NULL,
Hospital_name VARCHAR(100),
Hospital_province VARCHAR(50),
Hospital_city VARCHAR(50),
Hospital_latitude FLOAT,
Hospital_longitude FLOAT,
capacity INT,
Current INT,
PRIMARY KEY(Hospital_id)
);