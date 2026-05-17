<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero">
    <div>
        <h1>Votre espace simple pour comprendre et évaluer le stress.</h1>
        <p class="lead">CESIZen propose des informations de prévention et un diagnostic de stress basé sur l’échelle de Holmes et Rahe.</p>
        <div class="actions">
            <a class="btn" href="<?= site_url('diagnostic') ?>">Faire le diagnostic</a>
            <a class="btn secondary" href="<?= site_url('inscription') ?>">Créer un compte</a>
        </div>
    </div>
    <aside class="panel hero-aside">
        <h2>Module retenu</h2>
        <p>Le prototype couvre les comptes utilisateurs, les pages d’information et le module de diagnostic de stress.</p>
        <p class="muted">Les résultats sont enregistrés uniquement pour les utilisateurs connectés.</p>
    </aside>
</section>

<h2>Informations utiles</h2>
<div class="grid">
    <?php foreach ($pages as $page): ?>
        <article class="card">
            <h3><?= esc($page['title']) ?></h3>
            <p><?= esc($page['summary']) ?></p>
            <a href="<?= site_url('page/' . $page['slug']) ?>">Lire la page</a>
        </article>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>
