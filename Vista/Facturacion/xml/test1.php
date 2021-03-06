<?php

// Recogemos los valores introducidos en el form
$a1 = $_POST['nombre'];
$a2 = $_POST['apellido'];
// Creamos el fichero XML y su estructura
$dom = new DomDocument("1.0", "UTF-8");
//creating an xslt adding processing line
$xslt = $dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="base.xsl"');
//adding it to the xml
$dom->appendChild($xslt);
$dom->xmlStandalone = true;
// Defiminos el nodo persona
$persona = $dom->createElement('persona');
// Definimos el atributo de persona 'fecha', llamaremos a una función
// PHP que obtiene la fecha actual en un formato específico
$persona->setAttribute('fecha', date('Y/m/d'));
$persona->setAttribute('id', 'comprobante');
$persona->setAttribute('version','1.1.0');

$cliente = $dom->createElement('cliente');
// Campos o nodos de persona
$cliente->appendChild( $dom->createElement('nombre', $a1) );
$cliente->appendChild( $dom->createElement('apellido', $a2) );
 

// Insertamos el elemento persona en la raiz
$persona->appendChild( $cliente );
$dom->appendChild( $persona );
 
// Cerramos el fichero
$xmlData = $dom->saveXML();
 
// Le damos formato (para que no lo muestre todo seguido
// sin saltos de línea)
$dom->formatOutput = true;
 
// Guardar el xml como String...
$strings_xml = $dom->saveXML();
 
// ... e indicamos dónde queremos guardarlo (ruta)
$dom->save('XML/test.xml'); 
 
echo "Archivo XML generado correctamente";
echo "";
echo "Descargar: <a href='XML/test.xml'>AQUI</a>";
?>