<?php
use App\Controllers\Auth\Auth;
use App\Controllers\Avis\Avis;
use App\Controllers\Restaurant\Restaurant;

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
                        <h4>Restaurant: <?php echo htmlspecialchars($avis['restaurant_name']); ?></h4>
                        <p>Note: 
                            <?php for ($i = 0; $i < 5; $i++) {
                                echo $avis['etoile'] > $i ? '⭐' : '☆';
                            } ?>
                        </p>
                        <p><?php echo nl2br(htmlspecialchars($avis['avis'])); ?></p>
                        <p><em>Posté par <?php echo htmlspecialchars($avis['user_nom'] . ' ' . $avis['user_prenom']); ?> le : <?php echo htmlspecialchars($avis['date_avis']); ?></em></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
