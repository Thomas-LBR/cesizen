<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
    <h1>Résultat du diagnostic</h1>
    <div class="score"><?= esc($result->score) ?></div>
    <p><span class="tag"><?= esc($result->level) ?></span></p>
    <p><?= esc($result->message) ?></p>
    <p class="muted"><?= $isSaved ? 'Résultat enregistré dans votre historique.' : 'Résultat non enregistré car vous êtes en visite anonyme.' ?></p>
    <div class="actions">
        <a class="btn" href="<?= site_url('diagnostic') ?>">Refaire le diagnostic</a>
        <?php if (! $isSaved): ?>
            <a class="btn secondary" href="<?= site_url('connexion') ?>">Se connecter pour conserver ses résultats</a>
        <?php endif; ?>
    </div>
</section>

<?php if ($events): ?>
    <h2>Événements sélectionnés</h2>
    <div class="grid">
        <?php foreach ($events as $event): ?>
            <div class="card"><?= esc($event['label']) ?> <strong><?= esc($event['points']) ?> pts</strong></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
