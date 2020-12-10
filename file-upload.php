<?php 

include 'db_object_patient.php';

$statusMsg = '';
$db=new DAO();
// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["fileUpload"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$file_contents= file_get_contents ($_FILES['fileUpload']['tmp_name']);
$file_hex="";

$handle = @fopen($_FILES['fileUpload']['tmp_name'], "r"); 
if ($handle) {     
    while (!feof($handle)) {         
        $hex = bin2hex(fread ($handle , 4 ));         
        $file_hex.= $hex."\n";     
    }     
    fclose($handle);  
} 

if(isset($_POST["submit"]) && !empty($_FILES["fileUpload"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            
            $insert = $db->insertdocuments($fileName,$file_hex);
            if($insert){
                unlink("uploads/".$fileName); // delete le fichier
                // $statusMsg = "The file ".$fileName." has been uploaded successfully.";
                echo '<script>window.alert("Le fichier '.$fileName.' a été envoyé avec succés.");
                window.location.replace("patient_home.php");</script>';

            }else{
                echo '<script>window.alert("Envoi de fichier échouer, ressayer dans quelques instants");
                window.location.replace("patient_home.php");</script>';
            } 
        }else{
            echo '<script>window.alert("Une erreur est survenue lors de l'.'envois du fichier");
            window.location.replace("patient_home.php");</script>';
        }
    }else{
        echo '<script>window.alert("Seulements des fichiers JPG, JPEG, PNG et PDF peuve t'.'être envoiller");
        window.location.replace("patient_home.php");</script>';
    }
}else{
    echo '<script>window.alert("Veuillez choisir un fichier à envoyer");
    window.location.replace("patient_home.php");</script>';
}

// Display status message
echo $statusMsg;

?>