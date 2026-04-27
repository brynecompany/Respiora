<?= $this->extend('layout/main_layout') ?>

<?= $this->section('style') ?>
<style>

/* HEADER USER */
.header-user {
    display: flex;
    align-items: center;
    gap: 15px;
    background: linear-gradient(90deg, #081F5C, #5E9ADF);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
}

.header-icon img {
    width: 40px;
    height: 40px;
}

/* CONTAINER USER */
.user-container {
    background: white;
    border-radius: 10px;
    padding: 20px 25px;
    margin-top: 20px;
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
}

/* TOP BAR */
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-box input {
    padding: 8px 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    width: 250px;
}

.btn-add {
    background: #081F5C;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 8px;
}

/* TABLE */
.table-user {
    width: 100%;
    border-collapse: collapse;
}

.table-user th, .table-user td {
    padding: 10px;
    text-align: center;
}

.table-user th {
    color: #555;
    border-bottom: 2px solid #eee;
}

.table-user tr {
    border-bottom: 1px solid #eee;
}

/* ACTION BUTTON */
.btn-action {
    border: none;
    padding: 6px 8px;
    border-radius: 6px;
    color: white;
    margin: 0 2px;
}

.btn-view { background: #2563eb; }
.btn-edit { background: #f59e0b; }
.btn-delete { background: #dc2626; }

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- HEADER -->
<div class="header-user">
    <div class="header-icon">
        <img src="/assets/img/icon_breadcrumb.svg">
    </div>
    <div>
        <h5>Manajemen User</h5>
        <small>Kelola data pengguna sistem</small>
    </div>
</div>

<!-- CONTAINER -->
<div class="user-container">

    <!-- TOP BAR -->
    <div class="top-bar">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari username...">
        </div>

        <button class="btn-add">
            <i class="fa-solid fa-plus"></i> Tambah Data
        </button>
    </div>

    <!-- TABLE -->
    <table class="table-user">
        <thead>
            <tr>
                <th>No</th>
                <th>Role</th>
                <th>Email</th>
                <th>Password</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; foreach($users as $u): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $u['role'] ?></td>
                <td><?= $u['email'] ?></td>
                <td><?= $u['password'] ?></td>
                <td><?= $u['username'] ?></td>
                <td>
                    <button class="btn-action btn-view">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button class="btn-action btn-edit">
                        <i class="fa fa-pen"></i>
                    </button>
                    <button class="btn-action btn-delete">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?= $this->endSection() ?>