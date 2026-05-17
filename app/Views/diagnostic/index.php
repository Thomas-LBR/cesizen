<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Diagnostic de stress</h1>
<p class="lead">Sélectionnez les événements vécus récemment. Le score est calculé avec l’échelle de Holmes et Rahe.</p>

<form method="post" action="<?= site_url('diagnostic/calculer') ?>">
    <?= csrf_field() ?>
    <div class="checkbox-list">
        <?php foreach ($events as $event): ?>
            <label class="check-item">
                <input type="checkbox" name="events[]" value="<?= esc($event['id']) ?>">
                <span><?= esc($event['label']) ?><br><strong><?= esc($event['points']) ?> points</strong></span>
            </label>
        <?php endforeach; ?>
    </div>
    <div class="actions">
        <button class="btn" type="submit">Calculer mon score</button>
    </div>
</form>
<?= $this->endSection() ?>
