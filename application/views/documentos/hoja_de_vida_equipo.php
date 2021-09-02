<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/960/grid_estandar.css" />
        <style type="text/css">
            #contenedor{width: 700px;
                        height: 100%;
                        margin: 0 auto;
                        font-family:"calibrifont";
                        color: #5C5C5B;
                        text-align: justify;
                        line-height:13pt;
                        font-size: 11pt;
                        margin-top: 3cm;
                        margin-left: 2cm;
                        margin-right: 2cm;
                        margin-bottom: 2cm;
            }

            #fecha {
                width: 500px;
                height: 30px;
                margin: 0px 0px 0 0px;
                font-family: calibri;
                font-size: 12pt;
                color: #5C5C5B;
                line-height: 12pt;
                text-align: justify;
            }

            h3 {
                font-family: calibri;
                font-size: 12pt;
                color: #5C5C5B;
                line-height: 18pt;
            }
            .logo{
                float: right;
                width:100%;
                height:68px;
                background-size:100% 100%; 
                background: white url("<?php echo base_url(); ?>assets/images/logo_itm.png") no-repeat scroll left top; 
                background-clip: content-box;                
            }
            .foto{
                float: right;
                width:80%;
                /*background: white url("<?php echo base_url() . $ubicacion_foto; ?>") no-repeat scroll left top; */
                /*background: white url("<?php echo base_url() . $ubicacion_foto; ?>") no-repeat scroll left top; */
                background-clip: content-box;
                height:68px;
                background-size:100% 100%; 
            }
            .tabla_contenedor {
                width: 95%;
                border: 1px solid black;
                border-collapse: collapse;
                text-align: left;
                font-style:normal;
                font-weight:normal;
                font-family:"Century Gothic","sans-serif";
                font-size:11pt;
            }

            table, td, th {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <div id="contenedor">            
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>            
            <div>
                <table class="tabla_contenedor">
                    <tr>
                        <td style="min-width:60px">
                            <img src="assets/images/logo_itm.png" style="width:20%;
                                 height:68px;" />
                        </td>
                        <td style="min-width:60px" align="center">HOJA DE VIDA EQUIPO BIOMÉDICO</td>
                        <td style="min-width:60px">
                            <img src="<?php echo base_url() . $ubicacion_foto; ?>" style="width:20%;
                                 height:68px;" />
                        </td>
                    </tr>
                </table>

            </div>            
            <br>            
            <table class="tabla_contenedor">
                <tr>
                    <th colspan ="6" style="text-align: center;"><b>IDENTIFICACIÓN DEL EQUIPO</b></th>
                </tr>
                <tr>
                    <td><b>Nombre:</b></td>
                    <td colspan="2"><p><?php echo $descripcion; ?></p></td>
                    <td><b>Ubicación:</b></td>
                    <td colspan="2"><p><?php echo $ubicacion; ?></p></td>
                </tr>
                <tr>
                    <td><b>Marca:</b></td>
                    <td><p><?php echo $marca; ?></p></td>
                    <td><b>Modelo:</b></td>
                    <td><p><?php echo $modelo; ?></p></td>
                    <td><b>Serie:</b></td>
                    <td><p><?php echo $no_serie; ?></p></td>
                </tr>
                <tr>
                    <td><b>Fecha adquisición:</b></td>
                    <td><p><?php echo $fecha_compra; ?></p></td>
                    <td><b>Placa inventario:</b></td>
                    <td><p><?php echo $placa_inventario; ?></p></td>
                    <td><b>Periodiciad de mantenimiento:</b></td>
                    <td><p><?php echo 'Cada ' . $periodicidad_mantenimiento . ' meses'; ?></p></td>
                </tr>
            </table>
            <br>            
            <br>
            <br>
            <table class="tabla_contenedor">
                <tr>
                    <th colspan ="6" style="text-align: center;"><b>ESPECIFICACIONES</b></th>
                </tr>
                <tr>
                    <td><b>Voltaje:</b></td>
                    <td><p><?php echo $voltaje; ?></p></td>
                    <td><b>Corriente:</b></td>
                    <td><p><?php echo $corriente; ?></p></td>
                    <td><b>Frecuencia:</b></td>
                    <td><p><?php echo $frecuencia; ?></p></td>
                </tr>
                <tr>
                    <td><b>Peso:</b></td>
                    <td><p><?php echo $peso ; ?></p></td>
                    <td><b>Largo:</b></td>
                    <td><p><?php echo $largo ; ?></p></td>
                    <td><b>Ancho:</b></td>
                    <td><p><?php echo $ancho ; ?></p></td>
                </tr>
                <tr>
                    <td><b>Alto:</b></td>
                    <td><p><?php echo $alto; ?></p></td>
                    <td><b>Rango:</b></td>
                    <td><p><?php echo $rango; ?></p></td>                    
                    <td><b>Manuales:</b></td>
                    <td><p><?php echo ($manuales == '1') ? 'Si' : 'No'; ?></p></td>                    
                </tr>                
            </table>
            <br>            
            <br>
            <br>
            <table class="tabla_contenedor">
                <tr>
                    <td><b>Observaciones:</b></td>
                    <td colspan="5"><p><?php echo $observacion; ?></p></td>
                </tr>
            </table>
        </div>
    </body>
</html>