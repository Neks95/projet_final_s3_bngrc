-- exemples d'entrées validées dans la table historique
INSERT INTO historique (id_don, id_besoin, qte, date_mvt) VALUES
-- Don 1 (3000 kg de Riz) attribué au besoin 1 (Riz 5000 kg)
(1, 1, 3000, '2026-02-15 09:00:00'),
-- Don 2 (1000 L Eau) attribué au besoin 2 (Eau potable 2000 L)
(2, 2, 1000, '2026-02-15 09:30:00'),
-- Don 3 (60 unités Tôle) attribué au besoin 3 (Tôle 150 unités)
(3, 3, 60, '2026-02-15 10:00:00'),
-- Don 4 (400000 Ar) attribué au besoin 4 (besoin en argent 4 000 000 Ar)
(4, 4, 400000, '2026-02-15 11:00:00');