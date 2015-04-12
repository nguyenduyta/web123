<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    $autoload['packages']  = array();
    $autoload['libraries'] = array('database','session','form_validation','recursive','string','menu','code','menumutil','check','request','grid');
    $autoload['helper']    = array('url','file','select','menu');
    $autoload['config']    = array('application');
    $autoload['language']  = array();
    $autoload['model']     = array();
