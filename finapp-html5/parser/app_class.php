<?php

/**
 * Copyright 2012 Neurowork Consulting S.L.
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

/**
 * App XML Parser
 *
 * @param string $xml XML file
 * @return $total
 *
 */

function app($xml){
@session_start();
	if (isset($_SESSION["app"])){
		$app = simplexml_load_string($_SESSION["app"]);
		foreach($app->levels as $item)
		{
			foreach($item->level as $item){
				$levelId[] = $item->levelId;
				$levelTitle[] = $item->levelTitle;
				$levelFile[] = $item->levelFile;
				$levelType[] = $item->levelType;
				$levelTransition[] = $item->levelTransition;
				$levelFormatBg[] = $item->levelFormat->backgroundFileName;
				$levelFormatComp[] = $item->levelFormat->components;
			}
		}
	}
	$app2 = simplexml_load_file($xml);
	foreach($app2->levels as $item)
	{
		foreach($item->level as $item2){
			$levelId[] = $item2->levelId;
			$levelTitle[] = $item2->levelTitle;
			$levelFile[] = $item2->levelFile;
			$levelType[] = $item2->levelType;
			$levelTransition[] = $item2->levelTransition;
			$levelFormatBg[] = $item2->levelFormat->backgroundFileName;
			$levelFormatComp[] = $item2->levelFormat->components;
		}
	}
	$total[0] = $levelId;
	$total[1] = $levelTitle;
	$total[2] = $levelFile;
	$total[3] = $levelType;
	$total[4] = $app2->entryPoint->pointLevelId;
	$total[5] = $app2->entryPoint->pointDataId;
	$total[6] = $app2->menu->topMenu;
	$total[7] = $app2->menu->bottomMenu;
	$total[8] = $app2->banner->type;
	$total[9] = $app2->banner->position;
	$total[10] = $app2->banner->id;
	$total[11] = $levelTransition;
	$total[12] = $levelFormatBg;
	$total[13] = $levelFormatComp;
	$total[14] =  $app2->profileFileName;
	
	return $total;
}
?>
