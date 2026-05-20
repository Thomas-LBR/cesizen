<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1f7a68">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="CESIZen">
    <title><?= esc($title ?? 'CESIZen') ?></title>
    <link rel="manifest" href="<?= base_url('manifest.webmanifest') ?>">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/icons/icon.svg') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=2') ?>">
</head>
<body>
<header class="site-header">
    <nav class="nav" aria-label="Navigation principale">
        <a class="brand" href="<?= site_url('/') ?>">CESIZen</a>
        <div class="nav-links">
            <a href="<?= site_url('/') ?>">Accueil</a>
            <a href="<?= site_url('diagnostic') ?>">Diagnostic</a>
            <?php if (! empty($currentUser['id'])): ?>
                <a href="<?= site_url('diagnostic/resultats') ?>">Mes résultats</a>
                <a href="<?= site_url('compte') ?>">Mon compte</a>
                <?php if ($currentUser['role'] === 'admin'): ?>
                    <a href="<?= site_url('admin') ?>">Admin</a>
                <?php endif; ?>
                <a href="<?= site_url('deconnexion') ?>">Déconnexion</a>
            <?php else: ?>
                <a href="<?= site_url('connexion') ?>">Connexion</a>
                <a class="btn register-link" href="<?= site_url('inscription') ?>">Créer un compte</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main class="main">
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="notice"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="notice error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>
</main>

<footer class="footer">
    <div class="container">
        CESIZen accompagne l’auto-évaluation du stress. L’application ne remplace pas un avis médical.
    </div>
</footer>
<script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('<?= base_url('service-worker.js') ?>');
    });
}
</script>
</body>
</html>
