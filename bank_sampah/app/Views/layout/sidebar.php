<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= (in_groups(1) ? '/' : '/nasabah/profil'); ?>">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-recycle"></i>
        </div>
        <!-- <i class="fa-solid fa-recycle"></i> -->
        <div class="sidebar-brand-text mx-3">Bank Sampah</div>
    </a>
    <?php if (in_groups(1)) : ?>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            master data
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kategori" aria-expanded="true" aria-controls="kategori">
                <i class="fa-solid fa-tag"></i>
                <span>Kategori</span>
            </a>
            <div id="kategori" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Fitur:</h6>
                    <a class="collapse-item" href="/kategori">View</a>
                    <a class="collapse-item" href="/kategori/create">Tambah</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#barang" aria-expanded="true" aria-controls="barang">
                <i class="fa-solid fa-box"></i>
                <span>Barang</span>
            </a>
            <div id="barang" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Fitur:</h6>
                    <a class="collapse-item" href="/barang">View</a>
                    <a class="collapse-item" href="/barang/create">Tambah</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admin" aria-expanded="true" aria-controls="admin">
                <i class="fa-solid fa-users-gear"></i>
                <span>Admin</span>
            </a>
            <div id="admin" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Fitur:</h6>
                    <a class="collapse-item" href="/admin">View</a>
                    <a class="collapse-item" href="/admin/create">Tambah</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#nasabah" aria-expanded="true" aria-controls="nasabah">
                <i class="fa-solid fa-users"></i>
                <span>Nasabah</span>
            </a>
            <div id="nasabah" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Fitur:</h6>
                    <a class="collapse-item" href="/nasabah">View</a>
                    <a class="collapse-item" href="/nasabah/create">Tambah</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/nasabah/hist">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Histori Tarik Tunai Nasabah</span></a>
        </li>
    <?php endif; ?>
    <?php if (in_groups(2)) : ?>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/nasabah/profil">
                <i class="fa-solid fa-gauge"></i>
                <span>Profil</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/nasabah/histori">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Histori Tarik Tunai</span></a>
        </li>
    <?php endif; ?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Tranksaksi
    </div>
    <?php if (in_groups(2)) : ?>
        <li class="nav-item">
            <a class="nav-link" href="/tranksaksi/nasabah">
                <i class="fa-solid fa-file-invoice"></i>
                <span>View</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/tranksaksi/masuk">
                <i class="fa-solid fa-dolly"></i>
                <span>Masuk</span></a>
        </li>
    <?php endif; ?>
    <?php if (in_groups(1)) : ?>
        <li class="nav-item">
            <a class="nav-link" href="/tranksaksi">
                <i class="fa-solid fa-file-invoice"></i>
                <span>View Masuk</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/tranksaksi/keluars">
                <i class="fa-solid fa-file-invoice"></i>
                <span>View Keluar</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/tranksaksi/masuk">
                <i class="fa-solid fa-dolly"></i>
                <span>Masuk</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/tranksaksi/keluar">
                <i class="fa-solid fa-box-open"></i>
                <span>Keluar</span></a>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->