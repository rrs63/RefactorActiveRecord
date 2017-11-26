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


//class contains methods to fetch data from todos table
final class todos extends collection {
    protected static $modelName = 'todo';
}

//class contains methods to fetch data from accounts table
final class accounts extends collection {
    protected static $modelName = 'account';
}


//Displays all records from accounts table
htmlTable::displayTitle("Select all records from : accounts");
$records = accounts::findAll();
htmlTable::displayTable($records);

//Displays one record from accounts table
htmlTable::displayTitle("Select one record from : accounts");
$record = accounts::findOne(8);
htmlTable::displayMessage('Select record with id : 8');
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
htmlTable::displayMessage('Delete record with id : '.$record->id);
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
htmlTable::displayMessage('Select record with id : 4');
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
htmlTable::displayMessage('Delete record with id : '.$record->id);
$records = todos::findAll();
htmlTable::displayTable($records);

?>


