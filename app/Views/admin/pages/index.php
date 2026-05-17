<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Pages d’information</h1>
<?= view('admin/partials/nav') ?>
<p><a class="btn" href="<?= site_url('admin/pages/creer') ?>">Créer une page</a></p>

<div class="grid">
    <?php foreach ($pages as $page): ?>
        <article class="card">
            <h2><?= esc($page['title']) ?></h2>
            <p><?= esc($page['summary']) ?></p>
            <p><span class="tag"><?= $page['is_published'] ? 'Publiée' : 'Brouillon' ?></span></p>
            <div class="actions">
                <a class="btn secondary" href="<?= site_url('admin/pages/' . $page['id'] . '/modifier') ?>">Modifier</a>
                <form method="post" action="<?= site_url('admin/pages/' . $page['id'] . '/supprimer') ?>">
                    <?= csrf_field() ?>
                    <button class="btn danger" type="submit">Supprimer</button>
                </form>
            </div>
        </article>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>
