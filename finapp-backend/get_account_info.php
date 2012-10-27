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
	$status = $acc['status'];
	$office = $acc['data']['office'];
	$number = $acc['data']['accountNumber'];
	$iban = $acc['data']['iban'];
	$currency = $acc['data']['currency'];
	$available = $acc['data']['availableBalance'];
	$retained = $acc['data']['retainedBalance'];
	$actual = $acc['data']['actualBalance'];
	
	if ($currency == 0)
		$m = 'euros';
	else
		$m = 'dolares';
	
	print('
	<data>
	    <dataId>'.$acc_id[$x].'</dataId>
	    <headerText>Informacion de la cuenta</headerText>
	');
	if ($status == 'OK') {
		print("<text>Numero: ".$number."\n
		Oficina: ".$office."\n
		IBAN: ".$iban."\n
		Saldo disponible: ".$available." ".$m."\n
		Saldo retenido: ".$retained." ".$m."\n
		Saldo actual: ".$actual." ".$m."\n
		</text>
		");
	} else {
		print('<text>Esta cuenta no esta disponible</text>');
	}
	print('
	</data>
');
}
print('</levelData>
');
?>
