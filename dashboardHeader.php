<?php
    @session_start();

    ini_set('display_errors','on');

    if(!isset($_SESSION['user'])) {
        header('Location: /login.php');
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/Users/ModelUser.php';

    $modelUser = new ModelUser();
    $user = $modelUser->getUser($_SESSION['email']);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblioteca - Traylabs</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" type="image/png" href="/assets/images/logos/Library.png"/>

</head>
<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="/dashboard.php"><img src="">Biblioteca</a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item dropdown notification-dropdown">
                        <a class="nav-link profile-image" href="#" id="notificationDropdown" data-toggle="dropdown">
                            <img src="/assets/images/users/<?php echo is_null($user->getImage()) ? 'user.svg' : $user->getImage() ?>" alt="profile-img">
                            <span class="online-status online bg-success"></span>
                        </a>
                        <div class="dropdown-menu navbar-dropdown preview-list notification-drop-down dropdownAnimation" aria-labelledby="notificationDropdown">
                            <a class="dropdown-item preview-item" href="/view/profile/editionProfile.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject font-weight-medium">Perfil</p>
                                    <p class="font-weight-light small-text">
                                        Editar Perfil
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item" href="/logoffSystem.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject">Sair</p>
                                    <p class="font-weight-light small-text">
                                        Fazer Logoff
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ml-auto" type="button" data-toggle="offcanvas">
                    <span class="icon-menu icons"></span>
                </button>

            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">
                <!-- Menu lateral -->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item nav-category">
                            <span class="nav-link">Biblioteca</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard.php">
                                <span class="menu-title">Início</span>
                                <i class="fas fa-book"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/view/book/books.php">
                                <span class="menu-title">Livros</span>
                                <i class="fas fa-book"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/view/reader/readers.php">
                                <span class="menu-title">Leitores</span>
                                <i class="fas fa-user-graduate"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/view/genre/genre.php">
                                <span class="menu-title">Gêneros</span>
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/view/author/authors.php">
                                <span class="menu-title">Autores</span>
                                <i class="fas fa-users"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/view/publisher/publishers.php">
                                <span class="menu-title">Editoras</span>
                                <i class="fas fa-address-book"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/view/user/users.php">
                                <span class="menu-title">Usuários</span>
                                <i class="fas fa-user-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#loansItens" aria-expanded="false" aria-controls="ui-advanced">
                                <span class="menu-title">Empréstimos</span>
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                            <div class="collapse" id="loansItens">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link pl-5" href="/view/loan/createLoan.php">Realizar Empréstimo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pl-5" href="/view/loan/loans.php">Listagens de Empréstimo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pl-5" href="/view/loan/returns.php">Listagens de Devoluções</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pl-5" href="/view/loan/cancellations.php">Listagens de Cancelamentos</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="ui-advanced">
                                <span class="menu-title">Relatórios</span>
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                            <div class="collapse" id="reports">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link pl-5" href="/view/report/reportBooks.php">Livros mais Retirados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link pl-5" href="/view/report/reportReaders.php">Leitores mais Frequêntes</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>