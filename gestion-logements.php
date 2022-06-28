<?php
require_once("include/init.inc.php");


// FORM
if($_POST)
{
    // CHECKING FIELDS
    $border = 'border border_orange rounded';

    if(empty($_POST["titre"]) || strlen($_POST["titre"]) > 255) {
        $error_titre = "<div class='error_msg font-italic txt_orange mx-1'><small> Compléter le titre </small></div>"; 
        $error = true;
    }

    if(empty($_POST["cp"]) || !preg_match("#^[0-9]{5}$#", $_POST["cp"])) {
        $error_cp = "<div class='error_msg font-italic txt_orange mx-1'><small> Compléter le code postal </small></div>"; 
        $error = true;
    }

    if(empty($_POST["ville"]) || strlen($_POST["titre"]) > 255) {
        $error_ville = "<div class='error_msg font-italic txt_orange mx-1'><small> Compléter la ville </small></div>"; 
        $error = true;
    }

    if(empty($_POST["nb_pieces"]) || !is_numeric($_POST["nb_pieces"]) || $_POST["nb_pieces"] < 1 || $_POST["nb_pieces"] > 20) {
        $error_nb_pieces = "<div class='error_msg font-italic txt_orange mx-1'><small> Sélectionner le nbre de pièces </small></div>"; 
        $error = true;
    }

    if(empty($_POST["surface"]) || !preg_match("#^[0-9]{1,5}$#", $_POST["surface"])) {
        $error_surface = "<div class='error_msg font-italic txt_orange mx-1'><small> Compléter la surface (au m²) </small></div>"; 
        $error = true;
    }

    if(empty($_POST["prix"]) || !preg_match("#^[0-9]{1,9}$#", $_POST["prix"])) {
        $error_prix = "<div class='error_msg font-italic txt_orange mx-1'><small> Compléter le prix (sans cts) </small></div>"; 
        $error = true;
    }

    if(empty($_POST["type"]) || $_POST["type"] != "location" && $_POST["type"] != "vente") {
        $error_type = "<div class='error_msg font-italic txt_orange mx-1'><small> Sélectionner un type </small></div>"; 
        $error = true;
    }


    // CHECKING IMG
    if(isset($_FILES["img"]) && !empty($_FILES["img"]["tmp_name"][0]))      // first img is required
    {
        // directory
        $directory = "img/logements";

        // create directory
        if(file_exists(ROOT . "$directory") != 1) {
            mkdir(ROOT . "$directory", 0777, false);
        }

        $time = time();
        
        // loop for processing of each img (3 max)
        for ($i = 0; $i < 3; $i++)
        { 
            if(!empty($_FILES["img"]["tmp_name"][$i]) && is_uploaded_file($_FILES["img"]["tmp_name"][$i]))
            {
                $img_info = new SplFileInfo($_FILES["img"]["name"][$i]);
        
                $img_extension = strtolower($img_info->getExtension());
        
                if(array_search($img_extension, ["jpg", "png", "jpeg"]) === false)      // check extension
                {
                    $error_img[$i] = "<div class='error_msg font-italic txt_orange mx-1'><small> Sélectionner une photo .jpg, .png ou .jpeg </small></div>";
                    $error = true;
                }
                elseif($_FILES["img"]["size"][$i] > 5 * 1024 * 1024)      // check size (5 Mo max)
                {
                    $error_img[$i] = "<div class='error_msg font-italic txt_orange mx-1'><small> Sélectionner une photo inférieure à 5 Mo </small></div>";
                    $error = true;
                }
                elseif(!isset($error))
                {
                    $img_name = "logement_" . $time . "_" . ($i+1) . "." . $img_extension;   // rename img
        
                    $img_url[$i] = "$directory/$img_name";          // URL
        
                    $img_path = ROOT . "$directory/$img_name";      // directory path in server
        
                    copy($_FILES["img"]["tmp_name"][$i], $img_path);
                }
            }
        }
    }
    else 
    {
        $error_img[0] = "<div class='error_msg font-italic txt_orange mx-1'><small> Sélectionner une photo </small></div>"; 
        $error = true;
    }
    

    // INSERT QUERY DB
    if(!isset($error)) {
    
        $data = $db->prepare("INSERT INTO logement (titre, ville, cp, nb_pieces, surface, prix, photo_1, photo_2, photo_3, type, description) VALUES (:titre, :ville, :cp, :nb_pieces, :surface, :prix, :photo_1, :photo_2, :photo_3, :type, :description)");

        $data->bindValue(":titre", htmlspecialchars(trim($_POST["titre"])), PDO::PARAM_STR);
        $data->bindValue(":cp", htmlspecialchars(trim($_POST["cp"])), PDO::PARAM_INT);
        $data->bindValue(":ville", htmlspecialchars(trim(ucfirst($_POST["ville"]))), PDO::PARAM_STR);
        $data->bindValue(":nb_pieces", htmlspecialchars(trim($_POST["nb_pieces"])), PDO::PARAM_INT);
        $data->bindValue(":surface", htmlspecialchars(trim($_POST["surface"])), PDO::PARAM_INT);
        $data->bindValue(":prix", htmlspecialchars(trim($_POST["prix"])), PDO::PARAM_INT);
        $data->bindValue(":photo_1", $img_url[0], PDO::PARAM_STR);
        $data->bindValue(":photo_2", isset($img_url[1]) ? $img_url[1] : NULL, PDO::PARAM_STR);
        $data->bindValue(":photo_3", isset($img_url[2]) ? $img_url[2] : NULL, PDO::PARAM_STR);
        $data->bindValue(":type", htmlspecialchars(trim($_POST["type"])), PDO::PARAM_STR);
        $data->bindValue(":description", htmlspecialchars(trim($_POST["description"])), PDO::PARAM_STR);
        $data->execute();

        $success_insert = "<div class='col-md-10 mx-auto alert text-center txt_green font-italic fw_600 my-4' id='success_insert' style='border: solid 1px;'><span class='mr-2'>&#10004;</span> Logement ajouté avec succès </div>";

        $_POST["titre"] = "";
        $_POST["cp"] = "";
        $_POST["ville"] = "";
        $_POST["nb_pieces"] = "";
        $_POST["surface"] = "";
        $_POST["prix"] = "";
        $_POST["type"] = "";
        $_POST["description"] = "";
    }
}

// QUERY DB ALL LOGEMENTS
$data_all = $db->query("SELECT * FROM logement");


// HEADER
require_once("include/header.inc.php");
?>


<!-- HTML -->
<div class="col-xl-11 mx-auto justify-content-between">
    <h2 class="fw_600 fs_2 text-center text-dark px-2">Gestion logements</h2>

    <?php if(isset($success_insert)) echo $success_insert ?>

    <div class="col-md-10 col-lg-9 col-xl-8 mx-auto my-4 p-0 px-sm-3">
        <div class="text-center">
            <button type="button" class="btn bg_orange txt_green_light fw_600 px-3 my-2" data-toggle="collapse" data-target="#form_logement" aria-expanded="false" aria-controls="form_logement">Ajouter un logement</button>
            <button type="button" class="close txt_orange" data-toggle="collapse" data-target="#form_logement" aria-expanded="false" aria-controls="form_logement" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        

        <!-- FORM -->
        <form method="post" id="form_logement" class="collapse<?= isset($error) ? " show" : "" ?>" enctype="multipart/form-data" novalidate>
            <div class="form-row justify-content-between">
                <div class="form-group col-sm-6">
                    <label for="titre" class="mx-1 mb-1">Titre <span class="txt_orange"> *</span></label>
                    <input type="text" name="titre" id="titre" class="form-control <?php if(isset($error_titre)) echo $border; ?>" placeholder="Indiquer le titre de l'annonce" value="<?php if(isset($_POST["titre"])) echo $_POST["titre"]?>">
                    <?php if(isset($error_titre)) echo $error_titre ?>
                </div>

                <div class="form-group col-sm-6 form-row mx-0">
                    <div class="col pl-0">
                        <label for="nb_pieces" class="mx-1 mb-1">Nbre de pièces <span class="txt_orange"> *</span></label>
                        <select name="nb_pieces" id="nb_pieces" class="form-control text-secondary <?php if(isset($error_nb_pieces)) echo $border; ?>">
                            <option selected disabled value="">Sélectionner...</option>
                            <?php for($i = 1; $i <= 20; $i++): ?>
                                <option value="<?= $i ?>" <?php if(isset($_POST["nb_pieces"]) && $_POST["nb_pieces"] == $i) echo "selected" ?>><?= $i == 20 ? $i . " et +" : $i ?></option>
                            <?php endfor; ?>
                        </select>
                        <?php if(isset($error_nb_pieces)) echo $error_nb_pieces ?>
                    </div>
                    <div class="col pr-0">
                        <label for="surface" class="mx-1 mb-1">Surface <span class="txt_orange"> *</span></label>
                        <input type="number" name="surface" id="surface" class="form-control <?php if(isset($error_surface)) echo $border; ?>" placeholder="Arrondir au m²" value="<?php if(isset($_POST["surface"])) echo $_POST["surface"] ?>">
                        <?php if(isset($error_surface)) echo $error_surface ?>
                    </div>
                </div>
            </div>

            <div class="form-row justify-content-between">
                <div class="form-group col-sm-6 form-row mx-0">
                    <div class="col pl-0">
                        <label for="prix" class="mx-1 mb-1">Prix (en €) <span class="txt_orange"> *</span></label>
                        <input type="number" name="prix" id="prix" class="form-control <?php if(isset($error_prix)) echo $border; ?>" placeholder="Sans cts" value="<?php if(isset($_POST["prix"])) echo $_POST["prix"] ?>">
                        <?php if(isset($error_prix)) echo $error_prix ?>
                    </div>
                    <div class="col pr-0">
                        <label for="cp" class="mx-1 mb-1">Code postal <span class="txt_orange"> *</span></label>
                        <input type="number" name="cp" id="cp" class="form-control <?php if(isset($error_cp)) echo $border; ?>" placeholder="CP à 5 chiffres" value="<?php if(isset($_POST["cp"])) echo $_POST["cp"] ?>">
                        <?php if(isset($error_cp)) echo $error_cp ?>
                    </div>
                </div>

                <div class="form-group col-sm-6">
                    <label for="ville" class="mx-1 mb-1">Ville <span class="txt_orange"> *</span></label>
                    <input type="text" name="ville" id="ville" class="form-control <?php if(isset($error_ville)) echo $border; ?>" placeholder="Indiquer la ville du logement" value="<?php if(isset($_POST["ville"])) echo $_POST["ville"] ?>">
                    <?php if(isset($error_ville)) echo $error_ville ?>
                </div>
            </div>

            <div class="form-row justify-content-between">
                <fieldset class="form-group custom-file col-sm-6 h-100 mb-3">
                    <legend class="mx-1 mb-1">Photo 1 <small class="font-italic"> (principale)</small> <span class="txt_orange"> *</span></legend>
                    <input type="file" name="img[]" id="photo_1" class="custom-file-input px-2 py-1" accept=".jpg, .png, .jpeg">
                    <label for="photo_1" class="custom-file-label text-secondary mx-1 mb-0 <?php if(isset($error_img[0])) echo $border; ?>" data-browse="Parcourir">Sélectionner une photo</label>
                    <?php if(isset($error_img[0])) echo $error_img[0] ?>
                </fieldset>
                
                <fieldset class="form-group custom-file col-sm-6 h-100 mb-3">
                    <legend class="mx-1 mb-1">Photo 2 <small class="font-italic"> (optionnel)</small></legend>
                    <input type="file" name="img[]" id="photo_2" class="custom-file-input px-2 py-1" accept=".jpg, .png, .jpeg">
                    <label for="photo_2" class="custom-file-label text-secondary mx-1 mb-0 <?php if(isset($error_img[1])) echo $border; ?>" data-browse="Parcourir">Sélectionner une photo</label>
                    <?php if(isset($error_img[1])) echo $error_img[1] ?>
                </fieldset>
            </div>

            <div class="form-row justify-content-between">
                <fieldset class="form-group custom-file col-sm-6 h-100 mb-3">
                    <legend class="mx-1 mb-1">Photo 3 <small class="font-italic"> (optionnel)</small></legend>
                    <input type="file" name="img[]" id="photo_3" class="custom-file-input px-2 py-1" accept=".jpg, .png, .jpeg">
                    <label for="photo_3" class="custom-file-label text-secondary mx-1 mb-0 <?php if(isset($error_img[2])) echo $border; ?>" data-browse="Parcourir">Sélectionner une photo</label>
                    <?php if(isset($error_img[2])) echo $error_img[2] ?>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <legend class="mx-1 mb-1">Type <span class="txt_orange"> *</span></legend>
                    <div class="form-control bg-transparent <?php if(isset($error_type)) echo $border; else echo "border-0"?>">
                        <div class="form-check form-check-inline">
                            <input type="radio" name="type" id="type_1" class="form-check-input mr-2" value="location" <?php if(isset($_POST["type"]) && $_POST["type"] == "location") echo "checked"; ?>>
                            <label for="type_1" class="form-check-label">Location</label>
                        </div>
                        <div class="form-check form-check-inline mr-0">
                            <input type="radio" name="type" id="type_2" class="form-check-input mr-2 ml-5" value="vente" <?php if(isset($_POST["type"]) && $_POST["type"] == "vente") echo "checked"; ?>>
                            <label for="type_2" class="form-check-label">Vente</label>
                        </div>
                    </div>
                    <?php if(isset($error_type)) echo $error_type ?>
                </fieldset>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="description" class="mx-1 mb-1">Description <small class="font-italic"> (optionnel)</small></label>
                    <textarea type="text" name="description" id="description" class="form-control" placeholder="Décrire le logement (taille, pièces, emplacement, atouts, etc...)" rows="4"><?php if(isset($_POST["description"])) echo $_POST["description"] ?></textarea>
                </div>
                
                <small class="font-italic w-100 text-right pr-3"><span class="txt_orange"> *</span> Ces champs sont obligatoires</small>
            </div>

            <div class="text-center">
                <button type="reset" class="btn border border_orange txt_orange fw_600 px-3 mx-3 my-3 my-sm-2" data-toggle="collapse" data-target="#form_logement" aria-expanded="false" aria-controls="form_logement">Annuler</button>
                <button type="submit" class="btn bg_orange txt_green_light fw_600 px-3 mx-3 my-3 my-sm-2">Ajouter</button>
            </div>
        </form>
    </div>


    <!-- ALL LOGEMENTS <table> -->
    <table class="table table-striped table-responsive table-bordered border-0 text-center text-dark px-0 mx-auto mt-5">
        <tr>
            <?php for($i = 0; $i < $data_all->columnCount(); $i++): ?>
                <?php $col = $data_all->getColumnMeta($i); ?>
                <th class="bg_green txt_green_light p-2"> <?= strtoupper($col["name"]) ?> </th>
            <?php endfor; ?>
        </tr>


        <?php while($logement = $data_all->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <?php foreach($logement as $key => $value): ?>

                    <?php if(substr($key, 0, strlen("photo")) === "photo"): ?>
                        <td class="align-middle p-2">
                            <?php if(!is_null($value) && !empty($value)): ?>
                                <img src="<?= $value ?>" alt="<?= $logement["titre"] ?>" width="110px" height="auto">
                            <?php else: ?>
                                <span class="font-italic">NULL</span>
                            <?php endif; ?>
                        </td>
                    <?php elseif($key == "surface"): ?>
                        <td class="align-middle p-2"><?= number_format($value, 0, ",", "&nbsp;") ?>&nbsp;m²</td>
                    <?php elseif($key == "prix"): ?>
                        <td class="align-middle p-2"><?= number_format($value, 0, ",", "&nbsp;") ?>&nbsp;€</td>
                    <?php elseif($key == "description" && strlen($logement["description"]) > 55): ?>
                        <td class="align-middle p-2"><?= substr($value, 0, 55) . "..." ?></td>
                    <?php else: ?>
                        <td class="align-middle p-2"><?= $value ?></td>
                    <?php endif; ?>

                <?php endforeach; ?>
                
                <td class="align-middle p-2">
                    <a href="detail-logement?id=<?= $logement["id"] ?>" target="blank" class="bg_orange txt_green_light fw_600 txt_green text-decoration-none rounded py-2 px-1">Consulter</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>


<!-- FOOTER -->
<?php
require_once("include/footer.inc.php");
?>
