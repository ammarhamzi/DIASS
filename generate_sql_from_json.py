import json

# Read the JSON file
with open('new_offense.json', 'r', encoding='utf-8') as f:
    data = json.load(f)

print(f"Loaded {len(data)} records")

# Create SQL script
sql_content = """-- ========================================
-- Load Offense Data into offendlist_2025 (COMPLETE VERSION - ALL 50 RECORDS)
-- SQL Server Management Studio (SSMS)
-- Includes all 43 original offenses + 16 new accident-related offenses
-- ========================================

USE [your_database_name]; -- CHANGE THIS to your actual database name
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

-- If you already have data in offendlist_2025, uncomment the line below
-- DELETE FROM offendlist_2025;
-- GO

-- Insert all records
INSERT INTO offendlist_2025 (number, violation, description, demerit_point, monetary_penalty, offence_severity, adp_suspension_text, avp_suspension_text)
VALUES
"""

# Add each record
for i, record in enumerate(data):
    # Escape single quotes in strings
    violation = record['violation'].replace("'", "''")
    description = record['description'].replace("'", "''") if record['description'] else ''
    
    demerit_point = record['demerit_point'] if record['demerit_point'] is not None else 'NULL'
    monetary_penalty = record['monetary_penalty'].replace("'", "''")
    offence_severity = record['offence_type'].replace("'", "''")
    adp_suspension_text = record['adp_suspension_period'].replace("'", "''")
    avp_suspension_text = record['avp_suspension_period'].replace("'", "''")
    
    sql_content += f"({record['number']}, '{violation}', '{description}', {demerit_point}, '{monetary_penalty}', '{offence_severity}', '{adp_suspension_text}', '{avp_suspension_text}')"
    
    if i < len(data) - 1:
        sql_content += ",\n"
    else:
        sql_content += ";\n\n"

# Add verification
sql_content += """-- Verify total records loaded
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

PRINT 'čcomplete!';
GO
"""

# Write to file
with open('load_all_offenses_complete.sql', 'w', encoding='utf-8') as f:
    f.write(sql_content)

print(f"SQL file created: load_all_offenses_complete.sql with {len(data)} records")

