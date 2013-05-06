<?php

function redirect($location)
{
	header('location:'.BASEPATH.$location);
	exit();
}

function show404()
{
	include ERRPATH.'error_404.html';
	exit();
}

function cout($out)// clean output, use in views
{
	return htmlspecialchars($out);
}