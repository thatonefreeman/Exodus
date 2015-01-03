<?php

use KraftHaus\Bauhaus\Admin;

class PostAdmin extends Admin
{

	public function configureList($mapper)
	{
		// Render the title in the overview
		$mapper->identifier('title');
	}

	public function configureForm($mapper)
	{
		// Render a text field and a wysiwyg editor
		$mapper->text('title');
		$mapper->wysiwyg('content');
	}

}