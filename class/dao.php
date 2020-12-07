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
	   * @param integer $continent
	   * @param integer $region
	   * @returns array
	   */
		public function getTable() {
			$sql="SELECT * FROM `praticien`";
			
				
			}
			
		
		
}

$dao=new DAO();
	if ($dao->getError()) {
		print "Une erreur s'est produite";
	}
	
	print_r($dao->getTable());
	if ($dao->getError()) {
		print "Une erreur s'est produite";
	}
	




?>