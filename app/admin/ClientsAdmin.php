<?php

use KraftHaus\Bauhaus\Admin;

class ClientsAdmin extends Admin
{

    public function configureList($mapper)
    {
        // Render the title in the overview
	$mapper->identifier('id');
        $mapper->string('client_name')->label('Name');
        $mapper->string('client_number')->label('Phone Number');
        $mapper->string('client_email')->label('Email Address');
    }

    // Add new
    public function configureForm($mapper)
    {
        $mapper->boolean('authorized_work', 'false')->label('Does client require work to be verified by a contact?');
        $mapper->text('client_name')->label('Client Name');
        $mapper->text('client_email')->label('Email Address');
        $mapper->text('client_number')->label('Phone Number');
        $mapper->text('client_company_name')->label('Company Name');
        $mapper->textarea('client_address')->label('Client Address');
        $mapper->wysiwyg('client_notes')->label('Notes');
    }

    public function configureFilters($mapper)
    {
        $mapper->text('client_number')->label('Phone Number');
        $mapper->text('client_name')->label('Name');
    }

}