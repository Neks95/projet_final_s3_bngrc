USE bngrc;

-- =============================================
-- 1. CATÉGORIES
-- =============================================
INSERT INTO categorie (id, nom_categorie, descri) VALUES
(1, 'nature', 'Dons en nature (nourriture, eau, etc.)'),
(2, 'materiel', 'Dons matériels (tôle, bâche, bois, etc.)'),
(3, 'argent', 'Dons en argent');

-- =============================================
-- 2. TYPES DE BESOIN (avec prix_unitaire)
-- =============================================
INSERT INTO type_besoin (id, nom_type, unite, id_categorie, prix_unitaire) VALUES
(1,  'Riz (kg)',      'kg',    1, 3000),
(2,  'Eau (L)',       'L',     1, 1000),
(3,  'Huile (L)',     'L',     1, 6000),
(4,  'Haricots',      'kg',    1, 4000),
(5,  'Tôle',          'unité', 2, 25000),
(6,  'Bâche',         'unité', 2, 15000),
(7,  'Clous (kg)',    'kg',    2, 8000),
(8,  'Bois',          'unité', 2, 10000),
(9,  'Argent',        'Ar',    3, 1),
(10, 'Groupe',        'unité', 2, 6750000);

-- =============================================
-- 3. VILLES
-- (on insère dans l'ordre de la colonne 3 croissant
--  pour que l'id auto_increment corresponde à l'ordre)
-- =============================================

-- Tri par colonne 3 (ordre) :
--  1  → Toamasina  (Bâche, ligne 5)
--  2  → Nosy Be    (Tôle, ligne 19)
--  3  → Mananjary  (Argent, ligne 11) → mais Mananjary déjà là
--  ...
-- Les villes uniques par premier ordre d'apparition :
--  Toamasina, Nosy Be, Mananjary, Farafangana, Morondava

INSERT INTO ville (id, nom, region) VALUES
(1, 'Toamasina',    'Atsinanana'),
(2, 'Mananjary',    'Vatovavy-Fitovinany'),
(3, 'Farafangana',  'Atsimo-Atsinanana'),
(4, 'Nosy Be',      'Diana'),
(5, 'Morondava',    'Menabe');

-- =============================================
-- 4. BESOINS
-- Insérés dans l'ordre de la colonne 3 (ordre d'insertion)
-- =============================================

-- Ordre | Ville        | Type         | Prix_U  | Qte  | Date
-- ------+--------------+--------------+---------+------+-----------
--   1   | Toamasina    | Bâche        | 15000   | 200  | 2026-02-15
--   2   | Nosy Be      | Tôle         | 25000   | 40   | 2026-02-15
--   3   | Mananjary    | Argent       | 1       | 6M   | 2026-02-15
--   4   | Toamasina    | Eau (L)      | 1000    | 1500 | 2026-02-15
--   5   | Nosy Be      | Riz (kg)     | 3000    | 300  | 2026-02-15
--   6   | Mananjary    | Tôle         | 25000   | 80   | 2026-02-15
--   7   | Nosy Be      | Argent       | 1       | 4M   | 2026-02-15
--   8   | Farafangana  | Bâche        | 15000   | 150  | 2026-02-16
--   9   | Mananjary    | Riz (kg)     | 3000    | 500  | 2026-02-15
--  10   | Farafangana  | Argent       | 1       | 8M   | 2026-02-16
--  11   | Morondava    | Riz (kg)     | 3000    | 700  | 2026-02-16
--  12   | Toamasina    | Argent       | 1       | 12M  | 2026-02-16
--  13   | Morondava    | Argent       | 1       | 10M  | 2026-02-16
--  14   | Farafangana  | Eau (L)      | 1000    | 1000 | 2026-02-15
--  15   | Morondava    | Bâche        | 15000   | 180  | 2026-02-16
--  16   | Toamasina    | Groupe       | 6750000 | 1    | 2026-02-15
--  17   | Toamasina    | Riz (kg)     | 3000    | 800  | 2026-02-16
--  18   | Nosy Be      | Haricots     | 4000    | 200  | 2026-02-16
--  19   | Mananjary    | Clous (kg)   | 8000    | 60   | 2026-02-16
--  20   | Morondava    | Eau (L)      | 1000    | 1200 | 2026-02-15
--  21   | Farafangana  | Riz (kg)     | 3000    | 600  | 2026-02-16
--  22   | Morondava    | Bois         | 10000   | 150  | 2026-02-15
--  23   | Toamasina    | Tôle         | 25000   | 120  | 2026-02-16
--  24   | Nosy Be      | Clous (kg)   | 8000    | 30   | 2026-02-16
--  25   | Mananjary    | Huile (L)    | 6000    | 120  | 2026-02-16
--  26   | Farafangana  | Bois         | 10000   | 100  | 2026-02-15

INSERT INTO besoin (id, id_ville, id_type, qte_besoin_ville, date_saisie) VALUES
-- id=ordre, id_ville=ref ville, id_type=ref type_besoin
( 1, 1, 6,       200, '2026-02-15 00:00:00'),  -- Toamasina,   Bâche,      200
( 2, 4, 5,        40, '2026-02-15 00:00:00'),  -- Nosy Be,     Tôle,       40
( 3, 2, 9,   6000000, '2026-02-15 00:00:00'),  -- Mananjary,   Argent,     6 000 000
( 4, 1, 2,      1500, '2026-02-15 00:00:00'),  -- Toamasina,   Eau (L),    1 500
( 5, 4, 1,       300, '2026-02-15 00:00:00'),  -- Nosy Be,     Riz (kg),   300
( 6, 2, 5,        80, '2026-02-15 00:00:00'),  -- Mananjary,   Tôle,       80
( 7, 4, 9,   4000000, '2026-02-15 00:00:00'),  -- Nosy Be,     Argent,     4 000 000
( 8, 3, 6,       150, '2026-02-16 00:00:00'),  -- Farafangana, Bâche,      150
( 9, 2, 1,       500, '2026-02-15 00:00:00'),  -- Mananjary,   Riz (kg),   500
(10, 3, 9,   8000000, '2026-02-16 00:00:00'),  -- Farafangana, Argent,     8 000 000
(11, 5, 1,       700, '2026-02-16 00:00:00'),  -- Morondava,   Riz (kg),   700
(12, 1, 9,  12000000, '2026-02-16 00:00:00'),  -- Toamasina,   Argent,     12 000 000
(13, 5, 9,  10000000, '2026-02-16 00:00:00'),  -- Morondava,   Argent,     10 000 000
(14, 3, 2,      1000, '2026-02-15 00:00:00'),  -- Farafangana, Eau (L),    1 000
(15, 5, 6,       180, '2026-02-16 00:00:00'),  -- Morondava,   Bâche,      180
(16, 1, 10,        3, '2026-02-15 00:00:00'),  -- Toamasina,   Groupe,     1
(17, 1, 1,       800, '2026-02-16 00:00:00'),  -- Toamasina,   Riz (kg),   800
(18, 4, 4,       200, '2026-02-16 00:00:00'),  -- Nosy Be,     Haricots,   200
(19, 2, 7,        60, '2026-02-16 00:00:00'),  -- Mananjary,   Clous (kg), 60
(20, 5, 2,      1200, '2026-02-15 00:00:00'),  -- Morondava,   Eau (L),    1 200
(21, 3, 1,       600, '2026-02-16 00:00:00'),  -- Farafangana, Riz (kg),   600
(22, 5, 8,       150, '2026-02-15 00:00:00'),  -- Morondava,   Bois,       150
(23, 1, 5,       120, '2026-02-16 00:00:00'),  -- Toamasina,   Tôle,       120
(24, 4, 7,        30, '2026-02-16 00:00:00'),  -- Nosy Be,     Clous (kg), 30
(25, 2, 3,       120, '2026-02-16 00:00:00'),  -- Mananjary,   Huile (L),  120
(26, 3, 8,       100, '2026-02-15 00:00:00');  -- Farafangana, Bois,       100


INSERT INTO don (id, id_type, qte, date_saisie) VALUES
( 1, 9,  5000000, '2026-02-16 00:00:00'),  -- Argent      5 000 000
( 2, 9,  3000000, '2026-02-16 00:00:00'),  -- Argent      3 000 000
( 3, 9,  4000000, '2026-02-17 00:00:00'),  -- Argent      4 000 000
( 4, 9,  1500000, '2026-02-17 00:00:00'),  -- Argent      1 500 000
( 5, 9,  6000000, '2026-02-17 00:00:00'),  -- Argent      6 000 000
( 6, 1,      400, '2026-02-16 00:00:00'),  -- Riz (kg)    400
( 7, 2,      600, '2026-02-16 00:00:00'),  -- Eau (L)     600
( 8, 5,       50, '2026-02-17 00:00:00'),  -- Tôle        50
( 9, 6,       70, '2026-02-17 00:00:00'),  -- Bâche       70
(10, 4,      100, '2026-02-17 00:00:00'),  -- Haricots    100
(11, 1,     2000, '2026-02-18 00:00:00'),  -- Riz (kg)    2 000
(12, 5,      300, '2026-02-18 00:00:00'),  -- Tôle        300
(13, 2,     5000, '2026-02-18 00:00:00'),  -- Eau (L)     5 000
(14, 9, 20000000, '2026-02-19 00:00:00'),  -- Argent      20 000 000
(15, 6,      500, '2026-02-19 00:00:00'),  -- Bâche       500
(16, 4,       88, '2026-02-17 00:00:00');  -- Haricots    88

-- =============================================
-- 5. VÉRIFICATION
-- =============================================
SELECT 
    b.id AS ordre,
    v.nom AS ville,
    b.date_saisie,
    c.nom_categorie AS categorie,
    tb.nom_type AS type,
    tb.prix_unitaire,
    b.qte_besoin_ville AS quantite
FROM besoin b
JOIN ville v ON b.id_ville = v.id
JOIN type_besoin tb ON b.id_type = tb.id
JOIN categorie c ON tb.id_categorie = c.id
ORDER BY b.id;