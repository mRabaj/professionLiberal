<?php
    class DAO {
        private $host="localhost";
        private $db="test";
        private $user="liberal_select";
        private $password="liberal_select";
        private $userWrite="liberal_write";
		private $passwordWrite="liberal_write";
        private $bdd;
        private $error="";

        public function __construct(){
        }

        public function getError(){
            return $this->error;
        }

        private function connect($write=false) {
			try
			{
				// On se connecte à MySQL
				if ($write) {
					$this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->db.';charset=utf8', $this->userWrite, $this->passwordWrite);
				} else {
					$this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->db.';charset=utf8', $this->user, $this->password);
				}
			}
			catch(Exception $e)
			{
				// En cas d'erreur, on affiche un message et on arrête tout
				$this->error=$e->getMessage();
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

        public function getNomPrenom($select="",$id=""){
            $sql="SELECT ".$select." FROM patient LEFT JOIN mutuelle ON (mutuelle.idMutuelle=patient.idMutuelle) LEFT JOIN praticien ON (praticien.idPraticien=patient.idPraticien) WHERE idPatient=".$id ;
            return $this->executeQuery($sql);
        }

        public function insertdocuments($name,$documents) { 
            $sql="INSERT INTO documents VALUES ('',1,'".$name."',NOW(),'','".$documents."')";
            // print $sql;
			return $this->executeNonQuery($sql);
        }

        public function getDocuments() { 
            $sql="SELECT documents.titre as titre,documents.date as dateE FROM documents LEFT JOIN patient ON (documents.idPatient=patient.idPatient) WHERE patient.idPatient=1";
			return $this->executeQuery($sql);
        }

    }    
    // $dao= new DAO();
    // if ($dao->getERROR()) {
    //     print "erreur: ".$dao->getError();
    // }
    // foreach ($dao->getNomPrenom("*","1") as $item) {
    //     print $item["nom"];
    // }
    // $dao->insertpatient("banane","flambé");
    // print "yes";
?>