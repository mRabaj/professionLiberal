<?php
class DAO {
	private $host="localhost";
	private $db="professionliberal";
	private $user="liberal_select"; 
	private $password='liberal_select';
	private $userWrite="liberal_write"; 
	private $passwordWrite='liberal_write';
	private $bdd;
	private $error="";
	
	 function __construct()
	{ 
	}
	public function getError() {
			return $this->error;
		}
	
	private function connect($write=false){
			
		try
		{
			if ($write) {
					$this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->db.';charset=utf8', $this->userWrite, $this->passwordWrite);
				} else {
					$this->bdd= new PDO('mysql:host='.$this->host.';dbname='.$this->db.';charset=utf8',$this->user,$this->password);
				}
			
			
		}
		catch(Exception $e)
		{
			print "Error !:".$e->getMessage()."<br/>";
			die();
		}
	
	}
	
	private function executeQuery($sql) {
			$this->connect();
			$reponse=$this->bdd->query($sql);
			
			if (!$reponse) {
				$this->error=$this->bdd->errorInfo()[2];
			}
			return $reponse->fetchAll(PDO::FETCH_ASSOC);
		}
		
		private function executeNonQuery($sql) {
			$this->connect(true);
			$reponse=$this->bdd->query($sql);
			if (!$reponse) {
				$this->error=$this->bdd->errorInfo()[2];
			}
			return $reponse;
		}
		
	   /**
	   * @param integer $patient
	   * @param integer $practitioner
	   * @returns array
	   */
		public function getPatient() {
			$sql="SELECT `idPatient` AS 'id', `email`,`mot_de_passe` AS 'pwd',nom, prenom  FROM `patient` ORDER BY nom ASC";
			
			return $this->executeQuery($sql);
			}
		
		public function getPractitioner(){
			$sql="SELECT `idPraticien` AS 'id' , `nom`, `prenom`, `email`, `mot_de_passe` AS 'pwd', `code_rpps` FROM `praticien` WHERE 1";
			
			return $this->executeQuery($sql);
		}
		public function getNameMutuelle(){
			$sql="SELECT idMutuelle,nom FROM `mutuelle` ORDER BY nom ASC";
			return $this->executeQuery($sql);
		}

		public function insertPatient($nom,$prenom,$sexe,$nom_naissance,$date_naissance,$portable,$fixe,$email,$adresse1,$adresse2,$code_postal,$ville,$pays,$numero_sociale,$mot_de_passe,$mutual,$praticien) {
			$sql='INSERT INTO `patient`( `nom`, `prenom`, `sexe`, `nom_naissance`, `date_naissance`, `telephone_portable`, `telephone_fixe`, `email`, `adresse1`, `adresse2`, `code_postal`, `ville`, `pays`, `numero_securite_sociale`, `mot_de_passe`,`idMutuelle`, `idPraticien`) VALUES ("'.$nom.'","'.$prenom.'","'.$sexe.'","'.$nom_naissance.'","'.$date_naissance.'","'.$portable.'","'.$fixe.'","'.$email.'","'.$adresse1.'","'.$adresse2.'","'.$code_postal.'","'.$ville.'","'.$pays.'",'.$numero_sociale.',"'.$mot_de_passe.'",'.$mutual.','.$praticien.')';
			
			return $this->executeNonQuery($sql);
		}
		public function insertPraticien($nom,$prenom,$sexe,$portable,$fixe,$email,$adresse1,$adresse2,$code_postal,$ville,$pays,$mot_de_passe,$code_rpps) {
			$sql='INSERT INTO `praticien`( `nom`, `prenom`, `sexe`, `telephone_portable`, `telephone_fixe`, `email`, `adresse1`, `adresse2`, `code_postal`, `ville`, `pays`, `mot_de_passe`, `code_rpps`) VALUES ("'.$nom.'","'.$prenom.'","'.$sexe.'","'.$portable.'","'.$fixe.'","'.$email.'","'.$adresse1.'","'.$adresse2.'","'.$code_postal.'","'.$ville.'","'.$pays.'","'.$mot_de_passe.'",'.$code_rpps.')';
			return $this->executeNonQuery($sql);
		}
		public function updatePwdPatient($mot_de_passe,$idPatient){
			$sql='UPDATE `patient` SET `mot_de_passe`="'.$mot_de_passe.'" WHERE `idPatient`='.$idPatient;
			return $this->executeNonQuery($sql);
		}
		public function updatePwdPraticien($mot_de_passe,$idPraticien){
			$sql='UPDATE `praticien` SET `mot_de_passe`="'.$mot_de_passe.'" WHERE `idPraticien`='.$idPraticien;
			return $this->executeNonQuery($sql);
		}
		
}
	
$dao=new DAO();
	if ($dao->getError()) {
		print "Une erreur s'est produite";
	}



?>