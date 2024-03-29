<?php

namespace Drupal\Tests\language\Kernel;

use Drupal\KernelTests\KernelTestBase;

/**
 * Test for dependency injected language object.
 */
abstract class LanguageTestBase extends KernelTestBase {

<<<<<<< HEAD
  public static $modules = array('system', 'language', 'language_test');
=======
  public static $modules = ['system', 'language', 'language_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * The state storage service.
   *
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

<<<<<<< HEAD
    $this->installConfig(array('language'));
=======
    $this->installConfig(['language']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->state = $this->container->get('state');

    // Ensure we are building a new Language object for each test.
    $this->languageManager = $this->container->get('language_manager');
    $this->languageManager->reset();
  }

}
