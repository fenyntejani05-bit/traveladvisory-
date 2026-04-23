ALTER TABLE `tours` 
ADD COLUMN `climate` VARCHAR(50) DEFAULT NULL,
ADD COLUMN `budget` VARCHAR(50) DEFAULT NULL,
ADD COLUMN `activity` VARCHAR(50) DEFAULT NULL;

UPDATE `tours` SET climate='Tropical', budget='Low', activity='Relaxing' WHERE id=1;
UPDATE `tours` SET climate='Moderate', budget='Low', activity='Adventure' WHERE id=3;
UPDATE `tours` SET climate='Moderate', budget='Medium', activity='Heritage' WHERE id=6;
UPDATE `tours` SET climate='Tropical', budget='High', activity='Relaxing' WHERE id=7;
UPDATE `tours` SET climate='Moderate', budget='Medium', activity='Heritage' WHERE id=8;
UPDATE `tours` SET climate='Tropical', budget='High', activity='Relaxing' WHERE id=9;
UPDATE `tours` SET climate='Tropical', budget='Low', activity='Heritage' WHERE id=10;
UPDATE `tours` SET climate='Cold', budget='High', activity='Adventure' WHERE id=11;
UPDATE `tours` SET climate='Moderate', budget='Medium', activity='Wildlife' WHERE id=12;
UPDATE `tours` SET climate='Moderate', budget='Low', activity='Adventure' WHERE id=13;
UPDATE `tours` SET climate='Moderate', budget='High', activity='Heritage' WHERE id=14;
UPDATE `tours` SET climate='Moderate', budget='Medium', activity='Relaxing' WHERE id=15;
UPDATE `tours` SET climate='Tropical', budget='High', activity='Relaxing' WHERE id=16;
UPDATE `tours` SET climate='Tropical', budget='Low', activity='Heritage' WHERE id=17;
UPDATE `tours` SET climate='Cold', budget='Medium', activity='Relaxing' WHERE id=18;
UPDATE `tours` SET climate='Cold', budget='Medium', activity='Adventure' WHERE id=19;
UPDATE `tours` SET climate='Cold', budget='Medium', activity='Relaxing' WHERE id=20;
