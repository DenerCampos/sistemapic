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
$route['admin/usuario_admin/(:num)'] = 'admin/usuario_admin';
$route['admin/area_admin/(:num)'] = 'admin/area_admin';
$route['admin/setor_admin/(:num)'] = 'admin/setor_admin';
$route['admin/problema_admin/(:num)'] = 'admin/problema_admin';
$route['admin/unidade_admin/(:num)'] = 'admin/unidade_admin';
$route['admin/ocorrencia_estado_admin/(:num)'] = 'admin/ocorrencia_estado_admin';
$route['admin/email_conf_admin/(:num)'] = 'admin/email_conf_admin';
$route['admin/local_maquina_admin/(:num)'] = 'admin/local_maquina_admin';
$route['admin/tipo_maquina_admin/(:num)'] = 'admin/tipo_maquina_admin';
$route['admin/maquina_admin/(:num)'] = 'admin/maquina_admin';

//Ocorrencia
$route['ocorrencia/buscar/(:any)'] = 'ocorrencia/buscar/$1';
$route['ocorrencia/aberto/(:num)'] = 'ocorrencia/aberto';
$route['ocorrencia/atendimento/(:num)'] = 'ocorrencia/atendimento';
$route['ocorrencia/fechado/(:num)'] = 'ocorrencia/fechado';

//Plantão
$route['plantao/(:num)'] = 'plantao';

//Equipamentos
//Maquinas
$route['maquina/(:num)'] = 'maquina';
$route['maquina/buscar/(:any)'] = 'Maquina/buscar/$1';
//PinPad
$route['pinpad/(:num)'] = 'pinpad';
$route['pinpad/buscar/(:any)'] = 'pinpad/buscar/$1';
//Pos
$route['pos/(:num)'] = 'pos';
$route['pos/buscar/(:any)'] = 'pos/buscar/$1';
//Impressora fiscal
$route['fiscal/(:num)'] = 'fiscal';
$route['fiscal/buscar/(:any)'] = 'fiscal/buscar/$1';
//Impressoras
$route['impressora/(:num)'] = 'impressora';
$route['impressora/buscar/(:any)'] = 'impressora/buscar/$1';

//Manutenção
$route['manutencao/defeito/(:num)'] = 'manutencao/defeito';
$route['manutencao/manutencao/(:num)'] = 'manutencao/manutencao';
$route['manutencao/conserto/(:num)'] = 'manutencao/conserto';
$route['manutencao/garantia/(:num)'] = 'manutencao/garantia';
$route['manutencao/buscar/(:any)'] = 'manutencao/buscar/$1';
$route['manutencao/semconserto/(:num)'] = 'manutencao/semconserto';

//Patrimonio
$route['patrimonio/(:num)'] = 'patrimonio';
$route['patrimonio/buscar/(:any)'] = 'patrimonio/buscar/$1';

//Alaliacao
$route['avaliacao/visualizar'] = 'avaliacao';
$route['avaliacao/editar'] = 'avaliacao';
$route['avaliacao/visualizar/(:num)'] = 'avaliacao/visualizar/$1';
$route['avaliacao/editar/(:num)'] = 'avaliacao/editar/$1';
$route['avaliacao/buscar/(:any)'] = 'avaliacao/buscar/$1';
$route['avaliacao/pdf/(:num)'] = 'avaliacao/pdf/$1';
