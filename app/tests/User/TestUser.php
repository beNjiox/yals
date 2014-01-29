<?php

class TestUser extends TestCase
{

    /* helpers */

    protected function _mockCompanyRepo()
    {
        $repo = Mockery::Mock('Yals\Repositories\UserRepositories\DbUserRepository');
        $this->app->instance('Yals\Repositories\UserRepositories\UserRepositoryInterface', $repo);

        return $repo;
    }

    protected function _mockUserValidator()
    {
        $mockValidator = Mockery::Mock('Yals\Services\Validation\UserValidator');
        $this->app->instance('Yals\Services\Validation\UserValidator', $mockValidator);
        return $mockValidator;
    }

    protected function _newUser()
    {
        return [
            'username'   => 'kirikou',
            'email'      => 'kirikou@monami.org',
            'company_id' => 1,
        ];
    }

    /* testing views */
    public function test_index_view()
    {
        $crawler  = $this->client->request('GET', '/companies/1/users');

        $this->assertCount(10, $crawler->filter(".index-item-row"));
    }

    public function test_create_view()
    {
        $crawler  = $this->client->request('GET', '/companies/1/users/create');

        $this->assertCount(1, $crawler->filter("input[name=username]"));
        $this->assertCount(1, $crawler->filter("input[name=email]"));
    }

    public function test_update_view()
    {
        $repo    = App::make('Yals\Repositories\UserRepositories\UserRepositoryInterface');
        $user = $repo->get(1);

        $crawler = $this->client->request('GET', '/companies/1/users/1/edit');
        $form    = $crawler->selectButton('Edit this user')->form();

        foreach (['username', 'email', 'company_id'] as $field)
        {
            $this->assertSame($form->getValues()[$field], ($user[$field]));
        }
    }

    public function test_remove_view()
    {
        $crawler = $this->client->request('DELETE', '/companies/1/users/1');

        $this->assertRedirectedTo('/companies/1/users');
    }

    /*
        Test Repositories
     */
    public function test_creating()
    {
        // $new_user = $this->_newUser();
        // $repo     = App::make('Yals\Repositories\UserRepositories\UserRepositoryInterface');
        // $repo->create($new_user);
        // $users    = $repo->getAll();

        // $this->assertSame($users[8]['name'], $new_user['name']);
        // $this->assertSame($users[8]['email'], $new_user['email']);
    }

    // public function test_updating()
    // {
    //     $repo    = App::make('Yals\Repositories\UserRepositories\UserRepositoryInterface');
    //     $company = $repo->get(1);

    //     $company['name'] = 'my huge LLC';
    //     $repo->update(1, $company);
    //     $crawler = $this->client->request('GET', '/companies/1/edit');
    //     $form    = $crawler->selectButton('Edit this company')->form();

    //     $this->assertSame($form->getValues()['name'], ($company['name']));
    // }

    // public function test_removing()
    // {
    //     $repo    = App::make('Yals\Repositories\UserRepositories\UserRepositoryInterface');
    //     $repo->deleteById(1);
    //     $repo->deleteById(2);

    //     $this->assertCount(6, $repo->getAll());
    // }

    // /*
    //     Test Controller
    //  */

    // public function test_store_flow_on_success()
    // {
    //     $new_company = $this->_newCompany();

    //     $repo_mock      = $this->_mockCompanyRepo();
    //     $validator_mock = $this->_mockUserValidator();

    //     $validator_mock
    //         ->shouldReceive('validates')->with($new_company)->once()->andReturn(true);
    //     $repo_mock
    //         ->shouldReceive('create')->once();

    //     $crawler = $this->client->request('POST', '/companies', $new_company);

    //     $this->assertRedirectedTo('/companies');
    //     $this->assertSessionHas(['message', 'type' => 'success']);
    // }

    // public function test_store_flow_on_error()
    // {
    //     $repo_mock      = $this->_mockCompanyRepo();
    //     $validator_mock = $this->_mockUserValidator();

    //     $validator_mock
    //         ->shouldReceive('validates')->with([])->once()->andReturn(false)
    //         ->shouldReceive('errors')->once()->andReturn([]);

    //     $crawler = $this->client->request('POST', '/companies', []);

    //     $this->assertRedirectedTo('/companies/create');
    //     $this->assertSessionHas(['errors']);
    // }

    // public function test_edit_flow_on_success()
    // {
    //     $edited_company = ['name' => 'My new LLC'];

    //     $repo_mock      = $this->_mockCompanyRepo();
    //     $validator_mock = $this->_mockUserValidator();

    //     $validator_mock
    //         ->shouldReceive('validates')->with($edited_company, 1)->once()->andReturn(true);
    //     $repo_mock
    //         ->shouldReceive('update')->once();

    //     $crawler = $this->client->request('PATCH', '/companies/1', $edited_company);

    //     $this->assertRedirectedToRoute('companies.show', [ 1 ] );
    //     $this->assertSessionHas(['message', 'type' => 'success']);
    // }

    // public function test_edit_flow_on_error()
    // {
    //     $repo_mock      = $this->_mockCompanyRepo();
    //     $validator_mock = $this->_mockUserValidator();

    //     $validator_mock
    //         ->shouldReceive('validates')->with([], 1)->once()->andReturn(false)
    //         ->shouldReceive('errors')->once()->andReturn([]);

    //     $crawler = $this->client->request('PATCH', '/companies/1', []);

    //     $this->assertRedirectedTo('/companies/1/edit');
    //     $this->assertSessionHas(['errors']);
    // }

}