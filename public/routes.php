<?php

$router->get('public', 'PagesController@home');
$router->post('public', 'PagesController@store');
$router->post('public/update', 'PagesController@update');
$router->get('public/delete', 'PagesController@destroy');

$router->get('public/teams', 'TeamsController@index');
$router->post('public/teams', 'TeamsController@store');
$router->get('public/teams/delete', 'TeamsController@destroy');

$router->get('public/champ', 'ChampionshipController@index');
$router->post('public/champ', 'ChampionshipController@store');

$router->post('public/participate', 'ParticipateController@store');
$router->get('public/participate/delete', 'ParticipateController@destroy');