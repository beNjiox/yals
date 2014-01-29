## Yet Another Laravel Sample

This is a laravel4.1 showcase app which tries to leverage all the best practices and feature of the framework, including

    * Nested controllers
    * Testing integration, acceptance, unit, (100% coverage is the goal to reach)
    * Testable code (Repositories,services,IoC usage everywhere)
    * S.O.L.I.D principles
    * custom Vagrant build
    * Faker
    * Plural strings (ok this one is lame)
    * "Complex" queries
    * Caching (through observer pattern)
    * and a lot more.

The project was initially just for me, but find out that it could be used to showcase some unknown practices of this great framework.

For now it's working pretty well using vagrant but it's still perfect.

If you want to play with it :

```
$> git clone http://github.com/beNjiox/yals
$> cd yals
$> composer update
$> vagrant up
```

To make uses of the vagrant build you need the vagrant box box32 and VirtualBox.

It will install a basic LAMP stack with redis, php5.5 and mysql.
