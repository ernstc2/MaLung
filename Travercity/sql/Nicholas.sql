CREATE DATABASE WebSys;

CREATE TABLE WebSys.countries (
    ID INT AUTO_INCREMENT,
    name VARCHAR(255),
    bannerImage VARCHAR(255),
    FlagImage VARCHAR(255),
    PRIMARY KEY (ID)
);

INSERT INTO WebSys.countries (name, bannerImage, FlagImage) VALUES
    ('United States', 'US.png', 'US.png'),
    ('Canada', 'Canada.png', 'Canada.png'),
    ('United Kingdom', 'UK.png', 'UK.png'),
    ('France', 'France.png', 'France.png'),
    ('Germany', 'Germany.png', 'Germany.png');

CREATE TABLE WebSys.activities (
    ID INT AUTO_INCREMENT,
    country_id INT,
    activity_type VARCHAR(255),
    filename VARCHAR(255),
    PRIMARY KEY (ID),
    FOREIGN KEY (country_id) REFERENCES WebSys.countries(ID)
);

INSERT INTO WebSys.activities (country_id, activity_type, filename) VALUES
    (2, 'Skiing', 'test'),
    (3, 'Sightseeing', 'test'),
    (4, 'Cultural Event', 'test'),
    (5, 'Rafting', 'test'),
    (1, 'Home', 'USBasicInfo'),
    (1, 'Home', 'us_homeWhyCome'),
    (1, 'Home', 'us_home_food'),
    (1, 'Landmark', 'us_landmark_sol'),
    (1, 'Landmark', 'us_landmark_TimesSquare'),
    (1, 'Landmark', 'us_landmark_Lincoln'),
    (1, 'Food', 'us_food_Ghirardelli'),
    (1, 'Food', 'us_food_StarBucks'),
    (1, 'Food', 'us_food_BenJerry'),
    (1, 'Beach', 'us_beaches'),
    (1, 'Hiking', 'us_hikingTrails'),
    (4, 'Carnival', 'France_Carnival'),
    (4, 'Food', 'France_food'),
    (4, 'Home', 'explore_country_fr');


-- NOT MINE

CREATE TABLE accounts (
    userid int AUTO_INCREMENT NOT NULL,
    username varchar(20),
    pw varchar(255),
    displayname varchar(20),
    pronouns varchar(10),
    country varchar(15),
    email varchar(255),
    PRIMARY KEY (userid)
);

CREATE TABLE `Posts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CountryID` int(11) NOT NULL,
  `ActivityID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Content` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci