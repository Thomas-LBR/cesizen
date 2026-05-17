<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1><?= esc($title) ?></h1>
<?= view('admin/partials/nav') ?>
<form class="panel form" method="post">
    <?= csrf_field() ?>
    <div class="field">
        <label for="title">Titre</label>
        <input id="title" name="title" value="<?= esc($page['title'] ?? '') ?>" required>
    </div>
    <div class="field">
        <label for="summary">Résumé</label>
        <input id="summary" name="summary" value="<?= esc($page['summary'] ?? '') ?>" required>
    </div>
    <div class="field">
        <label for="content">Contenu</label>
        <textarea id="content" name="content" required><?= esc($page['content'] ?? '') ?></textarea>
    </div>
    <label class="check-item">
        <input type="checkbox" name="is_published" value="1" <?= ($page['is_published'] ?? 1) ? 'checked' : '' ?>>
        <span>Publier la page</span>
    </label>
    <div class="actions">
        <button class="btn" type="submit">Enregistrer</button>
        <a href="<?= site_url('admin/pages') ?>">Annuler</a>
    </div>
</form>
<?= $this->endSection() ?>
