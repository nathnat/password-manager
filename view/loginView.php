<?php
$title = 'Password manager';
ob_start();
?>

<form action="login" method="post" class="login">

    <h1>Connexion</h1>

    <?php if (isset($message)) { ?>
        <div class="<?= $message->getType() ?>-message">
            <span class="icon"></span>
            <?= $message->getText() ?>
        </div>
    <?php } ?>

    <div class="input-container">
        <label for="email">Email <span class="required-input">*</span></label>
        <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? '' ?>" required>
    </div>

    <div class="input-container">
        <label for="password">Mot de passe <span class="required-input">*</span></label>
        <input type="password" name="password" id="password" value="<?= $_POST['password'] ?? '' ?>" required>
    </div>

    <div class="button-container">
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </div>

    <p class="redirect">
        Vous n'avez pas de compte ? <a href="inscription">Inscrivez-vous</a>
    </p>
</form>

<?php
$content = ob_get_clean();
require 'template.php';
?>