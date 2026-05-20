<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Connexion</h1>
<form class="panel form" method="post">
    <?= csrf_field() ?>
    <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?= old('email') ?>" required>
    </div>
    <div class="field">
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required>
    </div>
    <div class="actions">
        <button class="btn" type="submit">Se connecter</button>
        <a href="<?= site_url('mot-de-passe-oublie') ?>">Mot de passe oublié</a>
    </div>
</form>
<?= $this->endSection() ?>
