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
		<dataId>form_deposit</dataId>
		<headerText>Dar prestamo</headerText>
		<nextLevel>
			<nextLevelLevelId>confirm_transfer</nextLevelLevelId>
			<nextLevelDataId>ok</nextLevelDataId>
		</nextLevel>
		<form>
			<actionUrl>'.$server_url.'send_deposit_form.php?token='.$token.'</actionUrl>
			<field>
				<fieldType>INPUT_PICKER</fieldType>
				<fieldLabel>Origin Account:</fieldLabel>
				<fieldName>origin_acc</fieldName>
				<fieldParam></fieldParam>
');
for ($x = 0; $x < count($total); $x++) {
	$sendDataUrl = $url.'/'.$token.'/operations/account/'.$acc_id[$x];
	$curl = curl_init (); 
	  curl_setopt($curl,CURLOPT_URL,$sendDataUrl); 
	  curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); 
	  curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	  curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);

	$response = curl_exec($curl);
	
	$acc = json_decode($response,true);
	$number = $acc['data']['accountNumber'];
	print('				<fieldParam>'.$number.'</fieldParam>
');
}

print('				<required/>
			</field>
			<field>
				<fieldType>INPUT_TEXT</fieldType>
				<fieldLabel>Destination Account:</fieldLabel>
				<fieldName>dest_acc</fieldName>
				<required/>
			</field>
			<field>
				<fieldType>INPUT_NUMBER</fieldType>
				<fieldLabel>Amount:</fieldLabel>
				<fieldName>amount</fieldName>
				<required/>
			</field>
		</form>
	</data>
</levelData>
');
?>
