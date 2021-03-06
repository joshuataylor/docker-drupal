Docker Drupal
=============

### Status

[![Build Status](https://travis-ci.org/nickschuch/docker-drupal.svg?branch=master)](https://travis-ci.org/nickschuch/docker-drupal) [![Coverage Status](https://coveralls.io/repos/nickschuch/docker-drupal/badge.png?branch=coveralls)](https://coveralls.io/r/nickschuch/docker-drupal?branch=coveralls)

### Overview

Base containers that are used for a Drupal Travis CI knockoff.

![Diagram](./docs/diagram.png "docs/diagram.png")

### Containers

All the containers that are provided for this CI can be found here:

[Read more about Container docs](containers)

### The compiler

While our containers do run the TravisCI configuration file. They only run the
build "script" instructions. It's up to us to:

* Build all the permutations.
* Links Docker containers so we have "services".

[Read more about the Compiler](compiler)

### Vagrant

Vagrant is very handy. If you do not run Docker natively the following VM will
provide a method for debugging and building and executing of containers locally.

Install Vagrant (1.6.x):

```
http://www.vagrantup.com/downloads.html
```

Spin up a VM with Docker with the following command:

```
vagrant up
```

### Contribution.

Please see the issue page for a list of tasks we still need to do. If you find a bug please create a new issue.

Cheers!
