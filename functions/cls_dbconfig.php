<?php
	class DB{
		public function con(){
			$db = new mysqli("localhost", "root", "root", "rikhan03_blueorigin");
			return $db;
		}
        
        public function query($q){
         $result = self::con()->query($q);
            return $result;
        }
	}
	
?>