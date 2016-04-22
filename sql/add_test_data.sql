-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Kayttaja-taulun testidata
INSERT INTO Kayttaja (username, email, password) VALUES ('Kalle Keräilijä', 'kkeraaja@email.com', 'Keräilijä1');
INSERT INTO Kayttaja (username, email, password) VALUES ('Hanna Hamstaaja', 'hhamstraaja@email.com', 'Hamstraaja1');
INSERT INTO Kayttaja (username, email, password) VALUES ('Veikko Valitsija', 'vvalitsija@email.com', 'Valitsija1');
INSERT INTO Kayttaja (username, email, password) VALUES ('Kaisa Katselija', 'kkatselija@email.com', 'Katselija1');

-- Kohde-taulun testidata

INSERT INTO Kohde (owner_id, name, description, status, added) VALUES ('1', 'Kolikko', 'Hieno kiiltävä kolikko', 'avoinna', NOW());
INSERT INTO Kohde (owner_id, name, description, offer_wanted, status, added) VALUES ('2', 'Maljakko', 'Hieno kiiltävä maljakko', 'Harvinainen postimerkki', 'avoinna', NOW());
INSERT INTO Kohde (owner_id, name, description, offer_wanted, status, added) VALUES ('3', 'Postimerkki', 'Harvinainen postimerkki', 'Vanhat valokuvat', 'avoinna', NOW());


-- Tarjous-taulun testidata

INSERT INTO Tarjous (sender_id, reciever_id, item_id, message, offer_type, sent) VALUES ('1','2','1','Tämä on hieno tarjous','vastatarjous',NOW());
INSERT INTO Tarjous (sender_id, reciever_id, item_id, message, offer_type, sent) VALUES ('2','1','2','Tämä on hieno toinen tarjous','vastatarjous',NOW());
INSERT INTO Tarjous (sender_id, reciever_id, item_id, message, offer_type, sent) VALUES ('1','3','3','Tämä on hieno kolmas tarjous','vastatarjous',NOW());
