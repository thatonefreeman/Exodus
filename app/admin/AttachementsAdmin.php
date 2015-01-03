<?php

use KraftHaus\Bauhaus\Admin;

class AttachementsAdmin extends Admin
{

    public function configureList($mapper)
    {
        // Render the title in the overview
	$mapper->identifier('id');
        $mapper->string('attachement_name')->label('Attachement Name');
        $mapper->string('client_id')->label('Client ID');
        $mapper->string('last_updated')->label('Last Updated');
    }

    public function configureForm($mapper)
    {
        $mapper->text('attachement_name')->label('Attachement Name');
        $mapper->text('client_id')->label('Client ID');
        $mapper->wysiwyg('attachement_description')->label('Description');
        $mapper->file('file_location')->location('uploads');
    }

    public function configureFilters($mapper)
    {
        $mapper->text('client_name')->label('Name');
    }

}