<?php
$title = 'Créer un champ';
ob_start();
?>

<div class="add-champ">
    <form action="add" method="post" class="card">
        <h1 class="card-title">Nouvelle ligne</h1>

        <?php if (isset($message)) { ?>
            <div class="<?= $message->getType() ?>-message">
                <span class="icon"></span>
                <?= $message->getText() ?>
            </div>
        <?php } ?>

        <p class="input-container">
            <label for="site">Site <span class="required-input">*</span></label>
            <input type="text" name="site" id="site" placeholder="Site" required>
        </p>

        <p class="input-container">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Email" value="<?= $_POST['email'] ?? '' ?>">
        </p>

        <p class="input-container">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" value="<?= $_POST['username'] ?? '' ?>">
        </p>

        <p class="input-container">
            <label for="password">Mot de passe</label>
            <input type="text" name="password" id="password" placeholder="Mot de passe" value="<?= $_POST['password'] ?? '' ?>">
        </p>

        <p class="input-container">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" placeholder="Description" value="<?= $_POST['description'] ?? '' ?>">
        </p>

        <div class="button-container">
            <a href="." class="close">Annuler</a>
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
require 'template.php';
?>