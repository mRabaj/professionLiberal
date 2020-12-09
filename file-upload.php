<?php 
    // Include the database configuration file
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
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;

?>