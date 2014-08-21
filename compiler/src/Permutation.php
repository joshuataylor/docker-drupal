<?php

namespace Compiler;

class Permutation {

  /**
   * The namespace of the services.
   */
  private $namespace = '';

  /**
   * The build steps that are run for this permuation.
   */
  private $steps = array();

  /**
   * The links that will be attached to the main test container.
   */
  private $links = array();

  /**
   * The language of the test that will be run.
   */
  private $language = '';

  /**
   * The command that gets run as part of the entry point.
   */
  private $cmd = '';

  /**
   * Build steps.
   */
  public function build() {
    $namespace = $this->getNamespace();
    $language = $this->getLanguage();
    $links = $this->getLinks();
    $command = $this->getCommand();

    $run = new DockerRunCommand();
    $run->setRemove(true);
    $run->setImage($namespace . '/' . $language);
    $run->setLinks($links);
    $run->setCommand($command);

    $commands = $this->getSteps();
    $commands[] = $run->build();

    return $commands;
  }

  /**
   * Get namespace.
   */
  public function setNamespace($namespace) {
    $this->namespace = $namespace;
  }

  /**
   * Set namespace.
   */
  public function getNamespace() {
    return $this->namespace;
  }

  /**
   * Get steps.
   */
  public function setSteps($steps) {
    $this->steps = $steps;
  }

  /**
   * Set steps.
   */
  public function getSteps() {
    return $this->steps;
  }

  /**
   * Add a steps.
   */
  public function addStep($command) {
    $this->steps[] = $command;
  }

  /**
   * Get namespace.
   */
  public function setLinks($links) {
    $this->links = $links;
  }

  /**
   * Set namespace.
   */
  public function getLinks() {
    return $this->links;
  }

  /**
   * Set namespace.
   */
  public function addLink($link) {
    $this->links[] = $link;
  }

  /**
   * Adds a container service to the permutation.
   */
  public function addService($service) {
    // Convert the service name to uppercase for bash variables.
    $uppercase_service = strtoupper($service);
    $namespace = $this->getNamespace();

    // Build the service command.
    $run = new DockerRunCommand();
    $run->setDaemon(true);
    $run->setRemove(true);
    $run->setImage($namespace . '/' . $service);
    $command = $run->build();
    $this->addStep($uppercase_service . '_ID=$(' . $command . ')');

    // Build the inspect command.
    $run = new DockerInspectCommand();
    $run->setFormat('{{ .Name }}');
    $run->setContainer('$' . $uppercase_service . '_ID');
    $run->setCommand('| cut -d "/" -f 2');
    $command = $run->build();
    $this->addStep($uppercase_service . '=$(' . $command . ')');

    // Add a link so we can access these services from the main container.
    $this->addLink('$' . $uppercase_service . ':' . $service);
  }

  /**
   * A little wrapper around addService() so we can take multiple services in
   * one line.
   */
  public function addServices($services) {
    foreach ($services as $service) {
      $this->addService($service);
    }
  }

  /**
   * Get language.
   */
  public function setLanguage($language) {
    $this->language = $language;
  }

  /**
   * Set language.
   */
  public function getLanguage() {
    return $this->language;
  }

  /**
   * Gets the cmd.
   */
  public function setCommand($cmd) {
    $this->cmd = $cmd;
  }

  /**
   * Sets the cmd.
   */
  public function getCommand() {
    return $this->cmd;
  }

}
