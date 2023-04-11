CREATE TABLE `photoalbum`.`photo_metadata` ( 
    `Photo title` VARCHAR(255) NOT NULL , 
    `Description` VARCHAR(255) NOT NULL , 
    `Creation date` DATE NOT NULL , 
    `Keywords` VARCHAR(255) NOT NULL , 
    `Reference to the photo object in S3` 
    VARCHAR(255) NOT NULL 
) ENGINE = InnoDB;

-- populate
INSERT INTO `photoalbum`.`photo_metadata` 
(`Photo title`, `Description`, `Creation date`, `Keywords`,
`Reference to the photo object in S3`)
VALUES 
('Photo 1', 'Description 1', '2018-01-01', 'Keyword 1', 's3://assignment1b-bucket/photo1.jpg'),
('Photo 2', 'Description 2', '2018-01-02', 'Keyword 2', 's3://assignment1b-bucket/photo2.jpg'),
('Photo 3', 'Description 3', '2018-01-03', 'Keyword 3', 's3://assignment1b-bucket/photo3.jpg'),
('Photo 4', 'Description 4', '2018-01-04', 'Keyword 4', 's3://assignment1b-bucket/photo4.jpg'),
('Photo 5', 'Description 5', '2018-01-05', 'Keyword 5', 's3://assignment1b-bucket/photo5.jpg'),
('Photo 6', 'Description 6', '2018-01-06', 'Keyword 6', 's3://assignment1b-bucket/photo6.jpg'),
('Photo 7', 'Description 7', '2018-01-07', 'Keyword 7', 's3://assignment1b-bucket/photo7.jpg'),
('Photo 8', 'Description 8', '2018-01-08', 'Keyword 8', 's3://assignment1b-bucket/photo8.jpg'),
('Photo 9', 'Description 9', '2018-01-09', 'Keyword 9', 's3://assignment1b-bucket/photo9.jpg'),
('Photo 10', 'Description 10', '2018-01-10', 'Keyword 10', 's3://assignment1b-bucket/photo10.jpg');