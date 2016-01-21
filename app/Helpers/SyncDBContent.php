<?
## 
## v1.0	## 14 August 2004
######
## Synchronize MySQL Database Content
######
## This class generate text file contains SQL queries
## to be used in synchronizing 2 equal database.
##
#######
## Author: Huda M Elmatsani
## Email: 	justhuda at netrada.co.id
##
## 14/08/2004
#######
## Copyright (c) 2004 Huda M Elmatsani All rights reserved.
## This program is free for any purpose use.
########
##
## USAGE AND MUST READ
## 
## If you work with 2 databases, 1 database is a local database --
## may be at your home/office, and the other is a remote database --
## may be at your webhosting, you often get trouble when synchronize
## the contents of database. The existing program is dumping up the whole
## database and executing that huge file using phpMyAdmin or others.
##
## This class help you to make your job easier and faster by affecting
## only the updated data.
##
## REQUIREMENTS ON USING THIS CLASS
##
## Before you use this class, make sure:
## 1. Each table on your database has field with name: "updated" TIMESTAMP(14) NOT NULL
##    This field must be NOT NULL. Or u may set the default value with: now() 
##    This field is used for checking whether the record is updated or not.
## 
##    Look at sample table structure below:
##
##    CREATE TABLE `quotes` (
##     `quote_ID` int(11) NOT NULL auto_increment,
##     `quote_text` varchar(255) NOT NULL default '',
##     `quote_author` varchar(20) default NULL,
##     `quote_category` varchar(10) default NULL,
##     `updated` timestamp(14) NOT NULL,
##     PRIMARY KEY  (`quote_ID`)
##    ) TYPE=MyISAM
##
##    The field 'updated' must be exists on each table.
##
## 2. The database schema, both local database and remote database must be EQUAL.
## 
##
## see test.php, test2.php for test and usage
## 
####

class SyncDBContent {

	var $path_dir	= "";
	var $startdate	= "";
	var $db_name	= "";
	var $db_link	= "";
	var $db_tables	= null;


	function SyncDBContent($db_host = "",$db_name = "",$db_user = "",$db_user = "") {
		
		$this->db_name	= $db_name;
		$this->db_link	=	@mysql_connect($db_host,$db_user,$db_pass) or mysql_die();
		mysql_select_db($this->db_name) or mysql_die();

		$this->db_tables = $this->get_tablenames();

	}


	/* specify where the sql file will be created */
	function set_pathdir ($path) {

		$this->path_dir	= $path;
		if (!is_dir($this->path_dir)) mkdir($this->path_dir, 0777);

	}

	/* specify the start date of db content to be synchronize, the FORMAT is YYYY-MM-DD */
	function set_startdate($date) {
		//$startdate = "2004-08-12";
		$this->startdate = $date;
	}

	/* specify the time limit for executing the script, if not specified, php.ini is used. */
	function set_timelimit($timelimit) {

		@set_time_limit($timelimit);

	}

	/* get updated database contents */
	function get_content($table) {

		 $content="";
		 $query = "SELECT * FROM $table WHERE updated >= '$this->startdate'";

		 $result = mysql_query($query);
		 
		 while($row = mysql_fetch_row($result)) {
			 $str_query = "REPLACE INTO $table VALUES (";
			 for($i=0; $i<mysql_num_fields($result);$i++) {
				if(!isset($row[$i])) $str_query .= "NULL,";
				else if($row[$i] != "") $str_query .= "'".$row[$i]."',";
				else $str_query .= "'',";
			 }
			 $str_query = ereg_replace(",$","",$str_query);
			 $str_query .= ");\n";
			 $content .= $str_query;
		 }
		 return $content;
	}

	/* resolve table names */
	function get_tablenames() {

		$result = mysql_list_tables($this->db_name,$this->db_link); 
		
		while ($row = mysql_fetch_row($result)) { 
			$tables[] = $row[0];		
		}

		return $tables;
	}

	/* create the sql file */
	function create_syncfile() {	

		$cur_time = date("Y-m-d H:i");
		$syncfile = "# SyncFile created on $cur_time\r\n";

		for ($i=0; $i < count($this->db_tables); $i++ ) {		

			$syncfile .= $this->get_content($this->db_tables[$i]);

		}

		$fp = fopen ($this->path_dir."syncfile_".date("Ymd").".sql","w");
		fwrite ($fp,$syncfile);
		fclose ($fp);
	}

	/* execute the sql file */
	function exec_syncfile($file) {

		if(!basename ($file)) exit; 
		
		if(!empty($file) && $file != "none"){
			$fp = fopen($file, "r") or die ("file won't open");
			$sql_query = addslashes(fread($fp, 102400));
		} 
		fclose($fp);

		$queries = $this->split_sql($sql_query);

		for ($i=0; $i<count($queries); $i++){
			$queries[$i] = stripslashes(trim($queries[$i]));
			if(!empty($queries[$i]) && $queries[$i] != "#"){
				mysql_query ($queries[$i]) or mysql_close();
			}
		}

	}

	function split_sql($sql)
	{
		$sql = trim($sql);
		$sql = ereg_replace("#[^\n]*\n", "", $sql);
		$buffer = array();
		$ret = array();
		$in_string = false;
	
		for($i=0; $i<strlen($sql)-1; $i++){
			 if($sql[$i] == ";" && !$in_string){
				$ret[] = substr($sql, 0, $i);
				$sql = substr($sql, $i + 1);
				$i = 0;
			}
	
			if($in_string && ($sql[$i] == $in_string) && $buffer[0] != "\\"){
				 $in_string = false;
			}
			elseif(!$in_string && ($sql[$i] == "\"" || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")){
				 $in_string = $sql[$i];
			}
			if(isset($buffer[1])){
				$buffer[0] = $buffer[1];
			}
			$buffer[1] = $sql[$i];
		 }
	
		if(!empty($sql)){
			$ret[] = $sql;
		}
	
		return($ret);
	}

}

?>