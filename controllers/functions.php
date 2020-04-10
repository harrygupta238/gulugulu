<?php 
 
 $GLOBALS["DB"] = "mydb";

  function ConnectDB(){
  	try{
		$username="krishna";
		$password="krishna";
    //$mngdb = new MongoDB\Driver\Manager("mongodb+srv://Harrygupta238:VUDCJLRekXxfpA0i@spotchitt-qfy8f.mongodb.net/test?retryWrites=true&w=majority");
		$mngdb = new MongoDB\Driver\Manager("mongodb://localhost:27017");	
		return $mngdb;
	}
	catch (MongoDB\Driver\Exception\Exception $e)
     {
         $filename = basename(__FILE__);
         echo "The $filename script has experienced an error.\n"; 
         echo "It failed with the following exception:\n";
         echo "Exception:", $e->getMessage(), "\n";
         echo "In file:", $e->getFile(), "\n";
         echo "On line:", $e->getLine(), "\n";    
      } 
  }

  function signup($user){

	  	$db=ConnectDB();
	  	$DBName=$GLOBALS["DB"].".GGusers";
	  	$query = new MongoDB\Driver\Query(['UserName' => $user["UserName"]]);     
        $rows = $db->executeQuery($DBName, $query)->toArray();
        if(count($rows)>0)
        {
        	$result="username_exists";
        	return $result;
        }
        else
        {
        	$bulk = new MongoDB\Driver\BulkWrite;
			$bulk->insert($user);
			$result=$db->executeBulkWrite($DBName, $bulk);
			if($result)
			{
				$_SESSION["userid"]=$user["_id"];
				$_SESSION["username"]=$user["UserName"];
				$result="inserted";
        		return $result;
			}
			else
			{
				$result="insert_failed";
        		return $result;
			}
        }
  }
 
	 function validate_username($username){

		  	$db=ConnectDB();
		  	$DBName=$GLOBALS["DB"].".GGusers";
		  	$query = new MongoDB\Driver\Query(['UserName' => $username]);     
	        $rows = $db->executeQuery($DBName, $query)->toArray();
	        if(count($rows)>0)
	        {
	        	$result="+";
	        	return $result;
	        }
	        else
	        {
	        	$result="-";
	        	return $result;	
	        }
	  }
  function login($user){
  		$db=ConnectDB();
	  	$DBName=$GLOBALS["DB"].".GGusers";
	  	$query = new MongoDB\Driver\Query($user);     
        $rows = $db->executeQuery($DBName, $query)->toArray();
        if(count($rows)>0)
        {
        	$_SESSION["userid"]=$rows[0]->_id;
        	$_SESSION["username"]=$rows[0]->UserName;
        	$result="success";
        	return $result;
        }
        else
        {
        	$result="failed";
        	return $result;
        }
  }

  function checkAuth(){
  	if(isset($_SESSION["userid"]))
  		return true;
  	else
  		return false;
  }

  function saveMessage($message){
  	 	$db=ConnectDB();
	  	$DBName=$GLOBALS["DB"].".Messages";
    	$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->insert($message);
		$result=$db->executeBulkWrite($DBName, $bulk);
		if($result)
		{
			$result="inserted";
    		return $result;
		}
		else
		{
			$result="failed";
    		return $result;
		}
        
  }

  function getAllMessageList(){
  	  $db=ConnectDB();
	  	$DBName=$GLOBALS["DB"].".Messages";
      $filter = ['x' => ['$gt' => 1]];
      $options = [
          'sort' => ['CreateDate' => -1],
      ];
	  	$query = new MongoDB\Driver\Query([],$options);     
        $rows = $db->executeQuery($DBName, $query)->toArray();
        if(count($rows)>=0)
        {
        	return $rows;
        }
        else
        {
        	$result="failed";
        	return $result;
        }
  }

  function getAllMessageOfLoggedInUser(){
  		$db=ConnectDB();
	  	$DBName=$GLOBALS["DB"].".Messages";
      $filter = ['$or' => [['To'=>$_SESSION['username']],['From'=>$_SESSION['username']]]]; 
      $options = [
          'sort' => ['CreateDate' => -1],
      ];
	  	$query = new MongoDB\Driver\Query($filter,$options); 
        $rows = $db->executeQuery($DBName, $query)->toArray();
        return json_encode($rows);
        // if(count($rows)>0)
        // {
        // 	return $rows;
        // }
        // else
        // {
        // 	$result="failed";
        // 	return $result;
        // }
  }
  function getUserList()
  {
  	  $db=ConnectDB();
	  	$DBName=$GLOBALS["DB"].".GGusers";
	  	$query = new MongoDB\Driver\Query([]);     
        $rows = $db->executeQuery($DBName, $query)->toArray();
        if(count($rows)>0)
        {
        	return $rows;
        }
        else
        {
        	$result="failed";
        	return $result;
        }

  }
  function logout()
  {
  	unset($_SESSION["username"]);
  	unset($_SESSION["userid"]);
  }

  function createGroup($group){
      $db=ConnectDB();
      $DBName=$GLOBALS["DB"].".GGgroups";
      $query = new MongoDB\Driver\Query(['GroupName' => $group["GroupName"],"Owner"=>$group["Owner"],"IsActive"=>true]);     
        $rows = $db->executeQuery($DBName, $query)->toArray();
        if(count($rows)>0)
        {
          $result="groupname_exists";
          return $result;
        }
        else
        {
          $bulk = new MongoDB\Driver\BulkWrite;
          $bulk->insert($group);
          $result=$db->executeBulkWrite($DBName, $bulk);
          if($result)
          {
            $result="inserted";
            return $result;
          }
          else
          {
            $result="insert_failed";
            return $result;
          }
        }
  }
 function getGroupList(){
      $db=ConnectDB();
      $DBName=$GLOBALS["DB"].".GGgroups";
      $filter = ['Owner'=>$_SESSION['username']]; 
      $options = [
          'sort' => ['CreateDate' => -1],
      ];
      $query = new MongoDB\Driver\Query($filter,$options); 
        $rows = $db->executeQuery($DBName, $query)->toArray();
        if($rows)
        {
          return $rows;
        }
  }
 ?>