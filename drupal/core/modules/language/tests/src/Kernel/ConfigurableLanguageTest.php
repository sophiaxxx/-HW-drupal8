<?php

namespace Drupal\Tests\language\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\language\Entity\ConfigurableLanguage;

/**
 * Tests the ConfigurableLanguage entity.
 *
 * @group language
 * @see \Drupal\language\Entity\ConfigurableLanguage.
 */
class ConfigurableLanguageTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('language');
=======
  public static $modules = ['language'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests configurable language name methods.
   */
  public function testName() {
    $name = $this->randomMachineName();
    $language_code = $this->randomMachineName(2);
<<<<<<< HEAD
    $configurableLanguage = new ConfigurableLanguage(array('label' => $name, 'id' => $language_code), 'configurable_language');
=======
    $configurableLanguage = new ConfigurableLanguage(['label' => $name, 'id' => $language_code], 'configurable_language');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($configurableLanguage->getName(), $name);
    $this->assertEqual($configurableLanguage->setName('Test language')->getName(), 'Test language');
  }

}
