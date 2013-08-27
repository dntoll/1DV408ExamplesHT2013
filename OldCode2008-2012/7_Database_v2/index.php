<?php


require_once("echoBr.php");

require_once("DBConnection.php");
require_once("PersistantClass.php");
require_once("PersistantClassDAL.php");
require_once("../Common/PageView.php");


//Output buffering, all that is echoed is now saved in a buffer
ob_start();


/**
 * Här kommer testkoden för DBConnection...
 */
$dbConnection = new DBConnection();
if ($dbConnection->Connect() === FALSE) {
	echo "Det gick inte!";
}


$dal = new PersistantClassDAL($dbConnection);

$dal->CreateTable();

$dal->Insert(new PersistantClass());
$dal->Insert(new PersistantClass());
$dal->Insert(new PersistantClass());


var_dump($dal->GetAllInstances());
var_dump($dal->SelectBy("Second", "2 Tvåa"));


$object = $dal->SelectByPk(2);

$object->Second = "Två";

$dal->Update(2, $object);
var_dump($dal->GetAllInstances());

$dal->Delete(2);

var_dump($dal->GetAllInstances());

$dal->DropTable();

$dbConnection->Close();



//Stop output buffering...
//get everything that is echoed in a $result variable
$result = ob_get_contents();

//remove it from the buffer
ob_clean();

//stop buffering
ob_end_clean();


//output the contents inside a XHTML-page instead
$pw = new Common\PageView();

echo $pw->GetXHTML10StrictPage("DB Example", $result);




