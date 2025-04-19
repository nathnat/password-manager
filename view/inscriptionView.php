<?php
$title = 'Password manager - Inscription';
ob_start();
?>

<form action="inscription" method="post" class="login">

    <h1>Inscription</h1>

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
        <label for="password">Mot de passe (6 caractères min.) <span class="required-input">*</span></label>
        <input type="password" name="password" id="password" value="<?= $_POST['password'] ?? '' ?>" required>
    </div>

    <div class="input-container">
        <label for="comfirm-password">Confirmation du mot de passe <span class="required-input">*</span></label>
        <input type="password" name="confirmPassword" id="comfirm-password" value="<?= $_POST['confirmPassword'] ?? '' ?>" required>
    </div>

    <div class="button-container">
        <button type="submit" class="btn btn-primary">Créer un compte</button>
    </div>

    <p class="redirect">
        Vous avez déjà un compte ? <a href="login">Connectez-vous</a>
    </p>
</form>

<?php
$content = ob_get_clean();
require 'template.php';
?>