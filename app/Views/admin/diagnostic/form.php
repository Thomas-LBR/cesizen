<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1><?= esc($title) ?></h1>
<?= view('admin/partials/nav') ?>
<form class="panel form" method="post">
    <?= csrf_field() ?>
    <div class="field">
        <label for="label">Libellé</label>
        <input id="label" name="label" value="<?= esc($event['label'] ?? '') ?>" required>
    </div>
    <div class="field">
        <label for="points">Points associés</label>
        <input id="points" type="number" min="0" name="points" value="<?= esc($event['points'] ?? 0) ?>" required>
    </div>
    <label class="check-item">
        <input type="checkbox" name="is_active" value="1" <?= ($event['is_active'] ?? 1) ? 'checked' : '' ?>>
        <span>Afficher dans le questionnaire</span>
    </label>
    <div class="actions">
        <button class="btn" type="submit">Enregistrer</button>
        <a href="<?= site_url('admin/diagnostic') ?>">Annuler</a>
    </div>
</form>
<?= $this->endSection() ?>
