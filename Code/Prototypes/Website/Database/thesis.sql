CREATE SCHEMA IF NOT EXISTS `thesis`;

USE `thesis`;

CREATE TABLE IF NOT EXISTS `master`(
    timecode DATETIME NOT NULL,
    temperature VARCHAR(11),
    humidity VARCHAR(11),
    co2 VARCHAR(11),
    ph VARCHAR(11),
    ppm VARCHAR(11),
    PRIMARY KEY (timecode)
);

INSERT INTO master VALUES ('2023-04-04 00:05:00', 2, 3, 4, 5, 6);

INSERT INTO master VALUES (CURTIME(), 3, 4, 5, 6, 7);

SELECT * FROM master WHERE timecode >= '2023-04-04 00:00:00' AND timecode < '2023-04-05 00:00:00';

SELECT * FROM master WHERE timecode >= '2023-04-03 10:48:48' AND timecode < '2023-04-03 10:48:48';

SELECT * FROM master WHERE timecode >= '2023-04-03 15:58:38' AND timecode < '2023-04-04 15:58:38';

INSERT INTO master VALUES(CURTIME(), $temperature, $humidity, $co2, $ph, $ppm);

TRUNCATE TABLE master;