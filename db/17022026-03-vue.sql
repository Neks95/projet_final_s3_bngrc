CREATE OR REPLACE VIEW view_besoins_restants AS
SELECT
  b.id AS id_besoin,
  b.id_ville,
  v.nom AS ville,
  v.region,
  b.id_type,
  tb.nom_type,
  tb.unite,
  COALESCE(tb.prix_unitaire, 0) AS prix_unitaire,
  b.qte_besoin_ville AS qte_demande,

  -- somme d'argent (Ar) et somme de quantités (unités) déjà enregistrées dans historique
  COALESCE((
    SELECT COALESCE(SUM(CASE WHEN donor_tb.unite = 'ar' THEN h.qte ELSE 0 END),0)
    FROM historique h
    LEFT JOIN don d2 ON d2.id = h.id_don
    LEFT JOIN type_besoin donor_tb ON d2.id_type = donor_tb.id
    WHERE h.id_besoin = b.id
  ),0) AS sum_money_ar,

  COALESCE((
    SELECT COALESCE(SUM(CASE WHEN donor_tb.unite <> 'ar' OR donor_tb.unite IS NULL THEN h.qte ELSE 0 END),0)
    FROM historique h
    LEFT JOIN don d2 ON d2.id = h.id_don
    LEFT JOIN type_besoin donor_tb ON d2.id_type = donor_tb.id
    WHERE h.id_besoin = b.id
  ),0) AS sum_qty_nonmoney,

  -- fee (pourcentage) lu depuis config_frais ; si absent on prend 10%
  COALESCE((SELECT valeur FROM config_frais LIMIT 1), 10) AS fee_percent,

  -- conversion Argent -> quantités : diviser par prix_unitaire * (1 + fee_percent/100)
  FLOOR(
    COALESCE((
      SELECT COALESCE(SUM(CASE WHEN donor_tb.unite = 'ar' THEN h.qte ELSE 0 END),0)
      FROM historique h
      LEFT JOIN don d2 ON d2.id = h.id_don
      LEFT JOIN type_besoin donor_tb ON d2.id_type = donor_tb.id
      WHERE h.id_besoin = b.id
    ),0)
    / NULLIF(COALESCE(tb.prix_unitaire,0) * (1 + COALESCE((SELECT valeur FROM config_frais LIMIT 1), 10) / 100), 0)
  ) AS qte_satisfied_from_money,

  -- quantité totale satisfaite (unités)
  (
    COALESCE((
      SELECT COALESCE(SUM(CASE WHEN donor_tb.unite <> 'ar' OR donor_tb.unite IS NULL THEN h.qte ELSE 0 END),0)
      FROM historique h
      LEFT JOIN don d2 ON d2.id = h.id_don
      LEFT JOIN type_besoin donor_tb ON d2.id_type = donor_tb.id
      WHERE h.id_besoin = b.id
    ),0)
    +
    FLOOR(
      COALESCE((
        SELECT COALESCE(SUM(CASE WHEN donor_tb.unite = 'ar' THEN h.qte ELSE 0 END),0)
        FROM historique h
        LEFT JOIN don d2 ON d2.id = h.id_don
        LEFT JOIN type_besoin donor_tb ON d2.id_type = donor_tb.id
        WHERE h.id_besoin = b.id
      ),0)
      / NULLIF(COALESCE(tb.prix_unitaire,0) * (1 + COALESCE((SELECT valeur FROM config_frais LIMIT 1), 10) / 100), 0)
    )
  ) AS qte_satisfait,

  -- restant en quantités
  GREATEST(0, b.qte_besoin_ville - (
    COALESCE((
      SELECT COALESCE(SUM(CASE WHEN donor_tb.unite <> 'ar' OR donor_tb.unite IS NULL THEN h.qte ELSE 0 END),0)
      FROM historique h
      LEFT JOIN don d2 ON d2.id = h.id_don
      LEFT JOIN type_besoin donor_tb ON d2.id_type = donor_tb.id
      WHERE h.id_besoin = b.id
    ),0)
    +
    FLOOR(
      COALESCE((
        SELECT COALESCE(SUM(CASE WHEN donor_tb.unite = 'ar' THEN h.qte ELSE 0 END),0)
        FROM historique h
        LEFT JOIN don d2 ON d2.id = h.id_don
        LEFT JOIN type_besoin donor_tb ON d2.id_type = donor_tb.id
        WHERE h.id_besoin = b.id
      ),0)
      / NULLIF(COALESCE(tb.prix_unitaire,0) * (1 + COALESCE((SELECT valeur FROM config_frais LIMIT 1), 10) / 100), 0)
    )
  )) AS qte_restant,

  CASE WHEN tb.unite = 'ar' THEN b.qte_besoin_ville ELSE b.qte_besoin_ville * COALESCE(tb.prix_unitaire,0) END AS valeur_demande_ar,


  (
    COALESCE((
      SELECT COALESCE(SUM(CASE WHEN donor_tb.unite = 'ar' THEN h.qte ELSE 0 END),0)
      FROM historique h
      LEFT JOIN don d2 ON d2.id = h.id_don
      LEFT JOIN type_besoin donor_tb ON d2.id_type = donor_tb.id
      WHERE h.id_besoin = b.id
    ),0)
    +
    COALESCE((
      SELECT COALESCE(SUM(CASE WHEN donor_tb.unite <> 'ar' OR donor_tb.unite IS NULL THEN h.qte ELSE 0 END),0) * COALESCE(tb.prix_unitaire,0)
      FROM historique h
      LEFT JOIN don d2 ON d2.id = h.id_don
      LEFT JOIN type_besoin donor_tb ON d2.id_type = donor_tb.id
      WHERE h.id_besoin = b.id
    ),0)
  ) AS valeur_satisfaite_ar

FROM besoin b
JOIN type_besoin tb ON b.id_type = tb.id
JOIN ville v ON b.id_ville = v.id;

