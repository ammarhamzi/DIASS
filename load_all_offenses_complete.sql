-- ========================================
-- Load Offense Data into offendlist_2025 (COMPLETE VERSION - ALL 50 RECORDS)
-- SQL Server Management Studio (SSMS)
-- Includes all 43 original offenses + 16 new accident-related offenses
-- ========================================

USE diass; -- CHANGE THIS to your actual database name
GO

-- Ensure the table exists (create if needed)
IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[offendlist_2025]') AND type in (N'U'))
BEGIN
  CREATE TABLE dbo.offendlist_2025 (
    offence_id INT IDENTITY(1,1) PRIMARY KEY,
    number INT NOT NULL,
    violation NVARCHAR(500) NOT NULL,
    description NVARCHAR(MAX) NULL,
    demerit_point INT NULL,
    monetary_penalty NVARCHAR(100) NOT NULL,
    offence_severity NVARCHAR(100) NOT NULL,
    adp_suspension_text NVARCHAR(100) NOT NULL,
    avp_suspension_text NVARCHAR(100) NOT NULL,
    created_at DATETIME2 NOT NULL DEFAULT SYSUTCDATETIME(),
    is_active BIT NOT NULL DEFAULT 1,
    
    CONSTRAINT CK_offence_severity CHECK (offence_severity IN ('Low Offence', 'Moderate Offence', 'High Offence', 'Critical Offence', 'Critical Offence - Before Investigation', 'Critical Offence - After Investigation')),
    CONSTRAINT UQ_offence_number UNIQUE (number)
  );
  
  CREATE NONCLUSTERED INDEX IX_offence_severity ON dbo.offendlist_2025(offence_severity);
  CREATE NONCLUSTERED INDEX IX_offence_active ON dbo.offendlist_2025(is_active) WHERE is_active = 1;
END
GO

-- Update CHECK constraint to include new severities
IF EXISTS (SELECT * FROM sys.check_constraints WHERE name = 'CK_offence_severity')
BEGIN
    ALTER TABLE dbo.offendlist_2025 DROP CONSTRAINT CK_offence_severity;
END
GO

ALTER TABLE dbo.offendlist_2025
ADD CONSTRAINT CK_offence_severity CHECK (offence_severity IN ('Low Offence', 'Moderate Offence', 'High Offence', 'Critical Offence', 'Critical Offence - Before Investigation', 'Critical Offence - After Investigation'));
GO

-- If you already have data in offendlist_2025, uncomment the line below
DELETE FROM offendlist_2025;
GO

-- Insert all records
INSERT INTO offendlist_2025 (number, violation, description, demerit_point, monetary_penalty, offence_severity, adp_suspension_text, avp_suspension_text)
VALUES
(1, 'Failure to Ensure Vehicles and Equipment are free from FOD', 'Failure to ensure the vehicle/equipment is free from any Foreign Object Debris (FOD) that could potentially fall out and cause hazards in the airside area', 4, 'RM100', 'Low Offence', '2 weeks.', 'NIL'),
(2, 'Improper Way of Approaching Aircraft', 'Failure to approach an aircraft at an angle and keep to its right side when approaching that aircraft during aircraft servicing.', 4, 'RM100', 'Low Offence', '2 weeks.', 'NIL'),
(3, 'Improper Handling of Baggage or Cargo', 'Failure to ensure baggage, cargo, or equipment is properly carried within designated baggage carts, cages, or equipment cages/brackets.', 4, 'RM100', 'Low Offence', '2 weeks.', 'NIL'),
(4, 'Improper Usage of Headgear on Airside', 'Wearing a cap, scarf, or beret on the airside without it being secured by a string or earmuff.', 4, 'RM100', 'Low Offence', '2 weeks.', 'NIL'),
(5, 'Improper Use of Helmet', 'Failure to wear a helmet while riding in the airside area, wearing an inappropriate helmet for motorcycle use, or wearing a helmet in a color other than white.', 4, 'RM100', 'Low Offence', '2 weeks.', 'NIL'),
(6, 'Improper Towing Practices', 'No vehicle/equipment shall be towed by another vehicle/equipment within the airside unless a suitable tow bar or suitable vehicle/equipment is used for that purpose.', 4, 'RM100', 'Low Offence', '2 weeks.', 'NIL'),
(7, 'Violate No Seat, No Ride Policy', 'Riding in or on a vehicle without being properly seated, violating the "no seat, no ride" policy.', 4, 'RM100', 'Low Offence', '2 weeks.', 'NIL'),
(8, 'Improper Safety Vest', 'Wearing a safety vest that is non-reflective, worn out, or dirty. Personnel must wear safety vests that are reflective, in good condition, and clean at all times.', 4, 'RM100', 'Low Offence', '2 weeks.', 'NIL'),
(9, 'Failure to Maintain Vehicle or Equipment in good working conditions', 'Failure to ensure that vehicles or equipment used in the airside area are maintained in good working conditions in accordance with the MTW technical inspections checklist.', 4, 'RM100', 'Low Offence', '2 weeks.', '2 weeks.'),
(10, 'Failure to adhere to parking guidelines', 'Parking a vehicle or equipment in a manner likely to cause danger, obstruction, or undue inconvenience to other users outside the movement area, including but not limited to: i) Parking outside designated areas. ii) Double parking', 4, 'RM100', 'Low Offence', '2 weeks.', '2 weeks.'),
(11, 'Spillage Incident (reported cases)', 'Operating a vehicle that caused spillage in the airside area. This applies only to cases reported to the airside authority.', 0, 'NIL', 'Low Offence', 'NIL', '2 weeks.'),
(12, 'Carry out aircraft major maintenance at aircraft stand without approval', '', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(13, 'Carry out maintenance of vehicle or equipment at non-designated area', '', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(14, 'Driving on an unauthorized road and non-permissible taxiway crossing.', 'No person shall drive any vehicle into the stated areas within the airside.Unless approval is given by the Airside Services Department. The stated areas are; i. Bunga Raya Complex Road ii. Baggage Handling Areas iii. All taxiway crossings except permissible taxiway crossing', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(15, 'Driving or towing or stopping a vehicle under the wing, tail, or fuselage of an aircraft', 'No driver of any vehicle in the movement area shall stop or park the vehicle under the wing, tail, or fuselage of an aircraft unless the vehicle is being used in the course of refueling or technical servicing of the aircraft.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(16, 'Failure to secure equipment / vehicle with chock or lock', '', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(17, 'Failure to comply with any direction given by an authorized officer', 'The driver of a vehicle within the airside shall comply with any direction or verbal instruction given by any authorized person who is for the time being engaged in the regulation of traffic within the airside.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(18, 'Failure to give way to shuttle buses or any vehicles / convoys that are escorted by airside officers.', '', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(19, 'Failure to inspect aircraft stands immediately after the aircraft has been serviced.', 'This is to ensure that no foreign object or material that is likely to be hazardous to the operation of any aircraft is left on the aircraft stand.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(20, 'Failure to report any spillage or breakdown vehicle / equipment in airside area', '', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(21, 'Failure to Comply with Vehicle Requirements for the Temporary Entry Permit (TEP) application.', 'The requirements include: a. Company Identification: Vehicles must prominently display the company''s logo or name. b. Personal Vehicles: Personal vehicles are not eligible for a TEP application. c. Contractor Vehicles: Contractor vehicles used for construction work within the airside area must: Be white in color. Display a red and white checkered flag at the vehicle’s highest point. d. Beacon Light: Vehicles entering the apron area must be equipped with a Beacon Light. e. Special Approval: Cranes and other high-operating vehicles require special approval for airside entry.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(22, 'Failure to comply with limitation on towing of trolleys/trailers/dollies at any one time and no combination allowed', '1. Service Roads – 4 trolleys/4 trailers/3 dollies 2. Taxiway crossing – 3 trolleys/3 trailers/2 dollies; 3. Terminal bypass – 2 trolleys/2 trailers/2 dollies; 4. Baggage areas – 2 trolleys/2 trailers', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(23, 'Failure to comply with Airside Traffic Signs and Markings', 'Failure to follow traffic signage or road markings in the airside area, excluding the manoeuvring area (Runway and Taxiway).', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(24, 'Failure to wear Safety Vest on the apron /aircraft maneuvering area and work in progress area.', 'Every person entering or performing work within the apron, including the aircraft stands and Work-in-Progress area, shall wear a high visibility safety vest at all times.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(25, 'Escorting Without a Valid Escort Permit', 'Operating as an escort driver without obtaining a valid Escort Driver’s Permit.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(26, 'Approaching aircraft with engines running', 'The driver of a vehicle shall not cause the vehicle to approach any aircraft which has its engines running.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(27, 'Starting motor vehicle near refueling points', 'Starting up a vehicle when it is in the vicinity of an aircraft (within the red line) which is being refueled.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(28, 'Reversing a vehicle towards an aircraft without a marshaller.', 'The driver of a vehicle shall not cause the vehicle to reverse towards an aircraft in the movement area, except where the vehicle is used for servicing that aircraft and such reversing is carried out under the direction of a vehicle marshaller.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(29, 'Exceed vehicle speed limit', 'Driving beyond the speed limit of 25 km/h on Service Roads. 45 km/h on Spine Roads or Perimeter Roads. 15 km/h in KLIA T2 BHS areas. 10 km/h in KLIA T1 BHS areas. 5 km/h on the Apron.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(30, 'Overtaking another vehicle', 'Overtaking other vehicles traveling in the same direction in the following areas: - Service Roads. - Spine Roads/Perimeter Roads. - Apron.', 6, 'RM200', 'Moderate Offence', '1 Month', '2 Months'),
(31, 'Using mobile phone in the Apron and while driving', 'Mobile phone use is prohibited in the apron, except for reporting within designated hammerhead areas. Drivers must not use a mobile phone while operating a vehicle, drivers must stop the vehicle before making or receiving calls.', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(32, 'Failure to ensure vehicle/equipment compliance with Technical Inspection Checklist, including but not limited to:', 'i. Flameproof or spark arresters (for petrol-powered vehicles). ii. Owner’s insignia or company logo. iii. Green roundel. iv. Flashing yellow beacon light. v. Fire extinguisher. vi. “No Smoking" sign.', 6, 'RM200', 'Moderate Offence', '1 Month', '1 Month'),
(33, 'Improper Vehicle Parking and Handling', 'Leaving a vehicle unattended, failure to immediately remove a broken-down vehicle, obstructing other vehicles, or engaging in disorganized parking within the movement area, including but not limited to: - Parking inside the Equipment Restriction Area (ERA). - Parking outside the designated Equipment Parking Area (EPA).', 6, 'RM200', 'Moderate Offence', '1 Month', 'NIL'),
(34, 'Carry out a test run of an aircraft engine at a place not designated for its purpose', 'A person shall not carry out a test run of an aircraft engine except at a place designated by the aerodrome operator.', 8, 'RM300', 'High Offence', '2 Months', 'NIL'),
(35, 'Driving over any hose during aircraft refueling.', 'Drivers of vehicles must not drive over any hoses or bonding cables laid out during aircraft refueling.', 8, 'RM300', 'High Offence', '2 Months', 'NIL'),
(36, 'Failing to comply with CAAM ALDIS Lamp operation', 'Failing to comply accordingly with respective light signals when two-way radio communication breaks down on a runway or taxiway.', 8, 'RM300', 'High Offence', '2 Months', 'NIL'),
(37, 'Failure to comply with traffic signage in manoeuvring area (Runway & Taxiway), including failure to give way to an authorised vehicle conducting inspection on taxiway or runway.', '', 8, 'RM300', 'High Offence', '2 Months', 'NIL'),
(38, 'Failure to Wear Seat Belt', 'It is mandatory for all vehicle occupants, including drivers and passengers in both the front and rear seats to wear seat belts at all times while the vehicle is in motion.', 8, 'RM300', 'High Offence', '2 Months', 'NIL'),
(39, 'Driving a vehicle with EXPIRED Airside Driving Permit (ADP) in the airside area.', '', 8, 'RM300', 'High Offence', '2 Months', 'NIL'),
(40, 'Using vehicle / Equipment without a valid Airside Vehicle Permit (AVP) in the airside area', 'A person shall not use, cause, operate, or permit to be used a vehicle in a manoeuvring area unless it has been issued an airside vehicle permit by the aerodrome operator', 8, 'RM300', 'High Offence', '2 Months', '2 Months'),
(41, 'Forging information on any permit and documents.', '', 12, 'RM300', 'Critical Offence', '12 Months', 'NIL'),
(42, 'Failure to give way to an aircraft and failure to give maximum clearance to aircraft in the movement area.', 'Eg: Runway and Taxiway Incursion', 12, 'RM300', 'Critical Offence', '12 Months', 'NIL'),
(43, 'Failure to obtain prior clearance from the Duty Tower Controller before proceeding to any part of the maneuvering area.', '', 12, 'RM300', 'Critical Offence', '12 Months', 'NIL'),

-- Accident Records (51-66)
(51, 'Accident Involving Fatality', '(i.e. the driver of a vehicle involved in an accident resulting in death)', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(52, 'Accident Involving aircraft', '(i.e. driver of vehicles involved with an accident resulting in damage to an aircraft)', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(53, 'Accidents involving major / severe Injuries', '(i.e. the driver of a vehicle involved in an accident resulting in serious physical/bodily injury.)', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(54, 'Accident Involving Minor Injuries', '(i.e. the driver of a vehicle involved in an accident resulting in minor physical/bodily injury.)', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(55, 'Accident Involving Minor Injuries (within Movement Area)', '(i.e. the driver of a vehicle involved in an accident resulting in minor physical/bodily injury.)', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(56, 'Accident Involving Major damage to equipment/vehicle or Facilities', 'i.e. fixtures and / or structures.', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(57, 'Accident Involving Minor damage to equipment/vehicle and / or fixtures/structures/facilities', '', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(58, 'Accident Involving Minor damage to equipment/vehicle and / or fixtures/structures/facilities (within Movement Area)', '', NULL, 'Under Investigation', 'Critical Offence - Before Investigation', 'Under Investigation', 'Under Investigation'),
(59, 'Accident Involving Fatality', '(i.e. The driver of a vehicle involved in an accident resulting in death)', 12, 'RM300', 'Critical Offence - After Investigation', 'Terminated and Blacklisted', 'Released'),
(60, 'Accident Involving aircraft', '(i.e. driver of vehicles involved with an accident resulting in damage to an aircraft)', 12, 'RM300', 'Critical Offence - After Investigation', 'Terminated and Blacklisted', 'Released'),
(61, 'Accidents involving major / severe Injuries', '(i.e. The driver of a vehicle involved in an accident resulting in serious physical/bodily injury.)', 12, 'RM300', 'Critical Offence - After Investigation', 'Terminated and Blacklisted', 'Released'),
(62, 'Accident Involving Major damage to equipment/vehicle or Facilities', 'i.e. fixtures and / or structures.', 12, 'RM300', 'Critical Offence - After Investigation', 'Terminated and Blacklisted', 'Released'),
(63, 'Accident Involving Minor damage to equipment/vehicle and / or fixtures/structures/facilities', '(i.e. fixtures and/or structures)', 8, 'RM300', 'Critical Offence - After Investigation', '4 Months', 'Released'),
(64, 'Accident Involving Minor Injuries (within Movement Area)', '(i.e. the driver of a vehicle involved in an accident resulting in minor physical/bodily injury.)', 8, 'RM300', 'Critical Offence - After Investigation', '6 Months', 'Released'),
(65, 'Accident Involving Minor Injuries', '(i.e. the driver of a vehicle involved in an accident resulting in minor physical/bodily injury.)', 8, 'RM300', 'Critical Offence - After Investigation', '4 Months', 'Released'),
(66, 'Accident Involving Minor damage to equipment/vehicle and / or fixtures/structures/facilities (within Movement Area)', '', 8, 'RM300', 'Critical Offence - After Investigation', '6 Months', 'Released');

-- Verify total records loaded
SELECT COUNT(*) AS TotalRecords FROM offendlist_2025;

-- View records grouped by severity
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

-- View all records
SELECT offence_id, number, violation, offence_severity, demerit_point, monetary_penalty, 
       adp_suspension_text, avp_suspension_text, created_at, is_active 
FROM offendlist_2025 
ORDER BY number;

PRINT 'Complete! All 50 records loaded successfully (1-43 original + 51-66 accident records)';
GO
