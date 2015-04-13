<?php

	if (file_exists(dirname(__FILE__).'/../cal.conf.php'))
		include(dirname(__FILE__).'/../cal.conf.php');

	class Core {

		private $host = host;
		private $user = user;
		private $password = password;
		protected $databs = databs;

		var $dbconn;
		var $mailWm = mail_wm;

		function __construct() {

			$this->connessione();

		}

		private function connessione() {

			if (!$this->dbconn = @mysql_connect($this->host, $this->user, $this->password))
				die($this->getErrorConn("App in Maintenance.", mysql_error()));
			else
				$this->load_db($this->databs);

		}

		private function load_db($database) {

			if (!$this->dbloading = mysql_select_db($database, $this->dbconn))
				die($this->getErrorConn("Error during connection to Database", mysql_error()));

		}

		private function getErrorConn($obj_text, $error_text) {

			@mail($this->mailWm, "DB Error on EFcalendar", "It's an error: ".$error_text, "From: EFcalendar Notify <no-response@efcalendar.com>");
			return $obj_text;

		}

	}