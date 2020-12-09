<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="praticien_home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Home praticien</title>
</head>
<body>

    <div class="container"><h3>M/Mme nom prenom</h3></div>
    <div id="exTab1" class="container">	
        <ul class="nav nav-pills">
            <li class="active"><a  href="#1a" data-toggle="tab">Liste des patients</a>
            </li>
            <li><a href="#2a" data-toggle="tab">Nouveau patient</a>
            </li>
            <li><a href="#3a" data-toggle="tab">Emplois du temps</a>
            </li>
        </ul>
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="1a">
                <h7>yo</h7>
                <div class="white_background_conteneur">

                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>Sexe+Nom+Prenom</th>
                                <th>Date de naissance</th>
                                <th>Téléphone portable+fixe</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Code postal</th>
                                <th>Ville</th>
                                <th>Pays</th>
                                <th>n° sécuriter social</th>
                                <th>mutuelle</th>
                            </tr>
                        </thead>

                        <!-- passer en for ou foreatch + aller chercher donné dans bdd -->
                        <tbody> 
                            <tr>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                            </tr>
                            <tr>
                                <td>Row 2 Data 1</td>
                                <td>Row 2 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                test
            </div>

            <div class="tab-pane" id="2a">
                <h7>ca va ?</h7>
                <div class="white_background_conteneur">
                </div>
            </div>

            <div class="tab-pane" id="3a">
                <h7>grave</h7>
                <div class="white_background_conteneur">
                </div>
                test
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</body>
</html>