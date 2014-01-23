<?php

/*
|--------------------------------------------------------------------------
| Link Helpers
|--------------------------------------------------------------------------
|
| this helpers function make link writing way more easier to read
| e.g: to_users($company_id, $user_id, 'edit') <==> link_to_route('companies.users.edit', [$company_id, $user_id])
|
*/

function to_companies($company_id = null, $type = 'show')
{
    if ($company_id == null)
        return route("companies.$type");
    return route("companies.$type", $company_id);

}

function link_to_companies($company_id, $type, $html)
{
    return "<a href='". to_companies($company_id, $type) ."'> $html </a>";
}

function link_to_users($company_id, $user_id, $type, $html)
{
    return "<a href='". to_users($company_id, $user_id, $type) ."'> $html </a>";
}

function to_users($company_id, $user_id = null, $type = 'show')
{
    if ($user_id == null)
        return route("companies.users.$type");
    return route("companies.users.$type", [ $company_id, $user_id ]);

}