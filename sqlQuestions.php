DATABASES AND SQL

QUESTION 1
SELECT MAX(salary) FROM emp WHERE salary < (SELECT MAX(salary) FROM emp);

QUESTION 2
SELECT country FROM city INNER JOIN games ON city.name = games.city;

QUESTION 3
LEFT JOIN: The LEFT JOIN keyword returns all records from the games table, and the matching records from the city table. 
The result is 0 records from the right side, if there is no match.
The LEFT JOIN keyword returns all records from the games, even if there are no matches in the city table.

Example: The query below will return all the years in the games table and the matching records which is the country that hosted the game and 
return null for the country column for the year that does not have a matching record.
SELECT games.year, city.country FROM games LEFT JOIN city ON games.city=city.name ORDER BY games.year;

RIGHT JOIN: The RIGHT JOIN keyword returns all records from the city table, and the matching records from the games table. 
The result is 0 records from the right side, if there is no match.
The RIGHT JOIN keyword returns all records from the left table games, even if there are no matches in the city.

Example: The query below will return all the countries in the city table and the matching records which is the year of the game and 
return null for the year column that does not have a matching record.
SELECT games.year, city.country FROM games RIGHT JOIN city ON games.city=city.name ORDER BY games.year;
<!-- SELECT city.country, games.year FROM city RIGHT JOIN games ON city.name=games.city ORDER BY city.country; -->

QUESTION 4
SELECT userId as UserId, AVG(duration) DIV 1 as AverageDuration FROM `sessions` GROUP BY userId HAVING COUNT(*)>1;