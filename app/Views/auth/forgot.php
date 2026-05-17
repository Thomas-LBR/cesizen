<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Mot de passe oublié</h1>
<form class="panel form" method="post">
    <?= csrf_field() ?>
    <div class="field">
        <label for="email">Email du compte</label>
        <input id="email" type="email" name="email" required>
    </div>
    <button class="btn" type="submit">Créer une demande</button>
    <?php if ($token): ?>
        <p class="notice">Mode prototype : utilisez ce jeton pour réinitialiser le mot de passe : <strong><?= esc($token) ?></strong></p>
        <a href="<?= site_url('reinitialiser-mot-de-passe') ?>">Réinitialiser maintenant</a>
    <?php endif; ?>
</form>
<?= $this->endSection() ?>
