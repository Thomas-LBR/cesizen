<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Questionnaire diagnostic</h1>
<?= view('admin/partials/nav') ?>
<p><a class="btn" href="<?= site_url('admin/diagnostic/creer') ?>">Ajouter un événement</a></p>

<div class="table-wrap">
    <table>
        <thead>
        <tr>
            <th>Événement</th>
            <th>Points</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?= esc($event['label']) ?></td>
                <td><?= esc($event['points']) ?></td>
                <td><?= $event['is_active'] ? 'Actif' : 'Masqué' ?></td>
                <td class="actions">
                    <a class="btn secondary" href="<?= site_url('admin/diagnostic/' . $event['id'] . '/modifier') ?>">Modifier</a>
                    <form method="post" action="<?= site_url('admin/diagnostic/' . $event['id'] . '/statut') ?>">
                        <?= csrf_field() ?>
                        <button class="btn secondary" type="submit"><?= $event['is_active'] ? 'Masquer' : 'Activer' ?></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
