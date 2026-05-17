<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Utilisateurs</h1>
<?= view('admin/partials/nav') ?>

<div class="table-wrap">
    <table>
        <thead>
        <tr>
            <th>Utilisateur</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['firstname'] . ' ' . $user['lastname']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td>
                    <form method="post" action="<?= site_url('admin/utilisateurs/' . $user['id'] . '/role') ?>">
                        <?= csrf_field() ?>
                        <select name="role" onchange="this.form.submit()">
                            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrateur</option>
                        </select>
                    </form>
                </td>
                <td><?= $user['is_active'] ? 'Actif' : 'Désactivé' ?></td>
                <td class="actions">
                    <form method="post" action="<?= site_url('admin/utilisateurs/' . $user['id'] . '/statut') ?>">
                        <?= csrf_field() ?>
                        <button class="btn secondary" type="submit"><?= $user['is_active'] ? 'Désactiver' : 'Activer' ?></button>
                    </form>
                    <form method="post" action="<?= site_url('admin/utilisateurs/' . $user['id'] . '/supprimer') ?>">
                        <?= csrf_field() ?>
                        <button class="btn danger" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
