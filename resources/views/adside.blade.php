<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>MIKOLO</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Mikolo</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a href="/">
                                <button style="width: 150px;" type="button" class="btn btn-primary">Deconnexion</button>
                            </a>

                </li><!-- End Notification Nav -->

                {{-- <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                </li><!-- End Messages Nav --> --}}

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Statistique</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/statistique/totalventeglobal" class="active">
                            <i class="bi bi-circle"></i><span>Total vente global</span>
                        </a>
                    </li>
                    <li>
                        <a href="/statistique/totalventepv" class="active">
                            <i class="bi bi-circle"></i><span>Total vente par point de vente</span>
                        </a>
                    </li>
                    <li>
                        <a href="/statistique/benefice" class="active">
                            <i class="bi bi-circle"></i><span>Benefice</span>
                        </a>
                    </li>
                    <li>
                        <a href="/statistique/commission" class="active">
                            <i class="bi bi-circle"></i><span>Commission</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/laptop/liste">
                    <i class="bi bi-grid"></i>
                    <span>Laptop</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/pointvente/liste">
                    <i class="bi bi-grid"></i>
                    <span>Point de vente</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link collapsed" href="/processeur/listecore">
                    <i class="bi bi-journal"></i>
                    <span>Processeur</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/marque/liste">
                    <i class="bi bi-journal"></i>
                    <span>Marque</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/ram/listetype">
                    <i class="bi bi-journal"></i>
                    <span>Ram</span>
                </a>
            </li>
              <li class="nav-item">
                <a class="nav-link collapsed" href="/ecran/listeresolution">
                    <i class="bi bi-list"></i>
                    <span>Ecran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/disquedur/listetype">
                    <i class="bi bi-list"></i>
                    <span>Disque Dur</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/pointvente/pv_affectation">
                    <i class="bi bi-list"></i>
                    <span>Affectation</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/magasin/arrivage">
                    <i class="bi bi-list"></i>
                    <span>Achat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/magasin/reception">
                    <i class="bi bi-list"></i>
                    <span>Reception renvoi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/magasin/mouvement">
                    <i class="bi bi-list"></i>
                    <span>Stock</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/magasin/transfert">
                    <i class="bi bi-list"></i>
                    <span>Transfert</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->



            <li class="nav-heading">Pages</li>


        </ul>

    </aside><!-- End Sidebar-->
    <main id="main" class="main">

        <section class="section">
            @yield('content')
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/chart.js/chart.min.js"></script>
    <script src="/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/assets/vendor/quill/quill.min.js"></script>
    <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>

</body>

</html>
