<?php
    require_once("db_object_patient.php");

    $dao= new DAO();
    if ($dao->getERROR()) {
        print "erreur: ".$dao->getError();
    }
    $item=$dao->getNomPrenom("mutuelle.nom as mutuelle,praticien.nom as praticienN,praticien.prenom as praticienP,praticien.sexe as praticienS,patient.nom,patient.prenom,patient.sexe,patient.nom_naissance,patient.date_naissance,patient.telephone_portable,patient.telephone_fixe,patient.email,patient.adresse1,patient.adresse2,patient.code_postal,patient.ville,patient.pays,patient.numero_securite_sociale",1);   
    // print_r($item);
    $doc=$dao->getDocuments(1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="patient_home.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Home patient</title>
</head>
<body>

<div class="container"><h3><?= $item[0]["sexe"]?>. <?= $item[0]["nom"]?> <?= $item[0]["prenom"]?></h3></div>
<div id="exTab1" class="container">	
    <ul class="nav nav-pills">
        <li class="active"><a  href="#1a" data-toggle="tab">Vos informations personnelle</a>
        </li>
        <li><a href="#2a" data-toggle="tab">Prendre rendez-vous</a>
        </li>
        <li><a href="#3a" data-toggle="tab">Envoi de document</a>
        </li>
    </ul>
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="1a">
            <h7>yo</h7>
            <div class="white_background_conteneur">
                <div id="conteneur_type_information">
                    <br>
                    <br>
                    <br>Sexe <br>
                    <br>Nom <br>
                    <br>Prénom <br>
                    <br>Nom de naissance <br>
                    <br>Date de naissance <br>
                    <br>Téléphone portable <br>
                    <br>Téléphone fixe<br>
                    <br>Email<br>
                    <br>Adresse1 <br>
                    <br>Adresse2 <br>
                    <br>Code postal <br>
                    <br>Ville <br>
                    <br>Pays <br>
                    <br>
                    <hr>
                    <br>
                    <br>Numéros de securité social <br>
                    <br>Praticien <br>
                    <br>Mutuelle <br>
                    <br>
                </div>
                <div id="conteneur_information">
                    <br>
                    <br>
                    <br><?= $item[0]["sexe"]?><br>
                    <br><?= $item[0]["nom"]?><br>
                    <br><?= $item[0]["prenom"]?><br>
                    <br><?= $item[0]["nom_naissance"]?><br>
                    <br><?= date("d/m/Y", strtotime($item[0]["date_naissance"]));?><br>
                    <br><?= $item[0]["telephone_portable"]?><br>
                    <br><?= $item[0]["telephone_fixe"]?><br>
                    <br><?= $item[0]["email"]?><br>
                    <br><?= $item[0]["adresse1"]?><br>
                    <br><?= $item[0]["adresse2"]?><br>
                    <br><?= $item[0]["code_postal"]?><br>
                    <br><?= $item[0]["ville"]?><br>
                    <br><?= $item[0]["pays"]?><br>
                    <br>
                    <hr>
                    <br>
                    <br><?= $item[0]["numero_securite_sociale"]?><br>
                    <?php $nomination="";
                    if ($item[0]["praticienS"]=="M"){
                        $nomination="M.";
                    }else{
                        $nomination="Mme. ";
                    }?>
                    <br><?=$nomination.$item[0]["praticienN"]." ".$item[0]["praticienP"]?><br>
                    <br><?= $item[0]["mutuelle"]?><br>
                    <br>
                </div>
            </div>
            test

        </div>
        <div class="tab-pane" id="2a">
            <h7>grave</h7>
            <div class="white_background_conteneur">
            </div>
        </div>
        <div class="tab-pane" id="3a">
            <h7>grave</h7>
            <div class="white_background_conteneur">
                
                <form action="file-upload.php" method="post" enctype="multipart/form-data" class="mb-3" id="form_envoi">
                    <h3 class="text-center mb-5">Envoiller un fichier</h3>

                    <div class="user-image mb-3 text-center">
                        <div style="width: 100px; height: 100px; overflow: hidden; background: #cccccc; margin: 0 auto">
                            <img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder" alt="">
                        </div>
                    </div>
                    <span id="texte_fichier_uniquement">Uniquement des fichier jpg, png, jpeg et pdf</span>
                    <div class="custom-file" id="div_file_upload">
                        <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile">
                        <label class="custom-file-label" for="chooseFile" id="choisirFichier">Choisir le fichier</label>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                        envoie
                    </button>
                    <!-- echo '<script type="text/javascript">window.alert("'.$documents.'");</script>'; -->
                </form>

                <div id="table_historique">
                    <div id="titre_historique">Historique des envois de fichiers :</div>
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>Nom du fichier</th>
                                <th>Date d'envoi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i=0;$i<count($doc) ;$i++) { 
                                echo '<tr value='.$doc[$i]["hex"].'>'; 
                                echo "<th>".$doc[$i]["titre"]."</th>";
                                echo "<th>".date("d/m/Y h:i", strtotime($doc[$i]["dateE"]))."</th>";  //hh:mm
                                echo "</tr>";
                            }?>
                        </tbody>
                    </table>
                </div>
                <img id="img_historique" src="">

            </div>
            test
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>


<script>
    $(document).ready( function () {
        $('#table_id').DataTable();

        $('#table_id tbody').on('mouseover', 'tr', function () {
            
            var hex_data=$(this).attr('value');
            // var src_image=hex_data.replace(/(.{6})(?=.)/g,"$1 "); //\n
            console.log(hex_data);

            $('#img_historique').attr('src', 'data:image/png;base64,'+hex_data);

            // <img src="data:image/png;base64," alt="Red dot" />

        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgPlaceholder').attr('src', e.target.result);
                document.getElementById("choisirFichier").innerHTML = input.files[0].name;
            }

            // base64 string conversion
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#chooseFile").change(function () {
        readURL(this);
    });
</script>

</body>
</html>