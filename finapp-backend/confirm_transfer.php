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

include('qrlib.php');
require('config.inc.php');
$accountUrl = $url.'/'.$token.'/operations/account/deposit';
$accountNumber = str_replace('-',' ',$orig_acc);
$value = $amount;
$concept = '';
$payee = '';
$sendData = json_encode(array('accountNumber'=>$accountNumber,'value'=>$value,'additionalData'=>array('concept'=>$concept,'payee'=>$payee)));

$ch = curl_init (); 
  curl_setopt($ch,CURLOPT_URL,$accountUrl);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_POSTFIELDS,$sendData);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$str = curl_exec($ch);
$json = json_decode($str,true);
$sta = $json['status'];

print("<levelData>
	<data>
		<dataId>ok</dataId>");
$qr_token = rand(0,100000);
if ($sta == 'OK') {
	QRcode::png($qr_token,'qrs/'.$qr_token.'.png');

	$xml = 'qrs.xml';
	$sx = simplexml_load_file($xml);

	$new = $sx->data->qrs;
	$qr=$new->addChild('qr');
	$qr->addChild('idQr',$qr_token);
	$next = $qr->addChild('nextLevel');
	$next->addChild('nextLevelLevelId','qr_confirmacion');
	$next->addChild('nextLevelDataId','qr_confirmacion');
		$dom = new DOMDocument('1.0','UTF-8');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($sx->asXML());
		$dom->save($xml);

	print('<headerText>Confirmacion</headerText>
	<imageFile>'.$server_url.'qrs/'.$qr_token.'.png</imageFile>
	');
header("content-type: text/xml");
$t = str_replace('-',' ',$token);
$d = str_replace('-',' ',$dest_acc);
print("<headerText>Confirmacion</headerText>");

print("<text>Transferencia a realizar:\n
	Cuenta de origen: ".$accountNumber."\n
	Cuenta de destino: ".$d."\n
	Cantidad: ".$amount."</text>
		<nextLevel>
			<nextLevelLevelId>transfer_confirmed</nextLevelLevelId>
			<nextLevelDataId>confirmed</nextLevelDataId>
		</nextLevel>
		<prevLevel>
			<nextLevelLevelId>portada</nextLevelLevelId>
			<nextLevelDataId>portada</nextLevelDataId>
		</prevLevel>
");
} else if ($sta == 'ERROR') {
	QRcode::png($qr_token,'qrs/'.$qr_token.'.png');

	$sx = simplexml_load_file($server_url.'qrs.xml');
	$new_qr = $sx->data->qrs->addChild('qr');
	$new_qr->addChild('idQr',$qr_token);
	$next = $new_qr->addChild('nextLevel');
	$next->addChild('nextLevelLevelId','qr_error');
	$next->addChild('nextLevelDataId','qr_error');
	print('<headerText>Confirmacion</headerText>
	<imageFile>'.$server_url.'qrs/'.$qr_token.'.png</imageFile>
	');
	print("<text>Ha ocurrido un error en la transferencia</text>");
}

print('	</data>
</levelData>');
?>
