<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
                                'class'    => 'Internet',
                                'function' => 'check_browser',
                                'filename' => 'internet.php',
                                'filepath' => 'hooks'
                                );
$hook['post_controller_constructor'][] = array(
                                'class'    => 'Log',
                                'function' => 'check_login',
                                'filename' => 'log.php',
                                'filepath' => 'hooks'
                                );
$hook['post_controller_constructor'][] = array(
                                'class'    => 'Clave',
                                'function' => 'check_clave',
                                'filename' => 'clave.php',
                                'filepath' => 'hooks'
                                );