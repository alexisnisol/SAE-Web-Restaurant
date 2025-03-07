<?php
use App\Controllers\Auth\Auth;
use App\Controllers\Avis\Avis;
use App\Controllers\Restaurant\Restaurant;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && Auth::isUserLoggedIn()) {
    if (isset($_POST['delete_review'])) {
        $idAvis = $_POST['delete_review'];
        Avis::deleteAvis($idAvis);
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
}
?>

<div class="container">
    <div class="reviews-section">
        <?php if (!Auth::isUserLoggedIn()): ?>
            <p>Veuillez vous connecter pour voir vos avis.</p>
        <?php else: ?>
            <h3>Vos avis :</h3>
            <?php
            $userId = Auth::getCurrentUser()->id;

            $avisUser = Avis::getAllAvisByUser($userId);

            if (empty($avisUser)): ?>
                <p>Vous retrouverez vos avis ici.</p>
            <?php else: ?>
                <?php foreach ($avisUser as $avis): ?>
                    <div class="review">
                    <h4>
                        <a href="./index.php?action=visualisation&idRestau=<?php echo urlencode($avis['id_restaurant']); ?>">
                            Restaurant: <?php echo htmlspecialchars($avis['restaurant_name']); ?>
                        </a>
                    </h4>
                        <p>Note: 
                            <?php for ($i = 0; $i < 5; $i++) {
                                echo $avis['etoile'] > $i ? '⭐' : '☆';
                            } ?>
                        </p>
                        <p><?php echo nl2br(htmlspecialchars($avis['avis'])); ?></p>
                        <p><em>Posté par <?php echo htmlspecialchars($avis['user_nom'] . ' ' . $avis['user_prenom']); ?> le : <?php echo htmlspecialchars($avis['date_avis']); ?></em></p>
                        <?php if (Auth::isUserLoggedIn() && (Auth::getCurrentUser()->isAdmin() || Auth::getCurrentUser()->isModerator())) : ?>
                            <form action="" method="post" class="delete-form">
                                <input type="hidden" name="delete_review" value="<?php echo $avis['id_avis']; ?>">
                                <button type="submit" class="delete-btn" onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet avis ?')">🗑 Supprimer</button>
                            </form>
                        <?php endif ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
