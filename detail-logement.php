<?php
require_once("include/init.inc.php");


// CHECKING ID IN URL
if(isset($_GET["id"]) && !empty($_GET["id"]))
{
    // CHECKING ID (regex)
    if(!preg_match("#^[0-9]+$#", $_GET["id"]))
    {
        $alert = "<div class='col-md-10 mx-auto alert border_orange text-center txt_orange font-italic fw_600 mt-4 mt-xl-5 mb-5'> L'identifiant du logement doit être un nombre </div>";
    }
    else
    {
        // QUERY DB
        $data = $db->prepare("SELECT * FROM logement WHERE id = :id");
        $data->bindValue(":id", htmlspecialchars($_GET["id"]), PDO::PARAM_INT);
        $data->execute();

        if($data->rowCount() == 1)
        {
            $logement = $data->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            $alert = "<div class='col-md-10 mx-auto alert border_orange text-center txt_orange font-italic fw_600 mt-4 mt-xl-5 mb-5'> Le logement n'existe pas ou a été supprimé </div>";
        }
    }
}
else
{
    $alert = "<div class='col-md-10 mx-auto alert border_orange text-center txt_orange font-italic fw_600 mt-4 mt-xl-5 mb-5'> Identification du logement impossible </div>";
}


// ARRAY IMG CAROUSEL
$search = "photo";
if(isset($logement)) {
    foreach($logement as $key => $value)
    {
        if(substr($key, 0, strlen($search)) === $search && !is_null($value) && !empty($value))
        {
            $imgs[] = $value;
        }
    }
}


// HEADER
require_once("include/header.inc.php");
?>


<!-- HTML -->
<?php if(isset($alert)): ?>
    <div class="text-center mx-3">
        <h2 class="fw_600 fs_2 text-center text-dark pb-5 mb-5">Logement non trouvé</h2>
        <?= $alert ?>
        <a href="<?= URL ?>" class="btn txt_green_light bg_orange fw_600 mt-5">Retour aux logements</a>
    </div>
<?php endif; ?>


<!-- RESULT LOGEMENT -->
<?php if(isset($_GET["id"]) && !empty($_GET["id"]) && isset($logement)): ?>

    <div class="col-sm-10 col-md-9 col-lg-11 mx-auto px-lg-4">
        <!-- TITLE -->
        <h2 class="fw_600 fs_2 fs_rwd_175 text-center text-dark">
            <?php if(isset($logement["titre"]) && $logement["type"] == "vente"): ?>
                A VENDRE <br> <?= $logement["titre"] ?>
            <?php elseif(isset($logement["titre"]) && $logement["type"] == "location"): ?>
                A LOUER <br> <?= $logement["titre"] ?>
            <?php endif; ?>
        </h2>

        <!-- CAROUSEL & SUMMARY -->
        <div class="row justify-content-between">
            <!-- CAROUSEL -->
            <div class="col-lg-8 py-4 pr-xl-5">
                <div id="carousel_logement" class="carousel slide" data-interval="false">
                    
                    <?php if(sizeof($imgs) > 1): ?>
                        <ol class="carousel-indicators mb-1 mb-sm-2 mb-md-3">
                            <?php for ($i = 0; $i < sizeof($imgs); $i++): ?>
                                <li data-target="#carousel_logement" data-slide-to="<?= $i ?>" class="rounded-circle mx-2<?= $i === 0 ? ' active' : '' ?>"></li>
                            <?php endfor; ?>
                        </ol>
                    <?php endif; ?>


                    <div class="carousel-inner">
                        <?php for ($i = 0; $i < sizeof($imgs); $i++): ?>
                            <div class="carousel-item<?= $i === 0 ? ' active' : '' ?>">
                                <img src="<?= $imgs[$i] ?>" class="d-block w-100" alt="<?= $logement["titre"] ?>">
                            </div>
                        <?php endfor; ?>
                    </div>


                    <?php if(sizeof($imgs) > 1): ?>
                        <button class="carousel-control-prev" type="button" data-target="#carousel_logement" data-slide="prev">
                            <div class="bg_green_light rounded-circle p-2">
                                <span class="carousel-control-prev-icon m-sm-1" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </div>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carousel_logement" data-slide="next">
                            <div class="bg_green_light rounded-circle p-2">
                                <span class="carousel-control-next-icon m-sm-1" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </div>
                        </button>
                    <?php endif; ?>
                    
                </div>
            </div>

            <!-- SUMMARY -->
            <div class="col-lg-4 py-4 d-flex flex-column">
                <h4 class="line d-flex fw_600 mb-4">Résumé</h4>
                <div class="d-flex flex-wrap flex-column flex-sm-row flex-lg-column justify-content-between justify-content-lg-start h-100">
                    <div class="mx-4">
                        <p class="h5 fw_600 mb-3 mb-lg-4">
                            <span class="h6 text-uppercase"><?= ucfirst($logement["type"]) ?> :</span>
                            <span class="txt_green h4 fw_600"><?= number_format($logement["prix"], 0, ",", "&nbsp;") ?>&nbsp;€</span>
                            <small><?= $logement["type"] == "location" ? "/mois" : "" ?></small>
                        </p>
                        <p class="h5 fw_600 mb-3 mb-lg-4">
                            <span class="h6 text-uppercase">Code Postal :</span>
                            <?= $logement["cp"] ?>
                        </p>
                        <p class="h5 fw_600 mb-3 mb-lg-4">
                            <span class="h6 text-uppercase">Ville :</span>
                            <?= $logement["ville"] ?>
                        </p>
                        <p class="h5 fw_600 mb-3 mb-lg-4">
                            <span class="h6 text-uppercase">Pièces :</span>
                            <?= $logement["nb_pieces"] . ($logement["nb_pieces"] > 1 ? " pièces" : " pièce") ?>
                            <small class="fw_600"><?= $logement["nb_pieces"] == 20 ? " (ou+)" : "" ?></small>
                        </p>
                        <p class="h5 fw_600 mb-2 mb-sm-0 mb-lg-3">
                            <span class="h6 text-uppercase ">Surface :</span>
                            <?= number_format($logement["surface"], 0, ",", "&nbsp;") ?>&nbsp;m²
                        </p>
                    </div>

                    <button type="button" id="btn_action" class="btn txt_green_light bg_orange fw_600 px-3 align-self-start align-self-sm-center align-self-lg-start mx-4 mt-4 mt-sm-0 mt-lg-4">
                        <?= $logement["type"] == "location" ? "Louer" : "" ?>
                        <?= $logement["type"] == "vente" ? "Acheter" : "" ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="row">
            <div class="col py-4">
                <h4 class="line d-flex fw_600 mb-4">Description</h4>
                <p class="my-0 mx-4"><?= str_replace("\n", "<br>", $logement["description"]) ?></p>
            </div>
        </div>
    </div>

<?php endif; ?>


<!-- FOOTER -->
<?php
require_once("include/footer.inc.php");
?>
