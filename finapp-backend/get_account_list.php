<?php
/**
 *
 * This file is part of eMobc.
 *
 *  eMobc is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  eMobc is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with eMobc.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
require('config.inc.php');
$token = trim($_GET['token']);
$accountUrl = $url.'/'.$token.'/operations/account/list';

$ch = curl_init (); 
  curl_setopt($ch,CURLOPT_URL,$accountUrl); 
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1); 

$str = curl_exec($ch);

$json = json_decode($str,true);

$acc_id = $json['data'];

$total = count($acc_id);
print('<levelData>
  <data>
    <dataId>listado_cuentas</dataId>
    <headerText>Listado de sus cuentas</headerText>
    <order>false</order>
    <geoRef/>
    <list>
');
for ($x = 0; $x < count($total); $x++) {
	$sendDataUrl = $url.'/'.$token.'/operations/account/'.$acc_id[$x];

	$curl = curl_init (); 
	  curl_setopt($curl,CURLOPT_URL,$sendDataUrl); 
	  curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); 
	  curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	  curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);

	$response = curl_exec($curl);

	$acc_data = json_decode($response,true);
	$acc_balance = $acc_data['data']['actualBalance'];
	$acc_number = $acc_data['data']['accountNumber'];
	$acc_currency = $acc_data['data']['currency'];
	
	if ($acc_currency == 0)
		$m = utf8_encode('euros');
	else
		$m = utf8_encode('dolares');

	print('<listItem>
		<description>'.$acc_balance.' '.$m.'</description>
		<text>'.$acc_number.'</text>
		<nextLevel>
		  <nextLevelLevelId>account_info</nextLevelLevelId>
		  <nextLevelDataId>'.$acc_id[$x].'</nextLevelDataId>
		</nextLevel>
		<imageFile>images/imageList.png</imageFile>
	      </listItem>
	');
}
print('</list>
</data>
</levelData>
');
?>
