<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//paginação 
//Admin
$route['admin/usuario_admin/(:num)'] = 'Admin/Usuario_admin';
$route['admin/area_admin/(:num)'] = 'Admin/Area_admin';
$route['admin/setor_admin/(:num)'] = 'Admin/Setor_admin';
$route['admin/problema_admin/(:num)'] = 'Admin/Problema_admin';
$route['admin/unidade_admin/(:num)'] = 'Admin/Unidade_admin';
$route['admin/ocorrencia_estado_admin/(:num)'] = 'Admin/Ocorrencia_estado_admin';
$route['admin/email_conf_admin/(:num)'] = 'Admin/Email_conf_admin';
$route['admin/local_maquina_admin/(:num)'] = 'Admin/Local_maquina_admin';
$route['admin/tipo_maquina_admin/(:num)'] = 'Admin/Tipo_maquina_admin';
$route['admin/maquina_admin/(:num)'] = 'Admin/Maquina_admin';

//Ocorrencia
$route['ocorrencia/(:num)'] = 'Ocorrencia';

//Plantão
$route['plantao/(:num)'] = 'Plantao';

//Maquina
$route['maquina/(:num)'] = 'Maquina';

//Manutenção
$route['manutencao/defeito/(:num)'] = 'Manutencao/defeito';
$route['manutencao/manutencao/(:num)'] = 'Manutencao/manutencao';
$route['manutencao/conserto/(:num)'] = 'Manutencao/conserto';
$route['manutencao/garantia/(:num)'] = 'Manutencao/garantia';
$route['manutencao/buscar/(:num)'] = 'Manutencao/buscar';
