#removes tables from database if they exist
DROP TABLE if exists Owner;
DROP TABLE if exists Pet;

#create a table named owner with 3 attributes 
CREATE TABLE Owner
(OwnerID int auto_increment PRIMARY KEY,
 FirstName CHAR(50),
 LastName CHAR(20));

#inserts 5 values into the the Owner table
INSERT INTO Owner
(FirstName, LastName) VALUES
('Jon', 'Snow'),
('Arya', 'Stark'),
('Bran', 'Stark'),
('Jaime', 'Lannister'),
('Tyrion', 'Lannister');

#select statement to dislpay the owner table
SELECT * FROM Owner;

#creates a table named pet with 4 atrributes
CREATE TABLE Pet
(PetID int auto_increment PRIMARY KEY,
 OwnerID int,
 PetName char(50),
 PetDOB char(10),
 FOREIGN key (OwnerID) references Owner(OwnerID));

#inserts 6 values into the pet table
INSERT INTO Pet
(PetName, PetDOB, OwnerID) VALUES
('Drogon', '03/21/12', 1),
('Sansa', '07/21/15', 5),
('Dany', '12/30/00', 1),
('Ned', '01/03/17', 2),
('Robb', '02/22/18', 3),
('Joffrey', '09/5/11', 4);

#select statement to display the content in pet
SELECT * FROM Pet;

#add a coulum(PetType) to the pet table
ALTER TABLE Pet ADD PetType char(50);

#sets the values in pet accordingly to the pet type
UPDATE Pet SET PetType = 'Dog' WHERE PetID = 1;
UPDATE Pet SET PetType = 'Dragon' WHERE PetID = 3;
UPDATE Pet SET PetType = 'Direwolf' WHERE PetID = 2;
UPDATE Pet SET PetType = 'Cat' WHERE PetID = 4;
UPDATE Pet SET PetType = 'Fish' WHERE PetID = 5;

#cannot change data type with alter column. getting error 1064 (4200)
#will delete column and make a new one
ALTER TABLE Pet DROP COLUMN PetDOB;
ALTER TABLE Pet ADD PetDOB date;

#select satement to display pet table
SELECT * FROM  Pet;

#create view to show Owner name and pet name in a table
CREATE VIEW PetView AS SELECT Owner.FirstName, Owner.LastName, Pet.PetName FROM Owner INNER JOIN Pet ON Owner.OwnerID = Pet.OwnerID;

#select satement to display petview
SELECT * FROM PetView;
