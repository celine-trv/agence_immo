<?php
require_once("include/init.inc.php");


// DISPLAY BY TYPE with COUNT
$types = $db->query("SELECT DISTINCT(type) FROM logement");
$nb_types = $db->query("SELECT type, COUNT(type) AS 'nb' FROM logement GROUP BY type");

while($nb_type = $nb_types->fetch(PDO::FETCH_ASSOC)) {
    $count_type[$nb_type["type"]] = $nb_type["nb"];
}


if(isset($_GET["type"]) && !empty($_GET["type"]))
{
    $data = $db->prepare("SELECT * FROM logement WHERE type = :type");
    $data->bindValue(":type", htmlspecialchars($_GET["type"]), PDO::PARAM_STR);
    $data->execute();
}
else 
{
    $data = $db->query("SELECT * FROM logement");
}


// HEADER
require_once("include/header.inc.php");
?>


<!-- HTML -->
<div class="row col-lg-11 mx-auto justify-content-between p-0">
    <div class="col-md-3 d-flex flex-column flex-sm-row flex-md-column justify-content-between justify-content-md-start align-items-end text-center pb-3 pt-1">
        <div class="col-sm-6 col-md-12 flex-fill p-0 pr-sm-3 pr-md-0">
            <img src="img/logo_orange.png" alt="logo maison immobilier" class="logo">
            <h2 class="fw_600 fs_2 mt-1 mb-3 mb-sm-0 mb-md-3">Agence immo</h2>
        </div>

        <!-- LIST OF TYPES -->
        <div class="col-sm-6 col-md-12 p-0 pl-sm-3 pl-md-0">
            <div class="list-group shadow rounded mt-3" id="list_types">
                <a href="<?= URL ?>" class="list-group-item text-dark p-3 font-weight-bold text-decoration-none <?= (!isset($_GET['type'])) ? ' active' : '' ?>">
                    <h3 class="font-weight-bold m-0">
                        Tous les biens
                        <span class="badge badge-pill bg-dark txt_green_light" id="badge_all"><?= array_sum($count_type) ?></span>
                    </h3>
                </a>
                
                <?php while($type = $types->fetch(PDO::FETCH_ASSOC)): ?>
                    <a href="<?= $type['type'] ?>" class="list-group-item text-dark p-3 font-weight-bold text-decoration-none <?= (isset($_GET['type']) && $_GET['type'] == $type['type']) ? ' active' : '' ?>">
                        <?= ucfirst($type["type"]) ?>
                        <span class="badge badge-pill bg-dark txt_green_light" id="badge_<?= $type['type'] ?>"><?= $count_type[$type['type']] ?></span>
                    </a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <!-- LOGEMENTS (CARDS) -->
    <div class="col-md-9 card-deck row row-cols-1 row-cols-sm-2 row-cols-lg-1 m-0 p-0 pl-xl-4">
        <?php while($logement = $data->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="col my-3">
                <div class="card shadow h-100 m-0 <?= $logement["type"] ?>">
                    <div class="row no-gutters h-100">
                        <!-- IMG -->
                        <div class="col-lg-6 overflow-hidden">
                            <img class="w-100 h-100" src="<?= $logement["photo_1"] ?>" alt="<?= $logement["titre"] ?>">

                            <?php if(!isset($_GET['type'])): ?>
                                <div class="banner position-relative bg_orange border-bottom border_orange txt_green_light text-center text-nowrap font-weight-bold h6 px-4"><?= ucfirst($logement["type"]) ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- INFOS -->
                        <div class="col-lg-6 d-flex flex-column">
                            <div class="card-body">
                                <h4 class="card-title fw_600 text-center"><?= $logement["titre"] ?></h4>
                                <hr class="bg-success">
                                <p class="h5 fw_600">
                                    <?= ucfirst($logement["type"]) . " : " ?>
                                    <span class="txt_green h4 fw_600"><?= number_format($logement["prix"], 0, ",", "&nbsp;") ?>&nbsp;€</span>
                                    <small><?= $logement["type"] == "location" ? "/mois" : "" ?></small>
                                </p>
                                <p class="h6">
                                    <img src="img/localisation.png" alt="icone localisation ville" height="20px" width="auto" class="align-baseline mr-1">
                                    <span><?= $logement["ville"] ?></span>
                                    <small>(<?= $logement["cp"] ?>)</small>
                                </p>
                                <p class="h6">
                                    <img src="img/infos.png" alt="icone informations logement" height="20px" width="auto" class="align-baseline mr-1">
                                    <span style="margin-left: 2px;">
                                        <?= $logement["nb_pieces"] . ($logement["nb_pieces"] > 1 ? " pièces" : " pièce") ?>
                                        <small><?= $logement["nb_pieces"] == 20 ? " (ou+)" : "" ?></small>
                                        &#8226;
                                        <?= number_format($logement["surface"], 0, ",", "&nbsp;") ?>&nbsp;m²
                                    </span>
                                </p>
                                <p class="card-text mt-3">
                                    <?= strlen($logement["description"]) > 160 ? substr($logement["description"], 0, 160) . "..." : $logement["description"] ?>
                                </p>
                            </div>

                            <div class="card-footer bg_green_light text-center">
                                <a href="detail-logement?id=<?= $logement["id"] ?>" class="btn txt_green_light bg_orange fw_600 px-3">Voir le détail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>


<!-- FOOTER -->
<?php
require_once("include/footer.inc.php");
?>
