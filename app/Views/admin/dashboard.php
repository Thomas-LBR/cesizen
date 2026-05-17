<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Administration</h1>
<?= view('admin/partials/nav') ?>

<div class="grid">
    <div class="card"><h2><?= esc($stats['users']) ?></h2><p>Comptes</p></div>
    <div class="card"><h2><?= esc($stats['pages']) ?></h2><p>Pages d’information</p></div>
    <div class="card"><h2><?= esc($stats['events']) ?></h2><p>Événements diagnostic</p></div>
    <div class="card"><h2><?= esc($stats['results']) ?></h2><p>Résultats enregistrés</p></div>
</div>
<?= $this->endSection() ?>
