<?php
$title = 'Password manager - Modification';
ob_start();
?>

<main class="modify card">

    <h1 class="card-title">Modification</h1>

    <?php if (isset($message)) { ?>
        <div class="<?= $message->getType() ?>-message">
            <span class="icon"></span>
            <?= $message->getText() ?>
        </div>
    <?php } ?>

    <form method="post" class="modify">

        <p class="input-container">
            <label for="site">Site <span class="required-input">*</span></label>
            <input type="text" id="site" name="site" value="<?= $champ->site() ?>" required>
        </p>

        <p class="input-container">
            <label for="site">Email</label>
            <input type="text" id="email" name="email" value="<?= $champ->email() ?>">
        </p>

        <p class="input-container">
            <label for="site">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" value="<?= $champ->username() ?>">
        </p>

        <p class="input-container">
            <label for="site">Mot de passe</label>
            <input type="text" id="password" name="password" value="<?= $champ->password('decrypt') ?>">
        </p>

        <p class="input-container">
            <label for="site">Description</label>
            <input type="text" id="description" name="description" value="<?= $champ->description() ?>">
        </p>

        <div class="button-container">
            <a href="." class="close">Fermer</a>
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>

</main>

<section class="suppression">
    <button class="btn btn-alert">
        <span class="icon">
            <i class="fas fa-trash-alt"></i>
        </span>
        Supprimer la ligne
    </button>
</section>

<div class="delete-champ">
    <div class="overlay">
        <div class="popup">
            <!-- Bande bleu de titre -->
            <div class="title">
                <h1>Suppression</h1>
                <div class="close-popup">
                    <span class="icon">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
            <div class="content">
                <p>
                    Etes-vous sur de vouloir supprimer cette ligne&nbsp;? <br />
                    <strong>Cette action est irréversible.</strong>
                </p>
                <div class="button-container">
                    <button class="annuler btn btn-secondary">Annuler</button>
                    <button class="supprimer btn btn-alert">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const champ = JSON.parse('<?= $champ->toJson() ?>');
</script>
<script src="./js/modify.js"></script>

<?php
$content = ob_get_clean();
require 'template.php';
?>