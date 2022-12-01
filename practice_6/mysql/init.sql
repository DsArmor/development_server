CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS student (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    book VARCHAR(200) NOT NULL,
    PRIMARY KEY (ID)
    );

CREATE TABLE IF NOT EXISTS book (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    name TEXT NOT NULL,
    author TEXT NOT NULL,
    PRIMARY KEY (ID)
    );

CREATE TABLE IF NOT EXISTS auth (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    login VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY(ID)
);

INSERT INTO auth (login, password)
VALUES ('login', '{SHA}W6ph5Mm5Pz8GgiULbPgzG37mj9g=');

INSERT INTO student (name, book)
VALUES
    ('Dima', 'Moby Dick'),
    ('Dan', 'Brave New World'),
    ('Ola', '1984'),
    ('Curl', 'We'),
    ('Polya', 'For whom the Bell Tolls');

INSERT INTO book (name, author)
VALUES
    ('Moby Dick', 'Herman Melville'),
    ('Brave New World', 'Aldous Huxley'),
    ('1984', 'George Orwell'),
    ('We', 'Yevgeny Zamyatin'),
    ('For whom the Bell Tolls', 'Ernest Hemingway');


-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Alex', 'Rover') AS tmp
-- WHERE NOT EXISTS (
--         SELECT name FROM users WHERE name = 'Alex' AND surname = 'Rover'
--     ) LIMIT 1;
--
-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Bob', 'Marley') AS tmp
-- WHERE NOT EXISTS (
--         SELECT name FROM users WHERE name = 'Bob' AND surname = 'Marley'
--     ) LIMIT 1;
--
-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Alex', 'Rover') AS tmp
-- WHERE NOT EXISTS (
--         SELECT name FROM users WHERE name = 'Alex' AND surname = 'Rover'
--     ) LIMIT 1;
--
-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Kate', 'Yandson') AS tmp
-- WHERE NOT EXISTS (
--         SELECT name FROM users WHERE name = 'Kate' AND surname = 'Yandson'
--     ) LIMIT 1;
--
-- INSERT INTO users (name, surname)
-- SELECT * FROM (SELECT 'Lilo', 'Black') AS tmp
-- WHERE NOT EXISTS (
--         SELECT name FROM users WHERE name = 'Lilo' AND surname = 'Black'
--     ) LIMIT 1;