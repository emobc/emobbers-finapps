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
$token = trim($_GET['token']);
$orig_acc = str_replace(' ','-',$_POST['origin_acc']);
$dest_acc = str_replace(' ','-',$_POST['dest_acc']);
$amount = trim($_POST['amount']);
error_log($orig_acc);
error_log($dest_acc);
error_log($amount);
require('config.inc.php');
print("
<application>
			<title>App2</title>
			<levels>
				<level>
				        <levelId>confirm_transfer</levelId>
				        <levelTitle>Confirmacion</levelTitle>
				        <levelFile>".$server_url."confirm_transfer.php?t=".$token."&amp;o=".$orig_acc."&amp;d=".$dest_acc."&amp;a=".$amount."</levelFile>
				        <levelType>IMAGE_TEXT_DESCRIPTION_ACTIVITY</levelType>
				</level>
				<level>
				        <levelId>transfer_confirmed</levelId>
				        <levelTitle>Procesando</levelTitle>
				        <levelFile>".$server_url."pago.php?t=".$token."&amp;o=".$orig_acc."&amp;d=".$dest_acc."&amp;a=".$amount."</levelFile>
				        <levelType>IMAGE_TEXT_DESCRIPTION_ACTIVITY</levelType>
					<levelXib>confirmacion</levelXib>
				</level>
			</levels>
</application>");

error_log($server_url."confirm_transfer.php?t=".$token."&amp;o=".$orig_acc."&amp;d=".$dest_acc."&amp;a=".$amount);

?>
