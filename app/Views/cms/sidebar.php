<div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="<?= base_url() . '/dashboard' ?>">
                <span class="align-middle">AdminKit</span>
            </a>

            <?php
            $uri = service('uri');
            $pages = [
                // Sidebar items:
                [
                    'text' => 'Dashboard',
                    'url'  => 'dashboard',
                    'icon' => 'bi bi-house-door'
                ],
                [
                    'text' => 'Kelola Pengguna',
                    'url'  => 'users',
                    'icon' => 'bi bi-people'
                ],
            ]
            ?>

            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Pages
                </li>

                <?php foreach ($pages as $page) : ?>
                    <li class="sidebar-item <?= $uri->getSegment(1) == $page['url'] ? 'active' : '' ?>">
                        <a class="sidebar-link" href="<?= base_url() . '/' . $page['url'] ?>">
                            <i class="align-middle <?= $page['icon'] ?> fs-18"></i> <span class="align-middle"><?= $page['text'] ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>



                <?php
                $menu = [
                    // Sidebar items:
                    [
                        'text' => 'Data Supplier',
                        'url'  => 'supplier',
                        'icon' => 'bi bi-card-list'
                    ],
                    [
                        'text' => 'Data Barang',
                        'url'  => 'barang',
                        'icon' => 'bi bi-box2'
                    ],
                    [
                        'text' => 'Data Stok',
                        'url'  => 'stok',
                        'icon' => 'bi bi-view-stacked'
                    ],
                    [
                        'text' => 'Kategori',
                        'url'  => 'kategori',
                        'icon' => 'bi bi-bookmarks'
                    ],
                ]
                ?>


                <li class="sidebar-header">
                    Menu

                </li>
                <?php foreach ($menu as $m) : ?>
                    <li class="sidebar-item <?= $uri->getSegment(1) == $m['url'] ? 'active' : '' ?>">
                        <a class="sidebar-link" href="<?= base_url() . '/' . $m['url'] ?>">
                            <i class="align-middle <?= $m['icon'] ?> fs-18"></i> <span class="align-middle"><?= $m['text'] ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>



        </div>
    </nav>

    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">

                    <div class="dropdown">
                        <a class="nav-link" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

                            <!-- USER LOGIN SESSION -->
                            <?php
                            foreach (session()->get('user') as $userSession) :
                                $user = model('UserModel')->where(['id' => $userSession['id']])->first();
                            endforeach;
                            ?>

                            <img src="<?= $user['foto'] != '' ? base_url() . '/cms/img/users/' . $user['foto'] : base_url() . '/cms/img/users/default.png' ?>"" class=" avatar img-style rounded-circle me-1" alt="Fatwa Aulia" /> <span class="text-dark"><?= (strlen($user['nama']) > 15) ? substr($user['nama'], 0, 15) . '...' : $user['nama'] ?></span> <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="<?= base_url() . '/user/profile/' . model('UserModel')->encId($user['id']) ?>"><i class="bi bi-person me-1"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-1"></i> Pengaturan</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url() . '/AuthController/logout' ?>"><i class="bi bi-arrow-bar-left me-1"></i> Keluar</a></li>
                        </ul>
                    </div>

                </ul>
            </div>
        </nav>