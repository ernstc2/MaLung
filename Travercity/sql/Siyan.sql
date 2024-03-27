CREATE TABLE accounts (
    userid int AUTO_INCREMENT NOT NULL,
    pw varchar(255) NOT NULL,
    displayname varchar(20),
    pronouns varchar(10),
    country varchar(15),
    email varchar(255),
    PRIMARY KEY (userid)
);

CREATE TABLE travel_log_entries (
    entryid int AUTO_INCREMENT,
    userid int,
    title varchar(255),
    content MEDIUMTEXT,
    created timestamp,
    PRIMARY KEY (entryid),
    FOREIGN KEY (userid) REFERENCES accounts(userid)
);

CREATE TABLE travel_log_images (
    imageid int AUTO_INCREMENT,
    entryid int,
    fn varchar(255),
    PRIMARY KEY (imageid),
    FOREIGN KEY (entryid) REFERENCES travel_log_entries(entryid)
);