create database valimised;

CREATE TABLE IF NOT EXISTS PERSON (
	id SERIAL PRIMARY KEY   NOT NULL,
	firstname VARCHAR(256)  NOT NULL,
	lastname  VARCHAR(256)  NOT NULL,
	email     VARCHAR(256)  NOT NULL
);

CREATE TABLE IF NOT EXISTS USER_AUTH (
	pid INT UNIQUE NOT NULL,
	username VARCHAR(256) NOT NULL,
	salt VARCHAR(256) NOT NULL,
	hash VARCHAR(256) NOT NULL
);

CREATE TABLE IF NOT EXISTS CANDIDATE (
	id SERIAL PRIMARY KEY NOT NULL,
	firstname VARCHAR(256) NOT NULL,
	lastname VARCHAR(256) NOT NULL,
	party VARCHAR(256)
);

CREATE TABLE IF NOT EXISTS ELECTION (
	id SERIAL PRIMARY KEY NOT NULL,
	title VARCHAR(100) NOT NULL,
	start_date TIMESTAMP NOT NULL,
	finish_date TIMESTAMP NOT NULL
);

CREATE TABLE IF NOT EXISTS VOTE (
	time TIMESTAMP NOT NULL DEFAULT current_timestamp,
	pid INT NOT NULL,
	eid INT NOT NULL, 
	cid INT NOT NULL,
	UNIQUE (pid, eid)
);

CREATE TABLE IF NOT EXISTS CANDIDATE_LIST (
	cid INT NOT NULL,
	eid INT NOT NULL,
	UNIQUE (cid, eid)
);

CREATE VIEW 

--Testinfo.
INSERT INTO PERSON (firstname, lastname, email) VALUES('Mari', 'Maasikas', 'marimaasik@mail.ee'); 
INSERT INTO PERSON (firstname, lastname, email) VALUES('Kadri', 'Kaalikas', 'kardrik@mail.ee'); 
INSERT INTO PERSON (firstname, lastname, email) VALUES('Test', 'Kasutaja', 'test@test.ee'); 
INSERT INTO USER_AUTH (pid, username, salt, hash) VALUES(3, 'testuser', 'ntdT67n1xX9ŧ', '35b76d00ea130cd8e4f36062dac18ac3f9f77209c2f8746bfff26b7d9b1af0947947ad6579c5fd49e62e4c0264378c5e0f9f05d411163af0b3f33e497c0a3a2d'); 
INSERT INTO CANDIDATE (firstname, lastname, party) VALUES('Mari', 'Maasikas', 'Kollased'); 
INSERT INTO CANDIDATE (firstname, lastname, party) VALUES('Kadri', 'Kaalikas', 'Täpilised'); 
INSERT INTO CANDIDATE (firstname, lastname, party) VALUES('Mart', 'Murakas', 'Oranžid'); 
INSERT INTO CANDIDATE (firstname, lastname, party) VALUES('Kert', 'Karusmari', 'Lapilised'); 
INSERT INTO CANDIDATE (firstname, lastname, party) VALUES('Siim', 'Savi', 'Keskealised'); 
INSERT INTO CANDIDATE (firstname, lastname, party) VALUES('Jüri', 'Õiglane', 'Vasakpoolsed'); 
INSERT INTO ELECTION (title, start_date, finish_date) VALUES('KOV valimised', '2016-03-01', '2016-05-01'); 
INSERT INTO ELECTION (title, start_date, finish_date) VALUES('Riigikogu valimised', '2016-04-01', '2016-05-01'); 
INSERT INTO ELECTION (title, start_date, finish_date) VALUES('Presidendi valimised', '2016-01-01', '2016-02-01');
INSERT INTO ELECTION (title, start_date, finish_date) VALUES('Tulevased valimised', '2016-06-01', '2016-08-01'); 

