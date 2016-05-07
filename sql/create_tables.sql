-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY,
  username varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Kohde(
  id SERIAL PRIMARY KEY,
  owner_id INTEGER REFERENCES Kayttaja(id) NOT NULL,
  name varchar(50) NOT NULL,
  description varchar(400) NOT NULL,
  offer_wanted varchar(400),
  status varchar(50),
  added DATE
);

CREATE TABLE Tarjous(
  id SERIAL PRIMARY KEY,
  sender_id INTEGER REFERENCES Kayttaja(id),
  reciever_id INTEGER REFERENCES Kayttaja(id),
  item_id INTEGER REFERENCES Kohde(id) ON DELETE CASCADE,
  message varchar(400),
  offer_type varchar(50),
  sent DATE
);

CREATE TABLE Tunniste(
  id SERIAL PRIMARY KEY,
  tag varchar(400) NOT NULL
);

CREATE TABLE Tunniste_kohde(
    item_id int REFERENCES Kohde(id) ON UPDATE CASCADE ON DELETE CASCADE,
    tag_id int REFERENCES Tunniste(id) ON UPDATE CASCADE,
    CONSTRAINT item_tag_key PRIMARY KEY (item_id, tag_id)
);