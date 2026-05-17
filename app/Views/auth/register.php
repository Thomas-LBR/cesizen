<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Créer un compte</h1>
<?= validation_list_errors() ?>
<form class="panel form" method="post">
    <?= csrf_field() ?>
    <div class="grid two">
        <div class="field">
            <label for="firstname">Prénom</label>
            <input id="firstname" name="firstname" value="<?= old('firstname') ?>" required>
        </div>
        <div class="field">
            <label for="lastname">Nom</label>
            <input id="lastname" name="lastname" value="<?= old('lastname') ?>" required>
        </div>
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?= old('email') ?>" required>
    </div>
    <div class="field">
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" minlength="8" required>
    </div>
    <div class="field">
        <label for="password_confirm">Confirmation</label>
        <input id="password_confirm" type="password" name="password_confirm" minlength="8" required>
    </div>
    <button class="btn" type="submit">Créer le compte</button>
</form>
<?= $this->endSection() ?>
