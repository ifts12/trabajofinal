<?php

namespace UPCN;

class Config
{
   private $nameDB = "upcn";
   private $user = "admin";
   private $pass = "Admin.";
   private $driver= "mysql";
   private $host="127.0.0.1";
      
   public function getDSN ()
   {
	   return $this->driver . ":dbname=" . $this->nameDB.";host=".$this->host;
   }

	public function getUser ()
	{
		return $this->user;
	}
	
	public function getPass ()
	{
		return $this->pass;
	}

}