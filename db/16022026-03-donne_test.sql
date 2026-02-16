

-- =========================
-- 1️⃣ CATEGORIES
-- =========================
INSERT INTO categorie (nom_categorie, descri) VALUES
('Alimentation', 'Produits alimentaires de première nécessité'),
('Santé', 'Médicaments et matériel médical'),
('Logistique', 'Matériel logistique et équipement');


-- =========================
-- 2️⃣ TYPES DE BESOIN (avec prix_unitaire)
-- =========================
INSERT INTO type_besoin (nom_type, unite, id_categorie, prix_unitaire) VALUES
('Riz', 'Kg', 1, 3000),
('Eau potable', 'Bidon', 1, 1500),
('Paracétamol', 'Boîte', 2, 5000),
('Tente', 'Unité', 3, 120000);


-- =========================
-- 3️⃣ VILLES
-- =========================
INSERT INTO ville (nom, region) VALUES
('Antananarivo', 'Analamanga'),
('Toamasina', 'Atsinanana'),
('Mahajanga', 'Boeny'),
('Fianarantsoa', 'Haute Matsiatra');


-- =========================
-- 4️⃣ BESOINS
-- =========================
INSERT INTO besoin (id_ville, id_type, qte_besoin_ville, date_saisie) VALUES
(1, 1, 5000, NOW()),   -- 5000 Kg Riz
(2, 2, 2000, NOW()),   -- 2000 Bidons Eau
(3, 4, 150, NOW()),    -- 150 Tentes
(4, 3, 800, NOW());    -- 800 Boîtes Paracétamol


-- =========================
-- 5️⃣ DONS
-- =========================
INSERT INTO don (id_type, qte, date_saisie) VALUES
(1, 3000, NOW()),   -- Riz
(2, 1000, NOW()),   -- Eau
(4, 60, NOW()),     -- Tentes
(3, 400, NOW());    -- Paracétamol


-- =========================
-- 6️⃣ HISTORIQUE (affectation des dons)
-- =========================
INSERT INTO historique (id_don, id_besoin, qte, date_mvt) VALUES
(1, 1, 2500, NOW()),  -- 2500 Kg Riz affectés
(2, 2, 900, NOW()),   -- 900 Eau affectés
(3, 3, 40, NOW()),    -- 40 Tentes affectées
(4, 4, 300, NOW());   -- 300 Médicaments affectés
