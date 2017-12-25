<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config["reuse_query_string"] = true;
$config["page_query_string"] = true;
$config["query_string_segment"] = 'page';
$config["per_page"] = 5;
$config['use_page_numbers'] = TRUE;
$config['cur_tag_open'] = '&nbsp;<li><a class="current">';
$config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '&nbsp<li>';
$config['num_tag_close'] = '&nbsp</li>';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
$config['next_link'] = 'Следущая страница';
$config['prev_link'] = 'Предыдущая страница';