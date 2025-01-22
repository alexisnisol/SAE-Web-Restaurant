<?php
// phpinfo();
function getPDO()
{
    try {
        $pdo = new PDO('postgresql://postgres:Taste&Tell42@db.rwvhbldaozvrcotlajbs.supabase.co:5432/postgres');        
        // Configurer PDO pour lever des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

$pdo = getPDO();
$sql = "SELECT * FROM RESTAURANT";
$stmt = $pdo->query($sql);
$restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($restaurants);
?>