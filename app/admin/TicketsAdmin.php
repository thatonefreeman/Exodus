<?php

use KraftHaus\Bauhaus\Admin;

class TicketsAdmin extends Admin
{

    public function configureList($mapper)
    {
        // Render the title in the overview
	$mapper->identifier('id');
        $mapper->string('ticket_subject')->label('Subject');
        $mapper->string('ticket_client')->label('Client');
        $mapper->string('status')->label('Ticket Status');
    }

    // Add new
    public function configureForm($mapper)
    {
        $mapper->text('ticket_subject')->label('Ticket Subject');
        $mapper->text('client_number')->label('Client');
        $mapper->select('status')->options(['Open','Closed','Resolved','Other'])->label('Ticket Status');
        $mapper->wysiwyg('ticket_body')->label('Ticket Details');
    }

    public function configureFilters($mapper)
    {
        $mapper->text('id')->label('Ticket ID');
        $mapper->text('ticket_client_id')->label('Client ID');
    }

}