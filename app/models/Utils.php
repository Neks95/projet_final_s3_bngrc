<?php
namespace app\models;
use PDO;
class Utils{ 
    private $db;
    public function __construct($db)
    {
        $this->db=$db;
    }
    
public function getDonsArgentRestants()
{
    $sql = "
      SELECT d.id AS id_don, d.qte AS qte_origine,
             COALESCE(SUM(h.qte),0) AS qte_consommee,
             (d.qte - COALESCE(SUM(h.qte),0)) AS qte_restant,
             d.date_saisie
      FROM don d
      LEFT JOIN historique h ON h.id_don = d.id
      JOIN type_besoin tb ON d.id_type = tb.id
      WHERE tb.unite = 'ar'
      GROUP BY d.id, d.qte, d.date_saisie
      HAVING (d.qte - COALESCE(SUM(h.qte),0)) > 0
      ORDER BY d.date_saisie ASC
    ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getTotalArgentDisponible()
{
    $sql = "
      SELECT COALESCE(SUM(d.qte - COALESCE(hs.sumq,0)),0) AS total_disponible
      FROM don d
      JOIN type_besoin tb ON d.id_type = tb.id
      LEFT JOIN (
        SELECT id_don, SUM(qte) AS sumq FROM historique GROUP BY id_don
      ) hs ON hs.id_don = d.id
      WHERE tb.unite = 'ar'
    ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return (float) $stmt->fetchColumn();
}
public function getConfig()
{
    try {
        $sql = "SELECT valeur FROM config_frais LIMIT 1";
        $stmt = $this->db->query($sql);
        $val = $stmt->fetchColumn();

        if ($val === false) return 0.10;

        return ((float)$val) / 100;
    } catch (\Exception $e) {
        return 0.10;
    }
}

}
?>

