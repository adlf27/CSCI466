#list owner last and first name wih the name and type of their boat
SELECT Owner.LastName, Owner.FirstName, MarinaSlip.BoatName, MarinaSlip.BoatType FROM Owner INNER JOIN MarinaSlip ON MarinaSlip.OwnerNum = Owner.OwnerNum ORDER BY LastName;

#list all owners who have more than one boat and amount they have
SELECT Owner.FirstName, COUNT(*) NumOfBoats FROM Owner INNER JOIN MarinaSlip
 ON MarinaSlip.OwnerNum = Owner.OwnerNum GROUP BY LastName HAVING COUNT(*) > 1;

#list description of the request and owner last name
SELECT Owner.LastName, ServiceRequest.Description FROM(( Owner INNER JOIN MarinaSlip ON Owner.OwnerNum = MarinaSlip.OwnerNum) INNER JOIN ServiceRequest ON MarinaSlip.SlipID = ServiceRequest.SlipID);

#list category description and count of each request
SELECT ServiceCategory.CategoryDescription, COUNT(*) NumRequest FROM ServiceCategory INNER JOIN ServiceRequest ON ServiceCategory.CategoryNum = ServiceRequest.CategoryNum GROUP BY SlipID;

#List all owners info and name of baot location in alphabatic order of city
SELECT Owner.FirstName, Owner.LastName, Owner.City, Owner.State, Marina.Name FROM(( Owner INNER JOIN MarinaSlip ON Owner.OwnerNum = MarinaSlip.OwnerNum) INNER JOIN Marina ON MarinaSlip.MarinaNum = Marina.MarinaNum) ORDER BY City;

#total rental fee amount for each Marina
SELECT Marina.Name, SUM(MarinaSlip.RentalFee) Amount FROM Marina INNER JOIN MarinaSlip ON Marina.MarinaNum = MarinaSlip.MarinaNum GROUP BY Marina.Name;

#list the estimated hours, spent hours and the difference of each service requested
SELECT ServiceID AS ID, EstHours AS HoursSaid, SpentHours AS HoursWorked, (EstHours - SpentHours) AS Difference FROM ServiceRequest;

#list last name of owner of boat 30 feet or shorter
SELECT Owner.LastName, MarinaSlip.BoatName FROM Owner INNER JOIN MarinaSlip ON Owner.OwnerNum = MarinaSlip.OwnerNum WHERE MarinaSlip.Length <= 30;

#list the name and the next service date
SELECT  MarinaSlip.BoatName, ServiceRequest.NextServiceDate FROM MarinaSlip INNER JOIN ServiceRequest ON MarinaSlip.SlipID = ServiceRequest.SlipID;

#list boat name, owner last name, the slip number and marina name in alphabetice order
SELECT MarinaSlip.BoatName, Owner.LastName, MarinaSlip.SlipNUm, Marina.Name FROM((Owner INNER JOIN MarinaSlip ON Owner.OwnerNum = MarinaSlip.OwnerNum) INNER JOIN Marina ON MarinaSlip.MarinaNum = Marina.MarinaNum) ORDER BY MarinaSlip.BoatName, Marina.Name;

