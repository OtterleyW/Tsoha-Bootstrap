-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Kayttaja-taulun testidata
INSERT INTO Kayttaja (name, email, password) VALUES ('Kalle Keräilijä', 'kkeraaja@email.com', 'Keräilijä1');
INSERT INTO Kayttaja (name, email, password) VALUES ('Hanna Hamstaaja', 'hhamstraaja@email.com', 'Hamstraaja1');

-- Kohde-taulun testidata

INSERT INTO Kohde (owner_id, name, description, status, added) VALUES ('1', 'Kolikko', 'Hieno kiiltävä kolikko', 'avoinna', NOW());
INSERT INTO Kohde (owner_id, name, description, status, added) VALUES ('2', 'Maljakko', 'Hieno kiiltävä maljakko', 'avoinna', NOW());


-- Tarjous-taulun testidata

INSERT INTO Tarjous (sender_id, reciever_id, item_id, description, offer_type, sent) VALUES ('1','2','1','Tämä on hieno tarjous','vastatarjous',NOW());
