-- Create the "clubs" table
CREATE TABLE clubs (
    District_Name VARCHAR(255),
    Region_Name VARCHAR(255),
    Zone_Name VARCHAR(255),
    Club_ID INT PRIMARY KEY,
    Club_Name VARCHAR(255)
);

-- Insert records into the "clubs" table from "c_1_members_new" table, avoiding duplicates
INSERT IGNORE INTO clubs (District_Name, Region_Name, Zone_Name, Club_ID, Club_Name)
SELECT District_Name, Region_Name, Zone_Name, Club_ID, Club_Name
FROM c_1_members_new;
