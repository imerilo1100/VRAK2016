CREATE TABLE IF NOT EXISTS PERSON (
id SERIAL PRIMARY KEY NOT NULL,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
username VARCHAR(30) NOT NULL,
email VARCHAR(30) NOT NULL,
password VARCHAR(100) NOT NULL
)

CREATE TABLE IF NOT EXISTS CANDIDATE (
id SERIAL PRIMARY KEY NOT NULL,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
votenumber INT NOT NULL,
votes INT DEFAULT 0,
voting INT NOT NULL
)

CREATE TABLE IF NOT EXISTS VOTING (
id SERIAL PRIMARY KEY NOT NULL,
title VARCHAR(100) NOT NULL,
person INT NOT NULL,
start_date TIMESTAMP NOT NULL,
finish_date TIMESTAMP NOT NULL
)

CREATE TABLE IF NOT EXISTS VOTED (
id SERIAL PRIMARY KEY NOT NULL,
person INT NOT NULL,
voting INT NOT NULL,
vote BOOLEAN NOT NULL
)

CREATE FUNCTION sumOfCandidates(vote integer)
RETURNS integer AS $total$
declare
	total integer;
        vote integer;
BEGIN
   SELECT COUNT(*) into total FROM candidate WHERE voting = vote;
   RETURN total;
END;
$total$ LANGUAGE plpgsql;

CREATE FUNCTION sumOfVotes(vote integer)
RETURNS integer AS $total$
declare
	total integer;
        vote integer;
BEGIN
   SELECT SUM(votes) into total FROM candidate WHERE voting = vote;
   RETURN total;
END;
$total$ LANGUAGE plpgsql;