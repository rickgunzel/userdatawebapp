CREATE DATABASE mod4;

USE mod4;

CREATE TABLE IF NOT EXISTS customers (
	custId int(11) NOT NULL AUTO_INCREMENT,
	firstname VARCHAR(20) NOT NULL,
	lastname VARCHAR(20) NOT NULL,
	username VARCHAR(20) NOT NULL,
	pass CHAR(40) NOT NULL,
	address VARCHAR(40) NOT NULL,
	city VARCHAR(30) NOT NULL,
	state VARCHAR(2) NOT NULL,
	zip VARCHAR(5) NOT NULL,
	PRIMARY KEY (custId)
);

INSERT INTO customers (firstname, lastname, username, pass, address, city, state, zip) VALUES
('Denise', 'Johnston', 'denise', SHA1('esined'), '2029 Denis Sqr.', 'Romanoke', "WV", '24011'),
('Luke', 'Johansen', 'luke', SHA1('ekul'), '2125 Dartmoth St.', 'Randolf', 'WV', '24023'),
('Jacob', 'Johonsen', 'jacob', SHA1('bocaj'), '7131 Kirk Ave.', 'Clockford', 'WV', '24085'),
('VWCC', 'Itp225', 'itp225', SHA1('itp225'), '7131 Colonial Ave.', 'Roanoke', 'VA', '24015'),
('Mickey', 'Mouse', 'mickey', SHA1('mouse'), '7233 Disney Ave.', 'Disneyland', 'FL', '24085'),
('Donald', 'Duck', 'donald', SHA1('duck'), '131 Quacker St.', 'Disneyland', 'FL', '24085'),
('Minni', 'Mouse', 'minni', SHA1('mouse'), '761 Disney Ln.', 'Disneyland', 'FL', '24085'),
('Goofy', 'Guff', 'goofy', SHA1('goof'), '837 Kennel Ave.', 'Disneyland', 'FL', '24085'),
('Huey', 'Duck', 'huey', SHA1('duck'), '431 McQuack St.', 'Disneyland', 'FL', '24085'),
('Dewey', 'Duck', 'dewey', SHA1('duck'), '431 McQuack St.', 'Disneyland', 'FL', '24085'),
('Louie', 'Duck', 'louie', SHA1('duck'), '431 McQuack St.', 'Disneyland', 'FL', '24085'),
('Daisy', 'Duck', 'daisy', SHA1('duck'), '7131 McQuack Ave.', 'Disneyland', 'FL', '24085'),
('Eeyore', 'Donkey', 'eeyore', SHA1('donkey'), '71 Kicks Ave.', 'Disneyland', 'FL', '24085'),
('Lance', 'Armstrong', 'lance', SHA1('bikes'), '7131 Biken St.', 'Dallas', 'TX', '24085'),
('Hannah', 'Johnstony', 'hannah', SHA1('nahhan'), '982 Park St.', 'Roland', 'WV', '24032');
#End of File
