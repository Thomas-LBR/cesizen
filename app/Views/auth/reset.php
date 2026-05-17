<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Réinitialiser le mot de passe</h1>
<form class="panel form" method="post">
    <?= csrf_field() ?>
    <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?= old('email') ?>" required>
    </div>
    <div class="field">
        <label for="token">Jeton de réinitialisation</label>
        <input id="token" name="token" value="<?= old('token') ?>" required>
    </div>
    <div class="field">
        <label for="password">Nouveau mot de passe</label>
        <input id="password" type="password" name="password" minlength="8" required>
    </div>
    <button class="btn" type="submit">Mettre à jour</button>
</form>
<?= $this->endSection() ?>
