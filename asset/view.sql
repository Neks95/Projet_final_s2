CREATE or REPLACE view v_liste_objet as 
SELECT 
    o.id_objet,
    o.nom_objet,
    o.id_categorie,
    o.id_membre,
    e.id_emprunt,
    e.date_emprunt,
    e.date_retour,
    c.nom_categorie,
    m.nom
FROM 
    projet_final_objet o
LEFT JOIN 
    projet_final_emprunt e ON o.id_objet = e.id_objet
JOIN projet_final_membre m ON o.id_membre = m.id_membre 
   JOIN projet_final_categorie_objet c ON o.id_categorie = c.id_categorie 

;
