<?php 
 $GLOBALS["DB"] = "mydb";
  $GLOBALS["LoggedInUserName"] = "LoggedInUserName";
  $GLOBALS["RandomUserName"] = "RandomUserName";

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
				$_SESSION["LoggedInUserName"]=$user["UserName"];
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
        	$_SESSION["LoggedInUserName"]=$rows[0]->UserName;
          setcookie("RandomUserName", "", time() - 3600, "/");
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
      $filter = ['$or' => [['To'=>$_SESSION["LoggedInUserName"]],['From'=>$_SESSION["LoggedInUserName"]]]]; 
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
  	unset($_SESSION["LoggedInUserName"]);
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
      $filter = ['Owner'=>$_SESSION["LoggedInUserName"],"IsActive"=>true]; 
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

  function saveGroupMessage($groupMSGObj, $groupid){
      $db=ConnectDB();
      $DBName=$GLOBALS["DB"].".GGgroups";
          $bulk = new MongoDB\Driver\BulkWrite;
          $bulk->update(['_id' =>  new MongoDB\BSON\ObjectID("$groupid")],
                        ['$push' => ["Messages"=> $groupMSGObj]]);
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

   function getGroupMessageList($groupid){
      $db=ConnectDB();
      $DBName=$GLOBALS["DB"].".GGgroups";
      $filter = ['_id'=>$groupid]; 
      $options = [
          'projection' => ['_id' => 0,'Messages'=>1],
      ];
      $query = new MongoDB\Driver\Query($filter,$options); 
      $rows = $db->executeQuery($DBName, $query)->toArray();
      if($rows)
        {
          return $rows;
        }
  }

  function validate_groupid($groupid){
        $db=ConnectDB();
        $DBName=$GLOBALS["DB"].".GGgroups";
        $query = new MongoDB\Driver\Query(['_id' => $groupid]);     
          $rows = $db->executeQuery($DBName, $query)->toArray();
          if(count($rows)>0)
          {
            
            return $rows;
          }
          else
          {
            return "-"; 
          }
    }
   function setVisitorCookie(){
      if(!isset($_SESSION["LoggedInUserName"])  && !isset($_COOKIE["RandomUserName"]))
      {
        setcookie("RandomUserName", new MongoDB\BSON\ObjectID, time() + (86400 * 300), "/");
      }
   }

  function deleteGroupByID($groupid){
      $db=ConnectDB();
      $DBName=$GLOBALS["DB"].".GGgroups";
      
          $bulk = new MongoDB\Driver\BulkWrite;
          $bulk->update(['_id' =>  new MongoDB\BSON\ObjectID($groupid)],
                    ['$set' => 
                      [
                        'IsActive' => false,
                      ]
                    ]);
          $result=$db->executeBulkWrite($DBName, $bulk);
          if($result)
          {
            $result="deleted";
            return $result;
          }
          else
          {
            $result="delete_failed";
            return $result;
          }
  }
 ?>