<?php

include '../initialisation.php';

use PasswordManager\Manager\ChampManager;

// On vérifie tout sur les variables dont on a besoin
if (isset($_SESSION['user']) && isset($_POST['searchWord']) && !empty($_POST['searchWord'])) {

    $manager = new ChampManager;

    $_POST['searchWord'] = htmlspecialchars($_POST['searchWord']);

    $champs = $manager->search($_POST['searchWord'], $_SESSION['user']);

    if (!empty($champs)) {

        foreach ($champs as $key => $champ) { ?>
            <div class="row" id="<?= $champ->id() ?>">
                <a href="modify?id=<?= $champ->id() ?>" class="action">Éditer</a>
                <div class="case site" data-site="<?= $champ->site() ?>"><?= $champ->site() ?></div>
                <div class="case email"><?= $champ->email() ?></div>
                <div class="case username"><?= $champ->username() ?></div>
                <div class="case password"><?= $champ->password('decrypt') ?></div>
                <div class="case description"><?= $champ->description() ?></div>
            </div>
<?php }
    } else {
        echo '<div>Pas de champ trouvé pour <strong>' . $_POST['searchWord'] . '</strong></div>';
    }
}
