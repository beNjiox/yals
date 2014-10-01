## Yet Another Laravel Sample

This is a laravel4.1 showcase app which tries to leverage all the best practices and feature of the framework, including:

* Nested controllers
* Testing integration, acceptance, unit, (100% coverage is the goal to reach)
* Testable code (Repositories,services,IoC usage everywhere)
* S.O.L.I.D principles
* Faker
* "Complex" queries
* Caching (through observer pattern)
* and a lot more.

To boot this app, just map it using homestead.


What your Homestead.yaml might look like
```yaml
---
ip: "192.168.10.10"
memory: 2048
cpus: 1

authorize: /Users/me/.ssh/id_rsa.pub

keys:
    - /Users/me/.ssh/id_rsa

folders:
    - map: /Users/me/Documents/GitHub/yals
      to: /home/vagrant/yals

sites:
    - map: yals.app
      to: /home/vagrant/yals/public

variables:
    - key: APP_ENV
      value: local
```

Then, SSH to your vm and run

```
$> cd /path/to/homestead
$> vagrant ssh
$> cd /path/to/mapped/folder
$> php artisan migrate:install
$> php artisan migrate:refresh
$> php artisan db:seed
$> open yals.app:8000
```