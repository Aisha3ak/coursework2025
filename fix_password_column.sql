-- Alter the Password column to be VARCHAR(255) to accommodate bcrypt hashes
ALTER TABLE users MODIFY COLUMN Password VARCHAR(255) NOT NULL; 