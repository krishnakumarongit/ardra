<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['login'] = 'welcome/login';
$route['logout'] = 'welcome/logout';
$route['add-member/(:num)'] = 'member/add/$1';
$route['list-members'] = 'member/list';
$route['list-members/(:num)'] = 'member/list/$1';
$route['add-member'] = 'member/add';

$route['add-membership/(:num)'] = 'membership/add/$1';
$route['list-memberships'] = 'membership/list';
$route['list-memberships/(:num)'] = 'membership/list/$1';
$route['add-membership'] = 'membership/add';
$route['get-membership/(:num)'] = 'membership/get/$1';
$route['view-membership/(:num)'] = 'membership/view/$1';
$route['delete-membership/(:num)'] = 'membership/delete/$1';


$route['add-subscription/(:num)'] = 'subscription/add/$1';
$route['list-subscriptions'] = 'subscription/list';
$route['list-subscriptions/(:num)'] = 'subscription/list/$1';
$route['add-subscription'] = 'subscription/add';
$route['view-subscription/(:num)'] = 'subscription/view/$1';
$route['delete-subscription/(:num)'] = 'subscription/delete/$1';


$route['add-payment/(:num)'] = 'payment/add/$1';
$route['list-payment'] = 'payment/list';
$route['list-payment/(:num)'] = 'payment/list/$1';
$route['add-payment'] = 'payment/add';
$route['view-payment/(:num)'] = 'payment/view/$1';
$route['get-user-subscription/(:num)'] = 'payment/viewsubscription/$1';
$route['get-user-subscription-value/(:num)'] = 'payment/balanceSubscription/$1';


$route['delete-payment/(:num)'] = 'payment/delete/$1';

$route['dashboard'] = 'dashboard/index';
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
