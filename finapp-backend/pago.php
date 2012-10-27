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
$token = trim($_GET['t']);
$orig_acc = trim($_GET['o']);
$dest_acc = trim($_GET['d']);
$amount = trim($_GET['a']);

require('config.inc.php');

$accountUrl = $url.'/'.$token.'/operations/account/transfer';
$concept = '';
$payee = '';

$origin_acc = str_replace('-',' ',$orig_acc);
$destin_acc = str_replace('-',' ',$dest_acc);

$sendData = array('originAccount'=>$origin_acc,'destinationAccount'=>$destin_acc,'value'=>$amount,'additionalData'=>array('concept'=>$concept,'payee'=>$payee));
$data = json_encode($sendData);

$ch = curl_init (); 
  curl_setopt($ch,CURLOPT_URL,$accountUrl);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$str = curl_exec($ch);
$json = json_decode($str,true);
$sta = $json['status'];
print("<levelData>
	<data>
		<dataId>confirmed</dataId>");
if ($sta == 'OK') {
print("<headerText>Confirmacion</headerText>
<text>Transaccion realizada</text>
		<nextLevel>
			<nextLevelLevelId>portada</nextLevelLevelId>
			<nextLevelDataId>portada</nextLevelDataId>
		</nextLevel>");
} else if ($sta == 'ERROR') {
print("<headerText>Error</headerText>
<text>Ha ocurrido un error en la transaccion</text>");
}
print("</data>
</levelData
");


?>
