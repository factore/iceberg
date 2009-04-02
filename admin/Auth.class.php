<?php
/**
 * @author Lucas Carlson <lucas@rufy.com>
 * @pacakge Auth
 *

 Copyright (c) 2004, Lucas Carlson
 All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
	- Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
	- Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
	- Neither the name of Lucas Carlson nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */
class Auth
{
	var $inactiveLogout;
	var $database;
	var $user;
	var $properties;
	var $userIP;
	var $loggedIn;
	var $adminEmail;

##################################################################################
/*		Edit the following four functions if you like 							*/
##################################################################################
	function hash($password)
	{
		// the following code returns plain text passwords
#		return $password;

		// the following code returns md5 hashed passwords
		return md5($password);
	}

	function apology($error)
	{
#		error_log("PHP Auth\n\nError in file: $_SERVER[SCRIPT_FILENAME]\nFrom site: $_SERVER[HTTP_HOST]\nFrom page:http://$_SERVER[HTTP_HOST]/$_SERVER[REQUEST_URI]\n\n" . $error,1,$this->adminEmail);
        die ("<b>Error:</b> An error has occurred and a message has been sent to the administrator. Sorry for the inconvenience.<br><br>$error");
	}

	function validateUsername($username)
	{
		// the following code allows any unique username
#		return true;

		// the following code checks to see if the username field is a real e-mail address
		if( (preg_match('/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/', $username)) ||
			(preg_match('/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?)$/',$username)) ) {
			$host = explode('@', $username);
			if(checkdnsrr($host[1].'.', 'MX') ) return true;
			if(checkdnsrr($host[1].'.', 'A') ) return true;
			if(checkdnsrr($host[1].'.', 'CNAME') ) return true;
		}
		return false;
	}

	// How to choose new IDs
	function getNewID(&$db)
	{
		// the following code chooses a unique random ID
		mt_srand();
		$id = mt_rand(100000,999999);
		while($db->getOne("SELECT count(`id`) FROM `auth_users` WHERE `id` = '$id'") == 1){
			$id = rand(100000,999999);
		}

		// the following code increments userIDs
#		$id = $this->numUsers()+1;
#		while($db->getOne("SELECT count(`id`) FROM `auth_users` WHERE `id` = '$id'") == 1){
#			$id++;
#		}

		return $id;
	}

	function Auth($dsn = null)
	{
##################################################################################
/*		Edit the following variables											*/
##################################################################################

	$this->adminEmail 		= "email@host.com";	// set the e-mail of the person receiving errors, you may want to set this to $_SERVER["SERVER_ADMIN"]

	$this->inactiveLogout	= 24 * 60 * 60;		// seconds of inactivity before automatically logging someone out (set to 0 to never auto logout)

	$theDB					= "mysql://root:root@localhost/344827_iceDEV"; // if you don't want to set it every time you call new Auth(), set it here. The $dsn value overwrites this value.

	// The following are all the user preferences except userid, username, password, created, and loggedIn
	// A visible preference is one which the user can see and change
	$this->properties		= array(
				"firstname" => array(
					"description" 	=> "First name",
					"defaultvalue" 	=> "",
					"type"			=> "varchar(50)",
					"visible" 		=> true,
					"mutable" 		=> true,
					"unique" 		=> false,
					"indexed" 		=> false,
					"required"		=> false,
					),
				"lastname" => array(
					"description" 	=> "Last name",
					"defaultvalue" 	=> "",
					"type"			=> "varchar(50)",
					"visible" 		=> true,
					"mutable" 		=> true,
					"unique" 		=> false,
					"indexed" 		=> false,
					"required"		=> false,
					),
				"url" => array(
					"description" 	=> "URL",
					"defaultvalue" 	=> "",
					"type"			=> "varchar(100)",
					"visible" 		=> true,
					"mutable" 		=> true,
					"unique" 		=> false,
					"indexed" 		=> false,
					"required"		=> false,
					),
				"active" => array(
					"description" 	=> "Active",
					"defaultvalue" 	=> 0,
					"type"			=> "tinyint(1)",
					"visible" 		=> false,
					"mutable" 		=> true,
					"unique" 		=> false,
					"indexed" 		=> true,
					"required"		=> false,
					)
				);

##################################################################################
/*		Do not touch the rest of the code unless you know what you are doing	*/
##################################################################################

		// NEVER change any of the array names (eg. id, session, username, password),
		// You CAN change their descriptions though.
		$properties_required = array(
				"id" => array(
					"description" 	=> "ID",
					"type"			=> "mediumint",
					),
				"session" => array(
					"description" 	=> "Session ID",
					"type"			=> "varchar(40)",
					"indexed" 		=> true,
					),
				"username" => array(
					"description" 	=> "E-Mail",
					"type"			=> "varchar(40)",
					"visible" 		=> true,
					"mutable" 		=> false,
					"unique" 		=> true
					),
				"password" => array(
					"description" 	=> "Password",
					"type"			=> "varchar(40)",
					"visible" 		=> true,
					"mutable" 		=> true,
					"required"		=> true,
					),
				"loggedIn" => array(
					"description" 	=> "Logged In",
					"type"			=> "tinyint(1)",
					"defaultvalue" 	=> 0
					),
				"created" => array(
					"description" 	=> "Time stamp of creation",
					"type"			=> "int"
					)
				);

		$this->properties		= array_merge($properties_required,$this->properties);
		$this->database		= (empty($dsn)) ? $theDB : $dsn;
		$this->userIP			= $_SERVER['REMOTE_ADDR'];
		$this->inactiveLogout	= ($this->inactiveLogout == 0) ? 31536000 : $this->inactiveLogout;
		$this->loggedIn			= false;

		if (empty($this->database))
		{
			$this->apology("Please specify a database.");
		}


		if (isset($_COOKIE['session']))
		{
			$withsession = array("session" => $_COOKIE['session']);
			if ($this->numUsers($withsession) == 1) {
				$this->login($withsession);
				$this->loggedIn = true;
			}
		} else {
     $this->newSession();
		}
		header("Cache-control: private"); // to deal with IE6 oddity, see http://www.phpfreaks.com/tutorials/41/1.php
	}

    /**
     * Sets up a new session id and sets it as a cookie
     *
     * @access public
	 *
     * @return the session id
     */
	function newSession()
	{
			$sessionID = md5(uniqid(microtime()) . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . mt_rand(100000,999999));
			setcookie('session', $sessionID, time()+$this->inactiveLogout, "/");
			return $sessionID;
	}

    /**
     * Initialized a database connection
     *
     * @access public
	 *
     * @return database handler
     */
	function &dbInit()
	{
		require_once 'DB.php';		// contains database abstraction code
		$db =& DB::connect($this->database);

		if (DB::isError($db)){
			$this->apology($db->getDebugInfo());
        }

		return $db;
	}

    /**
     * The number of users with the specified properties
     *
     * @param (optional) array specifying properties of the user
	 *
     * @access public
	 *
     * @return number of users
     */
	function numUsers($user = null)
	{
		// counts the number of users with the given data
		$sql = "SELECT count(`id`) FROM `auth_users` WHERE 1";

		if ($user != null)
		{
			foreach ($user as $key => $value)
			{
				if ($key == "password")
					$value = $this->hash($value);
				$sql .= " AND `$key` = '" . addslashes($value) . "'";
			}
		}

//    echo $sql;

		$db =& $this->dbInit();
		$result = $db->getOne($sql);
		if (DB::isError($result)) {
			if ($result->getMessage() == "DB Error: no such table")
			{
				$this->initializeDB();
			} else {
				$this->apology($result->getDebugInfo());
			}
		}
		$db->disconnect();

		return $result;
	}

    /**
     * Gets an array of users with specified properties
     *
     * @param array		$user		the properties of the users selected
     * @param array		$properties	(optional) the properties of the user to return, if null it will return all properties
     * @param int		$start		(optional) which record to start at
     * @param int		$number		(optional) the number of records to return
     * @param string	$sortby		(optional) which column to sort the information by
     * @param int		$order		(optional, either 1 or 2) chooses ascending order or descending order
	 *
     * @access public
	 *
     * @return array of users
     */
	function getUsers($user, $properties = null, $start = 0, $number = 0, $sortby = null, $order = 1)
	{
		$order = ($order == 2) ? "DESC" : "ASC";
		if ($properties == null)
		{
			$properties = array();
			foreach ($this->properties as $key => $value)
			{
				array_push($properties,$key);
			}
		}

		$db =& $this->dbInit();

		// counts the number of users with the given data
		$sql = "SELECT COUNT(`id`) FROM `auth_users` WHERE 1";

		foreach ($user as $key => $value)
		{
			if ($key == "password")
				$value = $this->hash($value);
			if (in_array($key,$properties))
				$sql .= " AND `$key` like '%" . addslashes($value) . "%'";
		}

		$numUsers = $db->getOne($sql);

		if (DB::isError($db)){
			$this->apology($db->getDebugInfo());
        }

		if ($numUsers > 0)
		{
			$number = ($number == 0) ? $numUsers : $number;

			$sql = "SELECT ";
			foreach ($properties as $key)
			{
				$sql .= "`$key`, ";
			}
			$sql .= "`id` FROM `auth_users` WHERE 1";
			foreach ($user as $key => $value)
			{
				if ($key == "password")
					$value = $this->hash($value);
				if (in_array($key,$properties))
					$sql .= " AND `$key` like '%" . addslashes($value) . "%'";
			}
			if (!empty($sortby))
				$sql .= " ORDER BY `" . addslashes($sortby) . "` " . addslashes($order);
			$sql .= " LIMIT " . addslashes($start) . ", " . addslashes($number);
			$result = $db->getAll($sql,DB_FETCHMODE_ASSOC);
			if (DB::isError($db)){
				$this->apology($db->getDebugInfo());
	        }
			$db->disconnect();
		}

		return $result;
	}

    /**
     * If the user array information is valid, it adds the user to the database
     *
     * @param the user
	 *
     * @access public
	 *
     * @return either true or an array specifying the errors
     */
	function addUser($user)
	{
		if (is_array($user))
		{
			$verified = $this->verifyFields($user);

			if (!is_array($verified))
			{
				$db =& $this->dbInit();
				$id = $this->getNewID($db);

				// Insert the user
				$sql = "INSERT INTO `auth_users` (`id`, `loggedIn`, `created`";

				foreach ($user as $key => $value)
				{
					if ($key != "id" && $key != "loggedIn" && $key != "created")
						$sql .= ", `$key`";
				}

				$currentTime = time();
				$sql .= ") VALUES ( '$id', '0', '$currentTime'";

				foreach ($user as $key => $value)
				{
					if ($key == "password")
						$value = $this->hash($value);
					if ($key != "id" && $key != "loggedIn" && $key != "created")
						$sql .= ", '" . addslashes($value) . "'";
				}

				$sql .= ")";
				$result = $db->query($sql);
				if (DB::isError($result))
					$this->apology($result->getDebugInfo());

				// Now log the event
				$sql = "INSERT INTO `auth_log` (`user_id`, `ip`, `timestamp`, `type`, `entry`, `url`) VALUES ( '$id', '$this->userIP', '$currentTime', '0', 'Added user " . addslashes($user['username']) . "', '" . mysql_escape_string($_SERVER['REQUEST_URI']) . "' )";

				$result = $db->query($sql);
				if (DB::isError($result))
					$this->apology($result->getDebugInfo());

				$db->disconnect();

				return true;
			} else {
				return $verified;
			}
		} else {
			$this->apology("When calling addUser(), the argument must be an array.");
		}
	}

    /**
     * Updates the user information for a given $userID, given that the updated user is valid
     *
     * @param $userID the id of the user to be updated
     * @param $changes an array of changes to the user
	 *
     * @access public
	 *
     * @return either true or an array specifying the errors
     */
	function editUser($userID, $changes)
	{
		$userID = (int) $userID;
		$user = array();
		$sql = "SELECT * FROM `auth_users` WHERE `id` = '$userID'";
		$db =& $this->dbInit();
		$result = $db->query($sql);
		if (DB::isError($result))
			$this->apology($result->getDebugInfo());
		$result->fetchInto($user,DB_FETCHMODE_ASSOC); // slightly faster than fetchRow
		$db->disconnect();
		$userInfo = $user;

		if (empty($user))
		{
			return false;
		}
		else if (is_array($changes))
		{
			foreach ($changes as $key => $value)
			{
				if ($this->properties[$key]["mutable"] != false && !empty($this->properties[$key]))
				{
					$user[$key] = $value;
				} else {
					$user[$key] = null;
				}
			}

			$verified = $this->verifyFields($user);

			$realerror = 0;
			if (is_array($verified))
			{
				foreach($verified as $key => $value)
				{
					if (!empty($changes[$value["name"]]))
					{
						$realerror++;
					}
				}
			}

			if ($realerror == 0)
			{
				$db =& $this->dbInit();
				$id = $this->getNewID($db);

				// Insert the user
				$sql = "UPDATE `auth_users` SET ";

				foreach ($user as $key => $value)
				{
					if ($key == "password")
					{
						if (empty($value))
							$value = $userInfo["password"];
						else
							$value = $this->hash($value);
					}
					if ($this->properties[$key]["mutable"] != false && isset($changes[$key]) && $value != $userInfo[$key])
						$sql .= "`$key` = '" . addslashes($value) . "' ,";
				}

				$sql .= "`id` = '$userID' WHERE `id` = '$userID'";

				$result = $db->query($sql);
				if (DB::isError($result))
					$this->apology($result->getDebugInfo());

				$currentTime = time();

				// Now log the event
				$sql = "INSERT INTO `auth_log` (`user_id`, `ip`, `timestamp`, `type`, `entry`, `url`) VALUES ( '" . $this->user["id"] . "', '$this->userIP', '$currentTime', '4', 'Updated user " . addslashes($userInfo['username']) . " ($userID)', '" . mysql_escape_string($_SERVER['REQUEST_URI']) . "' )";

				$result = $db->query($sql);
				if (DB::isError($result))
					$this->apology($result->getDebugInfo());

				$db->disconnect();

				if ($this->user['id'] == $userID){
					foreach ($user as $key => $value)
					{
						if ($this->properties[$key]["mutable"] != false && isset($changes[$key]) && $value != $userInfo[$key])
							$this->user[$key] = $value;
					}
				}

				return true;
			} else {
				return $verified;
			}
		} else {
			$this->apology("When calling editUser(), the argument must be an array.");
		}
	}

    /**
     * Removes a user from the database by their userid
     *
     * @param the userid of the user to be deleted
	 *
     * @access public
     */
	function deleteUser($userID)
	{
		$userID = (int) $userID;
		$user = array();
		$sql = "SELECT * FROM `auth_users` WHERE `id` = '$userID'";
		$db =& $this->dbInit();
		$result = $db->query($sql);
		if (DB::isError($result))
			$this->apology($result->getDebugInfo());
		$result->fetchInto($user,DB_FETCHMODE_ASSOC); // slightly faster than fetchRow

		if (!empty($user))
		{
			$sql = "DELETE FROM `auth_users` WHERE `id` = '$userID'";
			$result = $db->query($sql);
			if (DB::isError($result))
				$this->apology($result->getDebugInfo());
			$currentTime = time();
			// Now log the event
			$sql = "INSERT INTO `auth_log` (`user_id`, `ip`, `timestamp`, `type`, `entry`, `url`) VALUES ( '$id', '$this->userIP', '$currentTime', '4', 'Deleted user " . addslashes($user['username']) . " ($userID)', '" . mysql_escape_string($_SERVER['REQUEST_URI']) . "' )";

			$result = $db->query($sql);
			if (DB::isError($result))
				$this->apology($result->getDebugInfo());
		}

		$db->disconnect();
	}

    /**
     * Makes sure that all the required fields are satisfied for a specified user
     *
     * @param an array of user information
	 *
     * @access public
	 *
     * @return either true or an array of errors
     */
	function verifyFields($user)
	{
		$emptyFields = array();

		foreach ($this->properties as $key => $value)
		{
			if ($value['unique'] == true)
			{
				if (empty($user[$key]))
				{
					array_push($emptyFields,array("name"=>$key,"description"=>$value['description'],"problem"=>"required"));
				} else {
					$checkVariable = array($key=>$user[$key]);
					if ($this->numUsers($checkVariable) > 0)
						array_push($emptyFields,array("name"=>$key,"description"=>$value['description'],"problem"=>"unique"));
				}
			} else if ($value['required'] == true) {
				if (empty($user[$key]))
					array_push($emptyFields,array("name"=>$key,"description"=>$value['description'],"problem"=>"required"));
			}

			if ($key == "username") {
				if ($this->validateUsername($user[$key]) == false)
					array_push($emptyFields,array("name"=>$key,"description"=>$value['description'],"problem"=>"not valid"));
			}
		}

		if (sizeof($emptyFields) == 0)
			return true;
		else
			return $emptyFields;
	}

    /**
     * Verifies the user information and logs the user in if it it correct
     *
     * @param an array of user information, like session, or username and password
	 *
     * @access public
     */
	function login($user)
	{
		if (is_array($user))
		{
			if ($this->numUsers($user) == 1){
				$theSession = $this->newSession();

				$db =& $this->dbInit();
				// update DB to show logged in status
				$sql = "UPDATE `auth_users` SET `loggedIn` = '1', `session` = '$theSession' WHERE 1";
				foreach ($user as $key => $value)
				{
					if ($key == "password")
						$value = $this->hash($value);
					$sql .= " AND `$key` = '" . addslashes($value) . "'";
				}
				$result = $db->query($sql);
				if (DB::isError($result))
					$this->apology($result->getDebugInfo());

				// fetch all information from the database
				$sql = "SELECT * FROM `auth_users` WHERE 1";
				foreach ($user as $key => $value)
				{
					if ($key == "password")
						$value = $this->hash($value);
					$sql .= " AND `$key` = '" . addslashes($value) . "'";
				}
				$result = $db->query($sql);
				if (DB::isError($result))
					$this->apology($result->getDebugInfo());
				$result->fetchInto($props,DB_FETCHMODE_ASSOC);

/*        foreach ($props as $key => $value)
        {
          $this->user[$key] = $value;
        }
*/
				// Now log the event
				if (sizeof($user) > 1){
					$id = $this->user['id'];
					$currentTime = time();
					$sql = "INSERT INTO `auth_log` (`user_id`, `ip`, `timestamp`, `type`, `entry`, `url`) VALUES ( '$id', '$this->userIP', '$currentTime', '1', 'Logged in user " . addslashes($this->user['username']) . "', '" . mysql_escape_string($_SERVER['REQUEST_URI']) . "' )";

					$result = $db->query($sql);
					if (DB::isError($result))
						$this->apology($result->getDebugInfo());
				}
				$db->disconnect();
				$this->loggedIn = true;
			} else {
				$db =& $this->dbInit();
				$id = $this->user['id'];
				$currentTime = time();
				$sql = "INSERT INTO `auth_log` (`user_id`, `ip`, `timestamp`, `type`, `entry`, `url`) VALUES ( '$id', '$this->userIP', '$currentTime', '3', 'Bad login attempt " . addslashes($user['username']) . "', '" . mysql_escape_string($_SERVER['REQUEST_URI']) . "' )";

				$result = $db->query($sql);
				if (DB::isError($result))
					$this->apology($result->getDebugInfo());
				$db->disconnect();
			}
		} else {
			$this->apology("When calling login(), the argument must be an array.");
		}
	}

    /**
     * Logs out a user and sets up a new session
     *
     * @access public
     */
	function logout()
	{
		// update DB to show logged out
		$db =& $this->dbInit();
		$sql = "UPDATE `auth_users` SET `loggedIn` = '0', `session` = '' WHERE `session` = '" . addslashes($_COOKIE['session']) . "';";
		$result = $db->query($sql);
		if (DB::isError($result))
			$this->apology($result->getDebugInfo());

		// Now log the event
		$id = $this->user['id'];
		$currentTime = time();
		$sql = "INSERT INTO `auth_log` (`user_id`, `ip`, `timestamp`, `type`, `entry`, `url`) VALUES ( '$id', '$this->userIP', '$currentTime', '2', 'Logged out user " . addslashes($this->user['username']) . "', '" . mysql_escape_string($_SERVER['REQUEST_URI']) . "' )";

		$result = $db->query($sql);
		if (DB::isError($result))
			$this->apology($result->getDebugInfo());

		$db->disconnect();

		// create a new random session
		$this->newSession();

		// clear the user info array
		$this->user = array();
	}

    /**
     * Requires HTTP authentication
     *
     * @access public
     */
	function loginRequired($exitPage)
	{
		if (!$this->loggedIn) {
			header('WWW-Authenticate: Basic realm="Login Required"');
			header('HTTP/1.0 401 Unauthorized');
			echo <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Sorry</title>
</head>
<body onLoad="location.href='$exitPage';">
Sorry, you are not allowed to see this page. Please go <a href="$exitPage">back</a>.
</body>
</html>
EOF;
			exit;
		} else {
			$theUser = array("username" => $_SERVER['PHP_AUTH_USER'],
							"password" => $_SERVER['PHP_AUTH_PW'] );
			$this->login($theUser);

			if (!$this->loggedIn){
				$this->loginRequired($exitPage);
			}
		}
	}

    /**
     * Returns a basic login form. This is meant to be a skeletal demo for the webmaster to copy
     * the code from in order to customize the look of it.
     *
     * @access public
	 *
     * @return the HTML for a login form
     */
	function showLoginForm()
	{
		$currentURL = $_SERVER['PHP_SELF'];
		$uname = $this->properties['username']['description'];
		$passwd = $this->properties['password']['description'];
		return <<<EOD
<form action="$currentURL" method="post">
<input type="hidden" name="type" value="login">
$uname: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br><br>

<input type="submit" value="Login">
</form>
EOD;
	}

    /**
     * Returns a basic registration form. This is meant to be a skeletal demo for the webmaster to copy
     * the code from in order to customize the look of it.
     *
     * @access public
	 *
     * @return the HTML for a login form
     */
	function showRegistrationForm()
	{
		$currentURL = $_SERVER['PHP_SELF'];
		$text = <<<EOD
<form action="$currentURL" method="post">
<input type="hidden" name="type" value="registration">
EOD;
		foreach ($this->properties as $key => $value)
		{
			$type = ($key == "password") ? "password" : "text";
			$showValue = ($key == "password") ? "" : addslashes($_POST[$key]);
			if ($value["visible"] == true)
				$text .= $value["description"] . ": <input type=\"$type\" name=\"$key\" value=\"$showValue\"><br>\n";
		}

		$text .= <<<EOD
<br><input type="submit" value="Register">
</form>
EOD;

		return $text;
	}

    /**
     * Returns a basic edit user form for a given userid
     *
     * @param the id of the user who we want to edit
	 *
     * @access public
	 *
     * @return the HTML for a login form
     */
	function showEditUserForm($userID)
	{
		$userID = (int) $userID;
		$user = array();
		$sql = "SELECT * FROM `auth_users` WHERE `id` = '$userID'";
		$db =& $this->dbInit();
		$result = $db->query($sql);
		if (DB::isError($result))
			$this->apology($result->getDebugInfo());
		$result->fetchInto($user,DB_FETCHMODE_ASSOC); // slightly faster than fetchRow
		$db->disconnect();

		if (empty($user))
		{
			return false;
		}

		$currentURL = $_SERVER['PHP_SELF'];
		$text = <<<EOD
<form action="$currentURL" method="post">
<input type="hidden" name="type" value="edituser">
<input type="hidden" name="id" value="$user[id]">
EOD;
		foreach ($this->properties as $key => $value)
		{
			$showValue = ($key != "password") ? $user[$key] : "";
			$type = ($key == "password") ? "password" : "text";
			if ($value["visible"] == true && $value["mutable"] != false)
				$text .= $value["description"] . ": <input type=\"$type\" name=\"$key\" value=\"$showValue\"><br>\n";
			else if ($value["visible"] == true)
				$text .= $value["description"] . ": <strong>$showValue</strong><br>\n";
		}

		$text .= <<<EOD
<br><input type="submit" value="Update">
</form>
EOD;

		return $text;
	}

    /**
     * Prints out the SQL code necessary to create the database backend for this authentication system
	 *
     * @access public
	 *
     * @return the SQL code
     */
	function initializeDB()
	{
		$first = true;

		$sql = "CREATE  TABLE `auth_users` (";
		foreach ($this->properties as $key => $value)
		{
			$type = (empty($value["type"])) ? "longtext" : $value["type"];
			$valuedefault = (empty($value["valuedefault"])) ? "NOT NULL" : "DEFAULT '" . $value["valuedefault"] . "' NOT NULL";
			if ($value["indexed"])
				$indexed .= "`$key` ,";

			if ($first)
				$first = false;
			else
				$sql .= ", ";
			$sql .= "`$key` $type $valuedefault";
		}

		if (!empty($indexed))
			$sql .= ", INDEX(" . substr($indexed,0,strlen($indexed)-2) . ")";

		$sql .= ", PRIMARY KEY (`id`));\n\n";

		$first = true;
		$sql .= "CREATE  TABLE `auth_log` (`id` mediumint NOT NULL AUTO_INCREMENT, `user_id` mediumint NOT NULL, `ip` varchar(15) NOT NULL, `timestamp` int NOT NULL, `type` tinyint(1) DEFAULT '-1' NOT NULL, `entry` longtext NOT NULL, `URL` text NOT NULL, INDEX(`user_id`,`ip`,`type`), PRIMARY KEY (`id`));";

		$this->apology( "Execute the following SQL code on your database to initialize the authentication and logging table:\n\n$sql" );
	}
}
?>
