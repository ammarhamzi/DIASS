-- ========================================
-- Add Accident Records (51-66) to offendlist_2025
-- Run this AFTER loading records 1-43
-- ========================================

USE [your_database_name]; -- CHANGE THIS to your actual database name
GO

-- Insert the 16 accident records (51-66)
INSERT INTO offendlist_2025 (number, violation, description, demerit_point, monetary_penalty, offence_severity, adp_suspension_text, avp_suspension_text)
VALUES
-- Before Investigation Records (51-58)
(51, 'Accident Involving Fatality', '(i.e. the driver of a vehicle involved in an accident resulting in death)', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(52, 'Accident Involving aircraft', '(i.e. driver of vehicles involved with an accident resulting in damage to an aircraft)', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(53, 'Accidents involving major / severe Injuries', '(i.e. the driver of a vehicle involved in an accident resulting in serious physical/bodily injury.)', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(54, 'Accident Involving Minor Injuries', '(i.e. the driver of a vehicle involved in an accident resulting in minor physical/bodily injury.)', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(55, 'Accident Involving Minor Injuries (within Movement Area)', '(i.e. the driver of a vehicle involved in an accident resulting in minor physical/bodily injury.)', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(56, 'Accident Involving Major damage to equipment/vehicle or Facilities', 'i.e. fixtures and / or structures.', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(57, 'Accident Involving Minor damage to equipment/vehicle and / or fixtures/structures/facilities', '', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(58, 'Accident Involving Minor damage to equipment/vehicle and / or fixtures/structures/facilities (within Movement Area)', '', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),

-- After Investigation Records (59-66)
(59, 'Accident Involving Fatality', '(i.e. The driver of a vehicle involved in an accident resulting in death)', 12, 'RM300', 'Critical Offence - After Investigation', 'Terminated and Blacklisted', 'Released'),
(60, 'Accident Involving aircraft', '(i.e. driver of vehicles involved with an accident resulting in damage to an aircraft)', 12, 'RM300', 'Critical Offence - After Investigation', 'Terminated and Blacklisted', 'Released'),
(61, 'Accidents involving major / severe Injuries', '(i.e. The driver of a vehicle involved in an accident resulting in serious physical/bodily injury.)', 12, 'RM300', 'Critical Offence - After Investigation', 'Terminated and Blacklisted', 'Released'),
(62, 'Accident Involving Major damage to equipment/vehicle or Facilities', 'i.e. fixtures and / or structures.', 12, 'RM300', 'Critical Offence - After Investigation', 'Terminated and Blacklisted', 'Released'),
(63, 'Accident Involving Minor damage to equipment/vehicle and / or fixtures/structures/facilities', '(i.e. fixtures and/or structures)', 8, 'RM300', 'Critical Offence - After Investigation', '4 Months', 'Released'),
(64, 'Accident Involving Minor Injuries (within Movement Area)', '(i.e. the driver of a vehicle involved in an accident resulting in minor physical/bodily injury.)', 8, 'RM300', 'Critical Offence - After Investigation', '6 Months', 'Released'),
(65, 'Accident Involving Minor Injuries', '(i.e. the driver of a vehicle involved in an accident resulting in minor physical/bodily injury.)', 8, 'RM300', 'Critical Offence - After Investigation', '4 Months', 'Released'),
(66, 'Accident Involving Minor damage to equipment/vehicle and / or fixtures/structures/facilities (within Movement Area)', '', 8, 'RM300', 'Critical Offence - After Investigation', '6 Months', 'Released');

-- Verify total records
SELECT COUNT(*) AS TotalRecords FROM offendlist_2025;

-- View breakdown by severity
SELECT offence_severity, COUNT(*) AS Count 
FROM offendlist_2025 
GROUP BY offence_severity 
ORDER BY 
    CASE offence_severity
        WHEN 'Low Offence' THEN 1
        WHEN 'Moderate Offence' THEN 2
        WHEN 'High Offence' THEN 3
        WHEN 'Critical Offence' THEN 4
        WHEN 'Critical Offence - Before Investigation' THEN 5
        WHEN 'Critical Offence - After Investigation' THEN 6
    END;

PRINT 'Total records should be 50 (43 original + 16 accident)';
GO

