<aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: auto;">
    <!-- Brand Logo -->
    <a href="/jadminlte/principal.php" class="brand-link">
        <img src="https://cdn.pixabay.com/photo/2017/02/20/18/03/cat-2083492_1280.jpg" class="brand-image img-circle elevation-2">
        <span class="brand-text font-weight-light"><b>Teste do Catinho</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <ul class="nav nav-treeview">
                        <?php
                        $idPerfilSessao = $_SESSION['perfilID'];

                        $menusTemplate = $database->get_results("SELECT 
                                                            permissao.*
                                                            ,menu.link as link
                                                            ,menu.nome as menu_nome
                                                            ,menu.id as menu_id
                                                            FROM permissao
                                                            LEFT JOIN menu on menu.id = permissao.id_menu
                                                            WHERE permissao.id_perfil = $idPerfilSessao and menu.menu_pai is null order by menu.ordem");

                        foreach ($menusTemplate as $menuTemplate) {

                            if ($menuTemplate['link']) {
                                echo '<li class="nav-item">
                                            <a href="/jadminlte/' . $menuTemplate['link'] . '" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>' . $menuTemplate['menu_nome'] . '</p>
                                            </a>
                                        </li>';
                            } else {

                                $menusFilhos = $database->get_results("SELECT 
                                                                            permissao.*
                                                                            ,menu.link as link
                                                                            ,menu.nome as menu_nome
                                                                            FROM permissao
                                                                            LEFT JOIN menu on menu.id = permissao.id_menu
                                                                            WHERE permissao.id_perfil = $idPerfilSessao and menu.menu_pai=" . $menuTemplate['menu_id'] . " order by menu.ordem");

                                echo '
                                        <li class="nav-item menu-close">
                                            <a href="#" class="nav-link">
                                                <i class="fa fa-wrench nav-icon"></i>
                                                    <p>
                                                        ' . $menuTemplate['menu_nome'] . '
                                                        <i class="right fas fa-angle-left"></i>
                                                    </p>
                                            </a>
                                        <ul class="nav nav-treeview">
                                                ';


                                foreach ($menusFilhos as $menuFilho) {
                                    echo '  <li class="nav-item">
                                                <a href="/jadminlte/' . $menuFilho['link'] . '" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>' . $menuFilho['menu_nome'] . '</p>
                                                </a>
                                            </li>';
                                }

                                echo '
                                                </ul>
                                            </li>
                                        ';
                            }
                        }
                        ?>
                        <!-- <li class="nav-item">
                            <a href="/jadminlte/pesquisa.php" class="nav-link">
                                <i class="fas fa-search fa-fw"></i>
                                <p>Pesquisa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-chart-pie nav-icon"></i>
                                <p>Gráficos</p>
                            </a>
                        </li> -->
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/jadminlte/principal.php" class="nav-link">Home</a>
        </li>

    </ul>



    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <li class="nav-item dropdown">
            <?php
            echo '<a style="color: white; margin: 10px">' . $_SESSION['loginUser'] . '</a>';
            ?>
        </li>
        <li class="nav-item dropdown">
            <?php
            // echo '<a class="btn btn-danger" href="/jadminlte/restrito/logout.php">Sair</a>';
            echo '<a class="btn btn-danger" href="/jadminlte/logout.php?token=' . md5(session_id()) . '">Sair</a>';
            ?>

            <!-- <a href="/jadminlte/restrito/logout.php" class="btn btn-danger" data-toggle="dropdown">
                <span>Log Out</span>
            </a> -->

        </li>
    </ul>
</nav>