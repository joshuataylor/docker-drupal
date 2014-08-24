Compiler
========

While our containers do run the TravisCI configuration file. They only run the
build "script" instructions. It's up to us to:

* Build all the permutations eg. PHP 5.5 + Mysql and PHP 5.4 and Postgres
* Links containers.

This is where the following compiler comes into play. Here is an example of the
command that you can run to compile the .travis.yml file into the many
permutations.

**Basic**:

The very basic command with standard containers.

```
compiler build
```

**Namespace**:

To override the provider of the containers. A good example of this would be if
you had your own custom containers for testing and/or personal testing.

```
compiler build --namespace="drupal"
```

**Commands**:

This will allow you to define your own custom command groups that will get
loaded from the YAML file.

```
compiler build env before_script script
```

**YAML**:

This allows for a different file to be loaded from the project.

```
compiler build --file=".othername.yml"
```

#### Installation

We use composer to pull down the applications dependencies. Run the following
command to get setup:

```
cd compiler && composer install --prefer-dist
```