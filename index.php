<?php

//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);


define('DATABASE', 'rrs63');
define('USERNAME', 'rrs63');
define('PASSWORD', '6hGttGyh');
define('HOSTNAME', 'sql1.njit.edu');


//Autoload other classes
class Manage {
    public static function autoload($class) {
        //you can put any file name or directory here
        include $class . '.php';
    }
}

spl_autoload_register(array('Manage', 'autoload'));


class todos extends collection {
    protected static $modelName = 'todo';
}

class accounts extends collection {
    protected static $modelName = 'account';
}


class account extends model {
    public $id;
    public $email;
    public $fname;
    public $lname;
    public $phone;
    public $birthday;
    public $gender;
    public $password;

    //Logic to use multiple constructor in php
    public function __construct() {
        $this->tableName = 'accounts'; 
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct7($email,$fname,$lname,$phone,$birthday,$gender,$password) {        
        $this->email = $email;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->phone = $phone;
        $this->birthday = $birthday;        
        $this->gender = $gender;
        $this->password = $password;
    }

    //returning header of accounts table
    public function getHeader() {
        return array('Id','Email','First Name','Last Name','Phone','Birthday','Gender','Password');
    }

    //returning values stored in attributes (row of accounts table)
    public function getRecord() {
        return array($this->id,$this->email,$this->fname,$this->lname,$this->phone,$this->birthday,$this->gender,$this->password);
    }
}


class todo extends model {
    public $id;
    public $owneremail;
    public $ownerid;
    public $createddate;
    public $duedate;
    public $message;
    public $isdone;

    //Logic to use multiple constructor in php
    public function __construct() {
        $this->tableName = 'todos';
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct6($owneremail,$ownerid,$createddate,$duedate,$message,$isdone) {        
        $this->owneremail = $owneremail;
        $this->ownerid = $ownerid;
        $this->createddate = $createddate;
        $this->duedate = $duedate;
        $this->message = $message;
        $this->isdone = $isdone;
    }
    

    //returning header of todos table
    public function getHeader() {
        return array('Id','Owner Email','Owner Id','Created Date','Due Date','Message','IsDone');
    }

    //returning values stored in attributes (row of todos table)
    public function getRecord() {
        return array($this->id,$this->owneremail,$this->ownerid,$this->createddate,$this->duedate,$this->message,$this->isdone);
    }
}


//Displays all records from accounts table
htmlTable::displayTitle("Select all records from : accounts");
$records = accounts::findAll();
htmlTable::displayTable($records);

//Displays one record from accounts table
htmlTable::displayTitle("Select one record from : accounts");
$record = accounts::findOne(8);
htmlTable::displayMessage('Selected Id : 8');
htmlTable::displayTable($record);


//Inserting record in accounts table
htmlTable::displayTitle("Insert new record into : accounts");
$record = new account("temp@gmail.com","Julie","Cortes","4532","1990-01-01","Female","3425dfe");
$savedRecord = $record->save();
//savedRecord[0] = Inserted record (All values in row)
//savedRecord[1] = id of last inderted record
htmlTable::displayMessage($savedRecord[0]);
$records = accounts::findAll();
htmlTable::displayTable($records);

//Updating record in accounts table
htmlTable::displayTitle("Update record into : accounts");
$record = accounts::findOne($savedRecord[1]);
$record->email = 'julie.cortes@gmail.com';
$updatedRecord = $record->save();
htmlTable::displayMessage($updatedRecord[0]);
$records = accounts::findAll();
htmlTable::displayTable($records);

//Deleting record in accounts table
htmlTable::displayTitle("Delete record from : accounts");
$record->id = $savedRecord[1];
$record->delete();
htmlTable::displayMessage('Deleted Id : '.$record->id);
$records = accounts::findAll();
htmlTable::displayTable($records);


htmlTable::breakLine(2);
date_default_timezone_set('UTC');

//Displays all records from todos table
htmlTable::displayTitle("Select all records from : todos");
$records = todos::findAll();
htmlTable::displayTable($records);

//Displays one record from todos table
htmlTable::displayTitle("Select one record from : todos");
$record = todos::findOne(4);
htmlTable::displayMessage('Selected Id : 4');
htmlTable::displayTable($record);

//Inserting record in todos table
htmlTable::displayTitle("Insert new record into : todos");
$record = new todo('temp@gmail.com','5',date("Y-m-d h:i:sa"),date("Y-m-d h:i:sa", strtotime("+5 days")),'Hello','0');
$savedRecord = $record->save();
//savedRecord[0] = Inserted record (All values in row)
//savedRecord[1] = id of last inderted record
htmlTable::displayMessage($savedRecord[0]);
$records = todos::findAll();
htmlTable::displayTable($records);

//Updating record in todos table
htmlTable::displayTitle("Update record into : todos");
$record = todos::findOne($savedRecord[1]);
$record->owneremail = 'julie.cortes@gmail.com';
$record->isdone = 1;
$updatedRecord = $record->save();
htmlTable::displayMessage($updatedRecord[0]);
$records = todos::findAll();
htmlTable::displayTable($records);

//Deleting record in todos table
htmlTable::displayTitle("Delete record from : todos");
$record->id = $savedRecord[1];
$record->delete();
htmlTable::displayMessage('Deleted Id : '.$record->id);
$records = todos::findAll();
htmlTable::displayTable($records);

?>


