<?php
include('../settings.php');


function curlWrap($url, $json)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
	curl_setopt($ch, CURLOPT_URL, ZDURL.$url);
	curl_setopt($ch, CURLOPT_USERPWD, ZDUSER."/token:".ZDAPIKEY);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
	curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
	
/*	$fh = fopen('curl.log', 'w');
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_STDERR, $fh);
*/
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$output = curl_exec($ch);
	curl_close($ch);
	$decoded = json_decode($output);
	return $decoded;
}

function createArray($mantisArr)
{
    echo '*****';
    echo $mantisArr["summary"];
    echo '*****';
    echo '*****';
    echo $mantisArr["description"];
    echo '*****';
    echo '*****';
    echo $mantisArr["reporter"]["name"];
    echo '*****';
    echo '*****';
    echo $mantisArr["reporter"]["email"];
    echo '*****';
	$arrZD = array(
		"z_subject"=>$mantisArr["summary"],
	   "z_description"=>$mantisArr["description"],
	   "z_recipient"=>"support@zendesk.com",
	   "z_name"=>"FirstName LastName",
	   "z_requester"=>"first.last@zendesk.org"
	  );
	if (isset($mantisArr["steps_to_reproduce"]))
	{
		$arrZD["z_description"] = $arrZD["z_description"] ."\n steps to reproduce--> \n". $mantisArr["steps_to_reproduce"];
	}
	if (isset($mantisArr["additional_information"]))
	{
		$arrZD["z_description"] = $arrZD["z_description"] ."\n additional information--> \n". $mantisArr["additional_information"];
	}
	return $arrZD;

}

$arrayMantis = array(
	//"id"=>1,
	//"view_state"=>array(
	//					"id"=>10,
	//					"name"=>"public"
	//					),
	//"last_updated":"2012-07-26T11=>54:54+02:00",
	//"project"=>array(
	//				"id"=>1,
	//				"name"=>"ProjectTest"
	//				),
	//"category"=>"OsoPanda",
	//"priority"=>array(
	//				"id"=>30,
	//				"name"=>"normal"
	//				),
	//"severity"=>array(
	//				"id"=>50,
	//				"name"=>"minor"
	//				),
	//"status"=>array(
	//				"id"=>10,
	//				"name"=>"new"
	//				),
	"reporter"=>array(
					"id"=>1,
					"name"=>"Brahim Lachguer",
					"email"=>"brahim.lachguer@eyeos.org"
					),
	"summary"=>"No puedo caminar ya nunca mas o eso me creo yo",
	//"platform"=>"Opera",
	//"os"=>"WindowsXP",
	//"os_build"=>"7",
	//"reproducibility"=>array(
	//						"id"=>10,
	//						"name"=>"always"
	//						),
	//"date_submitted"=>"2012-07-26T11:54:54+02:00",
	//"sponsorship_total"=>0,
	//"projection"=>array(
	//					"id"=>10,
	//					"name"=>"none"
	//					),
	//"eta"=>array(
	//			"id"=>10
	//			,"name"=>"none"
	//			),
	//"resolution"=>array(
	//					"id"=>10,
	//					"name"=>"open"
	//					),
	"description"=>"Me he quedado invalido de pasar tanto tiempo sentado delante de la pantalla",
	"steps_to_reproduce"=>"1. Romperse las piernas\n2. Intentar caminar \n3. No se puede.\n4. FIN",
	"additional_information"=>"Puedo estar asi por un tiempo, pero se me hace dificil "
	//"attachments"=>array(
	//					"id"=>1,
	//					"filename"=>"bug1028.png",
	//					"size"=>82547,
	//					"content_type"=>"image/png",
	//					"date_submitted"=>"2012-07-26T11:54:54+02:00",
	//					"download_url"=>"http=>//localhost/mantis/mantisbt/file_download.php?file_id=1&type=bug",
	//					"user_id"=>1
	//					),
	//"sticky"=>false,
	//"tags"=>array()
	);

function pilgrim_ticket($arrMantis)
{
	$arr = createArray($arrMantis);
	$create = json_encode(
							array(
									'ticket' => array(
													'subject' => $arr['z_subject'], 
													'description' => $arr['z_description'], 
												  	'requester' => array(
												  							'name' => $arr['z_name'], 
												  							'email' => $arr['z_requester']
												  						)
												)
								)
						);

	$data = curlWrap("/tickets.json", $create);

}


if( ! isset($_POST['arrayBugs'])) {
	die('error');
}

var_dump($_POST['arrayBugs']);

$arrayBugs = $_POST['arrayBugs'];

pilgrim_ticket($arrayBugs[0]);

