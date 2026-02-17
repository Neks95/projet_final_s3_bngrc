

-- =========================
-- 1️⃣ CATEGORIES
-- =========================
INSERT INTO categorie (nom_categorie, descri) VALUES
('nature', 'Produits alimentaires ,......'),
('materiaux', 'Materiel de construction'),
('argent', 'money');


-- =========================
-- 2️⃣ TYPES DE BESOIN (avec prix_unitaire)
-- =========================
INSERT INTO type_besoin (nom_type, unite, id_categorie, prix_unitaire) VALUES
('Riz', 'Kg', 1, 3000),
('Eau potable', 'l', 1, 1500),
('tole', 'unite', 2, 5000),
('argent', 'ar', 3, null);


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
(3, 3, 150, NOW()),    -- 150 toles
(4, 4, 4000000, NOW());    -- 40 000 ar


-- =========================
-- 5️⃣ DONS
-- =========================
INSERT INTO don (id_type, qte, date_saisie) VALUES
(1, 3000, NOW()),   -- Riz
(2, 1000, NOW()),   -- Eau
(3, 60, NOW()),     -- Tentes
(4, 400000, NOW());    -- Paracétamol



