DROP DATABASE IF EXISTS projet_final;
CREATE DATABASE projet_final;
USE projet_final;


CREATE TABLE projet_final_membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre CHAR(1) ,
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(100),
    image_profil VARCHAR(255)
);


CREATE TABLE projet_final_categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);


CREATE TABLE projet_final_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES projet_final_categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES projet_final_membre(id_membre)
);


CREATE TABLE projet_final_images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES projet_final_objet(id_objet)
);


CREATE TABLE projet_final_emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES projet_final_objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES projet_final_membre(id_membre)
);


INSERT INTO projet_final_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Nekena', '1995-04-10', 'F', 'alice@example.com', 'Antananarivo', 'mdp1', 'alice.jpg'),
('Tsiky', '1992-06-22', 'M', 'bob@example.com', 'Fianarantsoa', 'mdp2', 'bob.jpg'),
('Dylan', '1988-09-12', 'F', 'claire@example.com', 'Toamasina', 'mdp3', 'claire.jpg'),
('Giovan', '1990-12-05', 'M', 'david@example.com', 'Mahajanga', 'mdp4', 'david.jpg');


INSERT INTO projet_final_categorie_objet (nom_categorie) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');


INSERT INTO projet_final_objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1), ('Rouge à lèvres', 1, 1), ('Marteau', 2, 1), ('Tournevis', 2, 1), 
('Clé à molette', 3, 1), ('Pompe à vélo', 3, 1), ('Mixeur', 4, 1), ('Casserole', 4, 1),
('Peigne', 1, 1), ('Spatule', 4, 1),

('Perceuse', 2, 2), ('Pince', 2, 2), ('Tondeuse', 1, 2), ('Bouilloire', 4, 2),
('Cric', 3, 2), ('Fourchette', 4, 2), ('Tournevis électrique', 2, 2), ('Mascara', 1, 2),
('Écrou', 3, 2), ('Couteau', 4, 2),

('Poudre', 1, 3), ('Éponge', 4, 3), ('Scie', 2, 3), ('Clé anglaise', 3, 3),
('Friteuse', 4, 3), ('Lime', 2, 3), ('Vernis', 1, 3), ('Jack hydraulique', 3, 3),
('Batteur', 4, 3), ('Ciseaux', 1, 3);





INSERT INTO projet_final_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(3, 2, '2025-07-01', '2025-07-10'),
(7, 3, '2025-07-03', '2025-07-12'),
(11, 1, '2025-07-02', '2025-07-09'),
(22, 4, '2025-07-04', '2025-07-14'),
(14, 1, '2025-07-05', '2025-07-15'),
(24, 2, '2025-07-06', '2025-07-20'),
(18, 4, '2025-07-07', '2025-07-17'),
(30, 2, '2025-07-08', '2025-07-13'),
(36, 1, '2025-07-09', '2025-07-18'),
(38, 3, '2025-07-10', '2025-07-19');

ALTER TABLE projet_final_emprunt
ADD COLUMN etat_retour VARCHAR(50);


