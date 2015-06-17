<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('output'))
{
	function output($result)
	{
            $output['result'] = $result;
            return json_encode($output);
	}
}