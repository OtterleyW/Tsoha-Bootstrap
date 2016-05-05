-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Kayttaja-taulun testidata
INSERT INTO Kayttaja (username, email, password) VALUES ('Kalle Keräilijä', 'kkeraaja@email.com', 'Keräilijä1');
INSERT INTO Kayttaja (username, email, password) VALUES ('Hanna Hamstraaja', 'hhamstraaja@email.com', 'Hamstraaja1');
INSERT INTO Kayttaja (username, email, password) VALUES ('Veikko Valitsija', 'vvalitsija@email.com', 'Valitsija1');
INSERT INTO Kayttaja (username, email, password) VALUES ('Kaisa Katselija', 'kkatselija@email.com', 'Katselija1');

-- Kohde-taulun testidata

INSERT INTO Kohde (owner_id, name, description, added) VALUES ('1', 'Kolikko', 'Hieno kiiltävä kolikko', NOW());
INSERT INTO Kohde (owner_id, name, description, offer_wanted, added) VALUES ('2', 'Maljakko', 'Hieno kiiltävä maljakko', 'Harvinainen postimerkki', NOW());
INSERT INTO Kohde (owner_id, name, description, offer_wanted, added) VALUES ('3', 'Postimerkki', 'Harvinainen postimerkki', 'Vanhat valokuvat', NOW());
INSERT INTO Kohde (owner_id, name, description, added) VALUES ('2', 'Astiasto', 'Vanha ja pölyinen', NOW());
INSERT INTO Kohde (owner_id, name, description, offer_wanted, added) VALUES ('3', 'Postikortti', 'Aivan antiikkia', 'Harvinainen postimerkki', NOW());
INSERT INTO Kohde (owner_id, name, description, added) VALUES ('1', 'Jääkiekkomaila', 'Urheiluväline', NOW());

-- Tarjous-taulun testidata

INSERT INTO Tarjous (sender_id, reciever_id, item_id, message, offer_type, sent) VALUES ('2','1','1','Tämä on hieno tarjous','avoin',NOW());
INSERT INTO Tarjous (sender_id, reciever_id, item_id, message, offer_type, sent) VALUES ('1','2','2','Tämä on hieno toinen tarjous','avoin',NOW());
INSERT INTO Tarjous (sender_id, reciever_id, item_id, message, offer_type, sent) VALUES ('1','3','3','Tämä on hieno kolmas tarjous','avoin',NOW());
INSERT INTO Tarjous (sender_id, reciever_id, item_id, message, offer_type, sent) VALUES ('3','1','1','Tämä on hieno neljäs tarjous','avoin',NOW());
INSERT INTO Tarjous (sender_id, reciever_id, item_id, message, offer_type, sent) VALUES ('1','3','5','Tämä on hieno neljäs tarjous','avoin',NOW());
