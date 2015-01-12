@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Expenses Tracker
        <small>Overview</small>
    </h1>
</section>
<hr>

<section class="content">
    <h3>To Be Implemented</h3>
    <ul>
        <li>Update expense records</li>
        <li>Delete expense records</li>
        <li>Delete expense attachment/replace existing attachment</li>
        <li>Add additional attachments</li>
        <li>Add/Edit/Delete Expense Categories</li>
        <li></li>
    </ul>
</section>

<section class="content">
    <legend>Current Records</legend>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
            <td><strong>Entry ID</strong></td>
            <td><strong>Expense Type</strong></td>
            <td><strong>Expense Timestamp</strong></td>
            <td><strong>Expense Company</strong></td>
            <td><strong>Created At</strong></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
            <tr>
                <td>{{link_to_route('ex.viewentry', $title=$entry->id, $parameters = array($entry->id), $attributes = array());}}</td>
                <td>{{ $entry->expense_category }}</td>
                <td>{{ $entry->expense_datetime }}</td>
                <td>{{ $entry->expense_company_name }}</td>
                <td>{{ $entry->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@stop