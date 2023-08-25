<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> -->

    <title>Site do Catinho</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../AdminLTE-3.2.0/dist/css/adminlte.min.css">
</head>

<body>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="./index.php" class="brand-link">
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
                            <li class="nav-item menu-close">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-wrench nav-icon"></i>
                                    <p>
                                        Sistema
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../usuarios/usuarios.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Usuário</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../perfil/perfil.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Perfil</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Parâmetros</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Configurações</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-search fa-fw"></i>
                                    <p>Pesquisa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-chart-pie nav-icon"></i>
                                    <p>Gráficos</p>
                                </a>
                            </li>
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
                <a href="./index.php" class="nav-link">Home</a>
            </li>

        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="btn btn-danger" data-toggle="dropdown" href="#">
                    <span>Log Out</span>
                </a>
            </li>
        </ul>
    </nav>


    <!-- jQuery -->
    <script src="../../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- <script src="../../AdminLTE-3.2.0/dist/js/demo.js"></script> -->

</body>

</html>