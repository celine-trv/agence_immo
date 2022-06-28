<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- meta tag -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Celine Trv">
    <meta name="description" content="Agence immo logement immobilier">

    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- favicon -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">

    <title>Immobilier - achat ou location</title>
</head>

<body>
    <div class="container-fluid min-vh-100 overflow-hidden d-flex flex-column justify-content-between bg_green_light text-dark p-0">
        <header class="bg_green txt_green_light">
            <!-- nav -->
            <div class="position-relative parent_absolute">
                <nav class="navbar navbar-expand-sm navbar-dark bg_green fixed-top py-2 py-sm-0 mb-4">
                    <a class="navbar-brand d-flex align-items-center txt_green_light pt-0" href="<?= URL ?>">
                        <img src="img/logo_orange.png" alt="logo maison Agence Immo" width="30" height="26" class="mt-1">
                        <h1 class="h4 fw_600 mb-0 ml-2 pl-1">Agence immo</h1>
                    </a>

                    <!-- btn burger -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse mt-2 mt-sm-0" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link h6 txt_green_light fw_600 m-0 p-3" href="<?= URL ?>">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link h6 txt_green_light fw_600 m-0 p-3" href="<?= URL ?>gestion-logements">Gestion logements</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <main class="w-100 mx-auto my-3 py-3">
