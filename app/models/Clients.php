<?php

class Clients extends \Eloquent
{

	protected $fillable = ['client_name', 'client_company_name', 'authorized_work', 'client_number', 'client_address', 'client_email', 'client_notes'];

}