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
$loginUrl = $url.'/access/login/';

$user = trim($_POST['username']);
$password = trim($_POST['password']);

$sendDataUrl = $loginUrl.'?'.$user.':'.$password;
$ch = curl_init (); 
  curl_setopt($ch,CURLOPT_URL,$sendDataUrl); 
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
  curl_setopt($ch,CURLOPT_USERPWD,"$user:$password"); 
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1); 

$str = curl_exec($ch);

$json = json_decode($str,true);

$token = $json['token'];

if (!$json) {
/*print('<dataId>Error</dataId>
	<headerText>Login error</headerText>
	<imageFile/>
	<text>Authentication failed.</text>
');*/
} else {
print('<application>
			<title>App</title>
			<coverFileName>portada.xml</coverFileName>
	<menu>
		<topMenu>top_menu.xml</topMenu>
		<bottomMenu>bottom_menu.xml</bottomMenu> 
		<backgroundMenu>images/backgroundMenu.png</backgroundMenu>
	</menu>
			<levels>
				<level>
				        <levelId>portada</levelId>
				        <levelTitle>Portada</levelTitle>
				        <levelFile>'.$server_url.'cover.php?token='.$token.'</levelFile>
				        <levelType>BUTTONS_ACTIVITY</levelType>
				</level>
				<level>
				        <levelId>mis_cuentas</levelId>
				        <levelTitle>Mis cuentas</levelTitle>
				        <levelFile>'.$server_url.'get_account_list.php?token='.$token.'</levelFile>
				        <levelType>LIST_ACTIVITY</levelType>
				</level>
				<level>
				        <levelId>generar_deposito</levelId>
				        <levelTitle>Generar deposito</levelTitle>
				        <levelFile>'.$server_url.'form_deposit.php?token='.$token.'</levelFile>
				        <levelType>FORM_ACTIVITY</levelType>
				</level>
				<level>
				        <levelId>account_info</levelId>
				        <levelTitle>Generar deposito</levelTitle>
				        <levelFile>'.$server_url.'get_account_info.php?token='.$token.'</levelFile>
				        <levelType>IMAGE_TEXT_DESCRIPTION_ACTIVITY</levelType>
					<levelXib>info</levelXib>
				</level>
				<level>
				        <levelId>qr_confirmacion</levelId>
				        <levelTitle>Generar deposito</levelTitle>
				        <levelFile>'.$server_url.'qr_status.php?msg=0</levelFile>
				        <levelType>IMAGE_TEXT_DESCRIPTION_ACTIVITY</levelType>
					<levelXib>confirmacion</levelXib>
				</level>
				<level>
				        <levelId>qr_error</levelId>
				        <levelTitle>Generar deposito</levelTitle>
				        <levelFile>'.$server_url.'qr_status.php?msg=1</levelFile>
				        <levelType>LIST_ACTIVITY</levelType>
				</level>
				<level>
				        <levelId>lector_qr</levelId>
				        <levelTitle>Lector qr</levelTitle>
				        <levelFile>'.$server_url.'qrs.xml</levelFile>
				        <levelType>QR_ACTIVITY</levelType>
				</level>
			</levels>
</application>');
}
?>
