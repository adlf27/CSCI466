#Luis Aguinaga
#z1811673
#Section 4

# shows all the databases in the directory
SHOW TABLES;

#chooses what database to use
USE BabyName;

# shows all the information in the database 
DESCRIBE BabyName;

#shows all the years where my name luis appears
SELECT DISTINCT name, year FROM BabyName WHERE name = 'Luis' limit 50;

#shows all the name appearing in my birth year 1994
SELECT DISTINCT name, year FROM BabyName WHERE year = 1994 limit 50;

#shows most popular male name from year 1994
SELECT name, gender, COUNT(*) FROM BabyName WHERE year = 1994 and gender = 'M'
GROUP BY name HAVING COUNT(*) > 1 ORDER BY COUNT(*) DESC limit 50;

#show most popular female name form year 1994
SELECT name, gender, COUNT(*) FROM BabyName WHERE year = 1994 and gender = 'F' 
GROUP BY name HAVING COUNT(*) > 1 ORDER BY COUNT(*) DESC LIMIT 50;

#shows info of names that similar to mine luis 
SELECT name, gender, year, place FROM BabyName WHERE name LIKE 'LUI%' limit 50;

#gets the number of all the rows
SELECT COUNT(*) FROM BabyName;

#count how many names are there in the year 1960
SELECT year, COUNT(*) FROM BabyName WHERE year = 1960 GROUP BY year;

#show how many male and female names are there in year 1956
SELECT year, gender, COUNT(*) FROM BabyName WHERE year = 1956 GROUP BY gender;

#list how many names are there n each place
SELECT place, COUNT(*) FROM BabyName GROUP BY place;

