<?php

if (! function_exists('until_company')) {
    function until_company($breadcrumbs, $company)
    {
        $breadcrumbs->push('Home', route('dashboard.index'));
        $breadcrumbs->push('Companies', route('companies.index'));
        $breadcrumbs->push($company['name'], route('companies.users.index', $company['id']));

    }

    function until_user($breadcrumbs, $company_id, $user_id)
    {
        until_company($breadcrumbs, $company_id);
        $breadcrumbs->push($user['username'], route('companies.users.show', [ $user['company_id'], $user['id'] ]));
    }
}

Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Home', route('dashboard.index'));
});

Breadcrumbs::register('companies', function($breadcrumbs) {
    $breadcrumbs->push('Home', route('dashboard.index'));
    $breadcrumbs->push('Companies', route('companies.index'));
});

Breadcrumbs::register('companies.show', function($breadcrumbs, $name) {
    $breadcrumbs->push('Home', route('dashboard.index'));
    $breadcrumbs->push('Companies', route('companies.index'));
    $breadcrumbs->push($name);
});

Breadcrumbs::register('companies.edit', function($breadcrumbs, $company) {
    $breadcrumbs->push('Home', route('dashboard.index'));
    $breadcrumbs->push('Companies', route('companies.index'));
    $breadcrumbs->push($company['name'], to_companies($company['id']));
    $breadcrumbs->push(Lang::get('yals.breadcrumb_edit'));
});

/* COMPANIES */

Breadcrumbs::register('companies.users.index', function($breadcrumbs, $company) {
    $breadcrumbs->push('Home', route('dashboard.index'));
    $breadcrumbs->push('Companies', route('companies.index'));
    $breadcrumbs->push($company['name'], to_companies($company['id']));
    $breadcrumbs->push("All users");
});

Breadcrumbs::register('companies.users.show', function($breadcrumbs, $user, $company) {
    until_company($breadcrumbs, $company);
    $breadcrumbs->push($user['username']);
});

Breadcrumbs::register('companies.users.edit', function($breadcrumbs, $user, $company) {
    until_company($breadcrumbs, $company);
    $breadcrumbs->push($user['username'], route('companies.users.show', [ $user['company_id'], $user['id'] ]));
    $breadcrumbs->push('Update');
});

Breadcrumbs::register('companies.users.create', function($breadcrumbs, $company) {
    until_company($breadcrumbs, $company);
    $breadcrumbs->push(Lang::get('yals.user_add'));
});
