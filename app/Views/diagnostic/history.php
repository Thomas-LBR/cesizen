<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Mes résultats</h1>
<div class="table-wrap">
    <table>
        <thead>
        <tr>
            <th>Date</th>
            <th>Score</th>
            <th>Niveau</th>
            <th>Événements</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $result): ?>
            <tr>
                <td><?= esc($result['created_at']) ?></td>
                <td><strong><?= esc($result['score']) ?></strong></td>
                <td><?= esc($result['level']) ?></td>
                <td><?= esc(implode(', ', json_decode($result['selected_events'], true) ?: [])) ?></td>
            </tr>
        <?php endforeach; ?>
        <?php if (! $results): ?>
            <tr><td colspan="4">Aucun diagnostic enregistré.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
