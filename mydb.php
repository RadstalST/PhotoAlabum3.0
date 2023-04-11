<?php
/**
* 	Interacting with MySQL DB in RDS
*
*	@author Swinburne University of Technology
*/
require 'photo.php';
require_once 'constants.php';

class MyDB 
{
	private $dbh; 
	
	// Constructor, establish a connection to the database in RDS
	public function __construct() {
		try {
			$dsn = "mysql:host=".DB_ENDPOINT.";dbname=".DB_NAME;
			$this->dbh = new PDO ( $dsn, DB_USERNAME, DB_PWD );
			$this->dbh->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( PDOException $e ) {
			error_log($e);
			echo $e;
		}
	}
	
	// Retrieve all records stored in the database table DB_PHOTO_TABLE_NAME. Return an array of Photo objects
	public function getAllPhotos() {
		$photos = array ();
		try {
			$stm = $this->dbh->query ( 'SELECT * FROM ' . DB_PHOTO_TABLE_NAME );
			foreach ( $stm as $row ) {
				array_push ( $photos, new Photo ( $row [DB_PHOTO_TITLE_COL_NAME], 
												$row [DB_PHOTO_DESCRIPTION_COL_NAME],
												$row [DB_PHOTO_CREATIONDATE_COL_NAME],
												$row [DB_PHOTO_KEYWORDS_COL_NAME],
												$row [DB_PHOTO_S3REFERENCE_COL_NAME]) );
			}
			return $photos;
		} catch ( PDOException $e ) {
			error_log($e);
			echo $e;
		}
	}
	public function populateTableWithData() {
		try {
			$stm = $this->dbh->query ( 'INSERT INTO ' . DB_PHOTO_TABLE_NAME . ' 
			VALUES 
				("Photo 1", "Description 1", "2017-01-01", "Keyword 1", "https://'.BUCKET_NAME.'amazonaws.com/Photo1.jpg")
				,("Photo 2", "Description 2", "2017-01-02", "Keyword 2", "https://'.BUCKET_NAME.'amazonaws.com/Photo2.jpg")
				,("Photo 3", "Description 3", "2017-01-03", "Keyword 3", "https://'.BUCKET_NAME.'amazonaws.com/Photo3.jpg")
				,("Photo 4", "Description 4", "2017-01-04", "Keyword 4", "https://'.BUCKET_NAME.'amazonaws.com/Photo4.jpg")
				,("Photo 5", "Description 5", "2017-01-05", "Keyword 5", "https://'.BUCKET_NAME.'amazonaws.com/Photo5.jpg");' 
			);
			
		} catch ( PDOException $e ) {
			error_log($e);
			echo $e;
		}
	}

	public function populateTable() {
		# check if there is a table and then create
		$sql = "CREATE TABLE IF NOT EXISTS " . DB_PHOTO_TABLE_NAME . " (
				" . DB_PHOTO_TITLE_COL_NAME . " VARCHAR(255) NOT NULL,
				" . DB_PHOTO_DESCRIPTION_COL_NAME . " VARCHAR(255) NOT NULL,
				" . DB_PHOTO_CREATIONDATE_COL_NAME . " DATE NOT NULL,
				" . DB_PHOTO_KEYWORDS_COL_NAME . " VARCHAR(255) NOT NULL,
				" . DB_PHOTO_S3REFERENCE_COL_NAME . " VARCHAR(255) NOT NULL
			)";
		$this->dbh->query($sql);

		# check if there is any data in the table and then populate
		$sql = "SELECT * FROM " . DB_PHOTO_TABLE_NAME;
		$stm = $this->dbh->query($sql);
		$count = $stm->rowCount();
		#if empty, then populate

		if ($count == 0) {
			$this->populateTableWithData();
		}
		
	}
	
}
?>