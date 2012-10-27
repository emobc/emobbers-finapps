<?php

/*	$new_qr = $ax->data->qrs->addChild('qr');;

	$new_qr->addChild('<idQr>','putamadre');
	$next = $new_qr->addChild('<nextLevel>');
	$next->addChild('<nextLevelLevelId>','qr_confirmacion');
	$next->addChild('<nextLevelDataId>','qr_confirmacion');

		$dom = new DOMDocument('1.0','UTF-8');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($ax->asXML());
		$dom->save('lector_qr.xml');*/
					$doc = new DOMDocument('1.0', 'UTF-8');
					$doc->preserveWhiteSpace = false;
					$doc->formatOutput = true;				
						
					$root = $doc->createElement('levelData'); // Se crea la etiqueta levelData
					$doc->appendChild($root); // Se añade al documento
					$datos = $doc->createElement('data'); // Se crea la etiqueta data
					$root->appendChild($datos); // Se añade dentro de levelData
					$id = $doc->createElement('dataId'); // Se crea la etiqueta dataId
					$datos->appendChild($id); // Se añade dentro de data
					$Texto=$doc->createTextNode($item->id); // Se crea el texto datoId (nombre del botón)
					$id->appendChild($Texto); // Se añade a dataId
					$title = $doc->createElement('headerText'); // Se crea headerText
					$datos->appendChild($title); // meto headerText en data
					$texto = $doc->createTextNode($item->headerText);
					$title->appendChild($texto);

			$qrs = $doc->createElement('qrs');
			$datos->appendChild($qrs);
$doc->save('qrs.xml');
?>
