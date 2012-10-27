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
print('<levelData>
	<data>
		<dataId>portada</dataId>
		<headerText>FinApp</headerText>
		<buttons>
			<button>
				<buttonTitle>Generar deposito</buttonTitle>
				<buttonFileName>images/button1.png</buttonFileName>
				<nextLevel>
					<nextLevelLevelId>generar_deposito</nextLevelLevelId>
					<nextLevelDataId>form_deposit</nextLevelDataId>
				</nextLevel>
			</button>
			<button>
				<buttonTitle>Lector QR</buttonTitle>
				<buttonFileName>images/button2.png</buttonFileName>
				<nextLevel>
					<nextLevelLevelId>lector_qr</nextLevelLevelId>
					<nextLevelDataId>lector_qr</nextLevelDataId>
				</nextLevel>
			</button>
			<button>
				<buttonTitle>Mis cuentas</buttonTitle>
				<buttonFileName>images/button3.png</buttonFileName>
				<nextLevel>
					<nextLevelLevelId>mis_cuentas</nextLevelLevelId>
					<nextLevelDataId>listado_cuentas</nextLevelDataId>
				</nextLevel>
			</button>
			<button>
				<buttonTitle></buttonTitle>
				<buttonFileName>images/button4.png</buttonFileName>
			</button>
		</buttons>
	</data>
</levelData>
');
?>
