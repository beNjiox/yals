<?php

class TestCompany extends TestCase
{

    /* helpers */

    private function _mockCompanyRepo()
    {
        $companyRepo = Mockery::Mock('Yals\Repositories\CompanyRepositories\DbCompanyRepository');
        $this->app->instance('Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface', $companyRepo);

        return $companyRepo;
    }

    private function _mockCompanyValidator()
    {
        $mockCompanyValidator = Mockery::Mock('Yals\Services\Validation\CompanyValidator');
        $this->app->instance('Yals\Services\Validation\CompanyValidator', $mockCompanyValidator);
        return $mockCompanyValidator;
    }

    private function _newCompany()
    {
        return [
            'name'        => 'my huge LLC',
            'website_url' => 'http://www.myhugellc.org',
            'description' => "this is a A huge LLC",
            'email'       => "ceo@hugellc.org"
        ];
    }

    /* testing views */
    public function test_index_view()
    {
        $crawler  = $this->client->request('GET', '/companies');

        $this->assertCount(8, $crawler->filter(".index-item-row"));
    }

    public function test_create_view()
    {
        $crawler  = $this->client->request('GET', '/companies/create');

        $this->assertCount(1, $crawler->filter("input[name=name]"));
        $this->assertCount(1, $crawler->filter("input[name=website_url]"));
        $this->assertCount(1, $crawler->filter("textarea[name=description]"));
    }

    public function test_update_view()
    {
        $repo    = App::make('Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface');
        $company = $repo->get(1);

        $crawler = $this->client->request('GET', '/companies/1/edit');
        $form    = $crawler->selectButton('Edit this company')->form();

        foreach (['name', 'website_url', 'description'] as $field)
        {
            $this->assertSame($form->getValues()[$field], ($company[$field]));
        }
    }

    public function test_remove_view()
    {
        $crawler = $this->client->request('DELETE', '/companies/1');

        $this->assertRedirectedTo('/companies');
    }

    /*
        Test Repositories
     */
    public function test_creating()
    {
        $new_company = [
            'name'        => 'my huge LLC',
            'website_url' => 'myHugeLLC@example.org',
            'description' => "A huge LLC",
            'email' => "ceo@hugellc.org"
        ];

        $repo    = App::make('Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface');
        $repo->create($new_company);
        $companies = $repo->getAll();

        $this->assertSame($companies[8]['name'], $new_company['name']);
        $this->assertSame($companies[8]['email'], $new_company['email']);
    }

    public function test_updating()
    {
        $repo    = App::make('Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface');
        $company = $repo->get(1);

        $company['name'] = 'my huge LLC';
        $repo->update(1, $company);
        $crawler = $this->client->request('GET', '/companies/1/edit');
        $form    = $crawler->selectButton('Edit this company')->form();

        $this->assertSame($form->getValues()['name'], ($company['name']));
    }

    public function test_removing()
    {
        $repo    = App::make('Yals\Repositories\CompanyRepositories\CompanyRepositoryInterface');
        $repo->deleteById(1);
        $repo->deleteById(2);

        $this->assertCount(6, $repo->getAll());
    }

    /*
        Test Controller
     */

    public function test_store_flow_on_success()
    {
        $new_company = $this->_newCompany();

        $repo_mock      = $this->_mockCompanyRepo();
        $validator_mock = $this->_mockCompanyValidator();

        $validator_mock
            ->shouldReceive('validates')->with($new_company)->once()->andReturn(true);
        $repo_mock
            ->shouldReceive('create')->once();

        $crawler = $this->client->request('POST', '/companies', $new_company);

        $this->assertRedirectedTo('/companies');
        $this->assertSessionHas(['message', 'type' => 'success']);
    }

    public function test_store_flow_on_error()
    {
        $repo_mock      = $this->_mockCompanyRepo();
        $validator_mock = $this->_mockCompanyValidator();

        $validator_mock
            ->shouldReceive('validates')->with([])->once()->andReturn(false)
            ->shouldReceive('errors')->once()->andReturn([]);

        $crawler = $this->client->request('POST', '/companies', []);

        $this->assertRedirectedTo('/companies/create');
        $this->assertSessionHas(['errors']);
    }

    public function test_edit_flow_on_success()
    {
        $edited_company = ['name' => 'My new LLC'];

        $repo_mock      = $this->_mockCompanyRepo();
        $validator_mock = $this->_mockCompanyValidator();

        $validator_mock
            ->shouldReceive('validates')->with($edited_company, 1)->once()->andReturn(true);
        $repo_mock
            ->shouldReceive('update')->once();

        $crawler = $this->client->request('PATCH', '/companies/1', $edited_company);

        $this->assertRedirectedToRoute('companies.show', [ 1 ] );
        $this->assertSessionHas(['message', 'type' => 'success']);
    }

    public function test_edit_flow_on_error()
    {
        $repo_mock      = $this->_mockCompanyRepo();
        $validator_mock = $this->_mockCompanyValidator();

        $validator_mock
            ->shouldReceive('validates')->with([], 1)->once()->andReturn(false)
            ->shouldReceive('errors')->once()->andReturn([]);

        $crawler = $this->client->request('PATCH', '/companies/1', []);

        $this->assertRedirectedTo('/companies/1/edit');
        $this->assertSessionHas(['errors']);
    }

}