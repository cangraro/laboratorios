<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/960/grid_estandar.css" />
        <style type="text/css">
            #contenedor{
                width: 700px;
                height: 100%;
                margin: 0 auto;
                font-family:"calibrifont";                
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
            .tabla_sin_margen {
                width: 95%;
                border: 1px solid white;
                text-align: center;
                font-style:normal;
                font-weight:normal;
                font-family:"Century Gothic","sans-serif";
                font-size:11pt;
            }

            .tabla_contenedor td, th, tr{
                border: 1px solid black;
                border-collapse: collapse;
            }
            .celdas {
                border: 1px solid black;
                border-collapse: collapse;
            }
            .titulo_th{
                background-color:#d6d6c2;                
            }
        </style>
    </head>
    <body>
        <div id="contenedor">            
            <br>
            <br>
            <br>            
            <div>
                <table class="tabla_sin_margen">
                    <tr>
                        <td rowspan="3" style="min-width:40px">
                            <img src="assets/images/logo_itm.png" style="width:20%;
                                 height:68px;" />
                        </td>                        
                        <td rowspan="3" style="min-width:30px">
                            <img src="assets/images/logoLaboratorio.png" style="width:20%;
                                 height:68px;" />
                        </td>
                        <td colspan="3" style="min-width:60px" align="center">REPORTE DE MANTENIMIENTO</td>
                    </tr>
                    <tr class="celdas">
                        <td class="celdas" style="min-width:30px"><?php echo $dia; ?></td>
                        <td class="celdas" style="min-width:30px"><?php echo $mes; ?></td>
                        <td class="celdas" style="min-width:30px"><?php echo $ano; ?></td>
                    </tr>
                    <tr class="celdas">
                        <td class="celdas" style="min-width:30px">Día</td>
                        <td class="celdas" style="min-width:30px">Mes</td>
                        <td class="celdas" style="min-width:30px">Año</td>
                    </tr>
                </table>

            </div>            
            <br>            
            <table class="tabla_contenedor">
                <tr class="titulo_th">
                    <th colspan ="3" style="text-align: center;"><b>IDENTIFICACIÓN DEL EQUIPO</b></th>
                </tr>
                <tr>
                    <td colspan="1"><p>Nombre:</p></td>
                    <td colspan="2"><p><?php echo $nombre_equipo; ?></p></td>                    
                </tr>
                <tr>
                    <td colspan="1"><p>Marca:</p></td>
                    <td colspan="2"><p><?php echo $marca; ?></p></td>
                </tr>
                <tr>
                    <td colspan="1"><p>Modelo:</p></td>
                    <td colspan="2"><p><?php echo $modelo; ?></p></td>
                </tr>
                <tr>
                    <td colspan="1"><p>Serie:</p></td>
                    <td colspan="2"><p><?php echo $no_serie; ?></p></td>
                </tr>
                <tr>
                    <td colspan="1"><p>Placa:</p></td>
                    <td colspan="2"><p><?php echo $placa_inventario; ?></p></td>
                </tr>
                <tr>
                    <td colspan="1"><p>Sede:</p></td>
                    <td colspan="2"><p><?php echo $sede; ?></p></td>
                </tr>
                <tr>
                    <td colspan="1"><p>Ubicación:</p></td>
                    <td colspan="2"><p><?php echo $ubicacion; ?></p></td>
                </tr>
                <tr>
                    <td colspan="1"><p>Persona que solicita el servicio:</p></td>
                    <td colspan="2"><p><?php echo $usuario_sol; ?></p></td>
                </tr>
            </table>
            <br>            
            <br>
            <table class="tabla_contenedor">
                <tr class="titulo_th">
                    <th colspan ="3" style="text-align: center;"><b>SERVICIO SOLICITADO</b></th>
                </tr>
                <tr>
                    <td colspan="1"><p>Tipo de servicio:</p></td>
                    <td colspan="2"><p><?php echo $tipo_servicio; ?></p></td>                    
                </tr>
                <tr>
                    <td colspan="1"><p>Descripción del trabajo:</p></td>
                    <td colspan="2"><p><?php echo $observacion_cierre; ?></p></td>
                </tr>
            </table>
            <br>            
            <br>
            <table class="tabla_contenedor">
                <?php if (count($actividades) > 0) { ?>
                    <tr class="titulo_th">
                        <th colspan ="3" style="text-align: center;"><b>ACTIVIDADES REALIZADAS</b></th>
                    </tr>
                    <?php foreach ($actividades as $actividad) { ?>
                        <tr>
                            <td colspan="1"><p><?php echo $actividad['actividad']; ?></p></td>
                            <td colspan="2"><p><?php echo $actividad['resultado']; ?></p></td>                    
                        </tr>
                    <?php } ?>
                    <tr class="titulo_th">
                        <th colspan ="3" style="text-align: center;"><b>C:cumple / NC: no cumple / NA: no aplica</b></th>
                    </tr>
                <?php } ?>
            </table>
            <br>            
            <br>
            <table class="tabla_contenedor">
                <?php if (count($repuestos) > 0) { ?>
                    <tr class="titulo_th">
                        <th colspan ="3" style="text-align: center;"><b>REPUESTOS UTILIZADOS</b></th>
                    </tr>
                    <tr class="titulo_th">
                        <th colspan="1" style="text-align: center;"><b>Descripción</b></th>
                        <th colspan="2" style="text-align: center;"><b>Cantidad</b></th>
                    </tr>
                    <?php foreach ($repuestos as $repuesto) { ?>
                        <tr>
                            <td colspan="1"><p><?php echo $repuesto['descripcion_repuesto']; ?></p></td>
                            <td colspan="2"><p><?php echo $repuesto['cantidad']; ?></p></td>                    
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
            <br>
            <br>
            <table class="tabla_sin_margen">
                <tr>
                    <td colspan="1">&nbsp;<br></td>
                    <td colspan="2">&nbsp;<br></td>                    
                </tr>
                <tr>
                    <td class="celdas" colspan="1">RECIBE A SATISFACCIÓN</td>
                    <td class="celdas" colspan="2">RESPONSABLE DE EJECUCIÓN</td>                    
                </tr>
            </table>
        </div>
    </body>
</html>