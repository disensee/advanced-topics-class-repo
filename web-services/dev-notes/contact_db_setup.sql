-- create a database called adv_topics then run the following sql statements in the adv_topics database

DROP TABLE IF EXISTS contacts;
CREATE TABLE IF NOT EXISTS contacts (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  firstName varchar(30) NOT NULL,
  lastName varchar(30) NOT NULL,
  email varchar(255) NOT NULL,
  phone varchar(20) NOT NULL
) ENGINE=InnoDB;


INSERT INTO contacts (firstName, lastName, email, phone) VALUES
("Bob", "Smith", "bob@smith.com", "555-555-5555"),
("Sally", "Jones", "sally@jones.com", "554-555-5554"),
("Gordy", "Howely", "g@h.com", "655-555-5556");