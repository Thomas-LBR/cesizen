<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Page de résultat du diagnostic</h1>
<?= view('admin/partials/nav') ?>

<form class="form" method="post">
    <?= csrf_field() ?>

    <section class="panel">
        <div class="field">
            <label for="result-config-selector">Niveau à configurer</label>
            <select id="result-config-selector">
                <?php foreach ($configs as $index => $config): ?>
                    <option value="result-config-<?= esc($config['id']) ?>" <?= $index === 0 ? 'selected' : '' ?>>
                        <?= esc($config['level']) ?>
                        (<?= esc($config['min_score']) ?><?= $config['max_score'] === null ? '+' : ' - ' . esc($config['max_score']) ?> points)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </section>

    <?php foreach ($configs as $config): ?>
        <section id="result-config-<?= esc($config['id']) ?>" class="panel result-config-panel">
            <h2><?= esc($config['level']) ?></h2>
            <div class="grid two">
                <div class="field">
                    <label for="level-<?= esc($config['id']) ?>">Libellé du niveau</label>
                    <input id="level-<?= esc($config['id']) ?>" name="configs[<?= esc($config['id']) ?>][level]" value="<?= esc($config['level']) ?>" required>
                </div>
                <div class="field">
                    <label for="min-score-<?= esc($config['id']) ?>">Score minimum</label>
                    <input id="min-score-<?= esc($config['id']) ?>" type="number" min="0" name="configs[<?= esc($config['id']) ?>][min_score]" value="<?= esc($config['min_score']) ?>" required>
                </div>
            </div>
            <div class="field">
                <label for="max-score-<?= esc($config['id']) ?>">Score maximum</label>
                <input id="max-score-<?= esc($config['id']) ?>" type="number" min="0" name="configs[<?= esc($config['id']) ?>][max_score]" value="<?= esc($config['max_score']) ?>" placeholder="Laisser vide pour aucun maximum">
            </div>
            <div class="field">
                <label for="message-<?= esc($config['id']) ?>">Message affiché</label>
                <textarea id="message-<?= esc($config['id']) ?>" name="configs[<?= esc($config['id']) ?>][message]" required><?= esc($config['message']) ?></textarea>
            </div>
        </section>
    <?php endforeach; ?>

    <div class="actions">
        <button class="btn" type="submit">Enregistrer la configuration</button>
    </div>
</form>

<script>
const selector = document.querySelector('#result-config-selector');
const panels = document.querySelectorAll('.result-config-panel');

function showSelectedResultConfig() {
    panels.forEach((panel) => {
        panel.hidden = panel.id !== selector.value;
    });
}

selector.addEventListener('change', showSelectedResultConfig);
showSelectedResultConfig();
</script>
<?= $this->endSection() ?>
