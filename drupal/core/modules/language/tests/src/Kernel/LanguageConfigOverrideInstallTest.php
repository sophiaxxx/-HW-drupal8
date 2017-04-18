<?php

namespace Drupal\Tests\language\Kernel;

use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\KernelTests\KernelTestBase;

/**
 * Ensures the language config overrides can be installed.
 *
 * @group language
 */
class LanguageConfigOverrideInstallTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('language', 'config_events_test');
=======
  public static $modules = ['language', 'config_events_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests the configuration events are not fired during install of overrides.
   */
  public function testLanguageConfigOverrideInstall() {
    ConfigurableLanguage::createFromLangcode('de')->save();
    // Need to enable test module after creating the language otherwise saving
    // the language will install the configuration.
<<<<<<< HEAD
    $this->enableModules(array('language_config_override_test'));
    \Drupal::state()->set('config_events_test.event', FALSE);
    $this->installConfig(array('language_config_override_test'));
=======
    $this->enableModules(['language_config_override_test']);
    \Drupal::state()->set('config_events_test.event', FALSE);
    $this->installConfig(['language_config_override_test']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $event_recorder = \Drupal::state()->get('config_events_test.event', FALSE);
    $this->assertFalse($event_recorder);
    $config = \Drupal::service('language.config_factory_override')->getOverride('de', 'language_config_override_test.settings');
    $this->assertEqual($config->get('name'), 'Deutsch');
  }

}
