<?php    
/*
 * PHP QR Code encoder
 *
 * Exemplatory usage
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
    
	
	//
	$nombre= "christian";
	$apellido= "alvarez";
	$codigoEstudiante= "00104108";
	$fecha= date("d/m/Y");
	
	function getCode($nombre,$apellido,$codigoEstudiante,$fecha){
		$result = $nombre . $apellido . $codigoEstudiante .$fecha;
		return md5($result);  
	}
	
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    $filename = $PNG_TEMP_DIR.$codigoEstudiante.'.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';    

    $matrixPointSize = 5;

	 
    // user data
    $filename = $PNG_TEMP_DIR.$codigoEstudiante.'.png';
    QRcode::png(getCode($nombre,$apellido,$codigoEstudiante,$fecha), $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    
        
    //display generated file
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
    
    //config form
    echo '<form action="index.php" method="post">';
        
     
    echo '<input type="submit" value="GENERATE"></form><hr/>';
           

    