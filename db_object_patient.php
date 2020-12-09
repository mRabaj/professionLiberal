<?php
    class DAO {
        private $host="localhost";
        private $db="test";
        private $user="liberal_select";
        private $password="liberal_select";
        private $bdd;
        private $error="";

        public function __construct(){
            try {
	            $this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->db.';charset=utf8', $this->user, $this->password);
            }
            catch(Exception $e) {
               $this->error=$e->getMessage();
            }
        }

        public function getError(){
            return $this->error;
        }

        private function executeQuery($sql){
            $reponce=$this->bdd->query($sql);
            if (!$reponce) {
                $this->error="requete SQL non correct";
                print "erreur: ".$this->error;
            }
            else {return  $reponce->fetchAll(PDO::FETCH_ASSOC);}
        }

        public function getNomPrenom($select="",$id=""){
            $sql="SELECT ".$select." FROM patient LEFT JOIN mutuelle ON (mutuelle.idMutuelle=patient.idMutuelle) LEFT JOIN praticien ON (praticien.idPraticien=patient.idPraticien) WHERE idPatient=".$id ;
            return $this->executeQuery($sql);
        }

        public function getNomPraticien($select="",$id=""){
            $sql="SELECT ".$select." FROM praticien WHERE idPraticien=".$id ;
            return $this->executeQuery($sql);
        }

        public function getInfoPatient($select="",$id=""){
            $sql="SELECT ".$select." FROM patient LEFT JOIN mutuelle ON (patient.idMutuelle=mutuelle.idMutuelle) WHERE idPraticien=".$id;
            // print $sql;
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
?>