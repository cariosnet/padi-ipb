<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = 'pages/error404';

//WildCard by efriandika@gmail.com
// $route['kanal/(?!index)(.+)'] = "cat/detail/$1";


$route['home/news/view/([a-zA-Z0-9_-]+)'] = "home/news_detail/$1";

$route['berita'] = "news/news_list";
$route['berita/([a-zA-Z0-9_-]+)'] = "news/news_category_list/$1";
$route['berita/([a-zA-Z0-9_-]+)/([0-9])'] = "news/news_category_list/$1/$2";
$route['artikel/([a-zA-Z0-9_-]+)'] = "news/artikel_list/$1";
$route['artikel/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)'] = "news/artikel_category_list/$1/$2";
$route['artikel/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([0-9])'] = "news/artikel_category_list/$1/$2/$3";
$route['pages/(?!index|error404)(.+)'] = "pages/detail/$1";
$route['indeks/(?!index|ajax_filter|ajax_filter_special|dialog|fokus)(.+)'] = "indeks/index/$1";

$route['bank_data/list/([a-zA-Z0-9_-]+)'] = "bank_data/bank_data_list/$1";
$route['bank_data/list/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)'] = "bank_data/bank_data_list/$1/$2";
$route['bank_data'] = "bank_data/bank_data_list/RE";
$route['bank_data/ajax_filter_data'] = "bank_data/ajax_filter_data";

$route['backoffice/profile/(?!index|edit|submit)(.+)'] = "backoffice/profile/detail/$1";

$route['m/kanal/(?!index)(.+)'] = "m/cat/detail/$1";
$route['m/pages/(?!index|error404)(.+)'] = "m/pages/detail/$1";
$route['m/indeks/(?!index|ajax_filter|ajax_filter_special|dialog|fokus)(.+)'] = "m/indeks/index/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */