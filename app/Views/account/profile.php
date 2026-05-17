<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Mon compte</h1>
<form class="panel form" method="post">
    <?= csrf_field() ?>
    <div class="grid two">
        <div class="field">
            <label for="firstname">Prénom</label>
            <input id="firstname" name="firstname" value="<?= esc($user['firstname']) ?>" required>
        </div>
        <div class="field">
            <label for="lastname">Nom</label>
            <input id="lastname" name="lastname" value="<?= esc($user['lastname']) ?>" required>
        </div>
    </div>
    <div class="field">
        <label>Email</label>
        <input value="<?= esc($user['email']) ?>" disabled>
    </div>
    <div class="field">
        <label for="password">Nouveau mot de passe</label>
        <input id="password" type="password" name="password" minlength="8">
    </div>
    <button class="btn" type="submit">Enregistrer</button>
</form>
<?= $this->endSection() ?>
