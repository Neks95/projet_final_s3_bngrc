ALTER TABLE besoin
DROP COLUMN prix_unitaire;
ALTER TABLE type_besoin
ADD COLUMN prix_unitaire INT;
