-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY,
  username varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Kohde(
  id SERIAL PRIMARY KEY,
  owner_id INTEGER REFERENCES Kayttaja(id),
  name varchar(50) NOT NULL,
  description varchar(400),
  offer_wanted varchar(400),
  status varchar(50),
  added DATE
);

CREATE TABLE Tarjous(
  id SERIAL PRIMARY KEY,
  sender_id INTEGER REFERENCES Kayttaja(id),
  reciever_id INTEGER REFERENCES Kayttaja(id),
  item_id INTEGER REFERENCES Kohde(id),
  description varchar(400),
  offer_type varchar(50),
  sent DATE
);