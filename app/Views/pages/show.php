<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<article class="panel">
    <p><a href="<?= site_url('/') ?>">Retour à l’accueil</a></p>
    <h1><?= esc($page['title']) ?></h1>
    <p class="lead"><?= esc($page['summary']) ?></p>
    <p><?= nl2br(esc($page['content'])) ?></p>
</article>
<?= $this->endSection() ?>
