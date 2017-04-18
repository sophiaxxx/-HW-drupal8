<?php

namespace Drupal\KernelTests\Core\Config;

use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\KernelTests\KernelTestBase;

/**
 * Confirm that language overrides work.
 *
 * @group config
 */
class ConfigLanguageOverrideTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('user', 'language', 'config_test', 'system', 'field');
=======
  public static $modules = ['user', 'language', 'config_test', 'system', 'field'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
<<<<<<< HEAD
    $this->installConfig(array('config_test'));
=======
    $this->installConfig(['config_test']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests locale override based on language.
   */
<<<<<<< HEAD
  function testConfigLanguageOverride() {
=======
  public function testConfigLanguageOverride() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // The language module implements a config factory override object that
    // overrides configuration when the Language module is enabled. This test ensures that
    // English overrides work.
    \Drupal::languageManager()->setConfigOverrideLanguage(\Drupal::languageManager()->getLanguage('en'));
    $config = \Drupal::config('config_test.system');
    $this->assertIdentical($config->get('foo'), 'en bar');

    // Ensure that the raw data is not translated.
    $raw = $config->getRawData();
    $this->assertIdentical($raw['foo'], 'bar');

    ConfigurableLanguage::createFromLangcode('fr')->save();
    ConfigurableLanguage::createFromLangcode('de')->save();

    \Drupal::languageManager()->setConfigOverrideLanguage(\Drupal::languageManager()->getLanguage('fr'));
    $config = \Drupal::config('config_test.system');
    $this->assertIdentical($config->get('foo'), 'fr bar');

    \Drupal::languageManager()->setConfigOverrideLanguage(\Drupal::languageManager()->getLanguage('de'));
    $config = \Drupal::config('config_test.system');
    $this->assertIdentical($config->get('foo'), 'de bar');

    // Test overrides of completely new configuration objects. In normal runtime
    // this should only happen for configuration entities as we should not be
    // creating simple configuration objects on the fly.
    \Drupal::languageManager()
      ->getLanguageConfigOverride('de', 'config_test.new')
      ->set('language', 'override')
      ->save();
    $config = \Drupal::config('config_test.new');
    $this->assertTrue($config->isNew(), 'The configuration object config_test.new is new');
    $this->assertIdentical($config->get('language'), 'override');
    $this->assertIdentical($config->getOriginal('language', FALSE), NULL);

    // Test how overrides react to base configuration changes. Set up some base
    // values.
    \Drupal::configFactory()->getEditable('config_test.foo')
<<<<<<< HEAD
      ->set('value', array('key' => 'original'))
=======
      ->set('value', ['key' => 'original'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->set('label', 'Original')
      ->save();
    \Drupal::languageManager()
      ->getLanguageConfigOverride('de', 'config_test.foo')
<<<<<<< HEAD
      ->set('value', array('key' => 'override'))
=======
      ->set('value', ['key' => 'override'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->set('label', 'Override')
      ->save();
    \Drupal::languageManager()
      ->getLanguageConfigOverride('fr', 'config_test.foo')
<<<<<<< HEAD
      ->set('value', array('key' => 'override'))
      ->save();
    \Drupal::configFactory()->clearStaticCache();
    $config = \Drupal::config('config_test.foo');
    $this->assertIdentical($config->get('value'), array('key' => 'override'));
=======
      ->set('value', ['key' => 'override'])
      ->save();
    \Drupal::configFactory()->clearStaticCache();
    $config = \Drupal::config('config_test.foo');
    $this->assertIdentical($config->get('value'), ['key' => 'override']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Ensure renaming the config will rename the override.
    \Drupal::languageManager()->setConfigOverrideLanguage(\Drupal::languageManager()->getLanguage('en'));
    \Drupal::configFactory()->rename('config_test.foo', 'config_test.bar');
    $config = \Drupal::config('config_test.bar');
<<<<<<< HEAD
    $this->assertEqual($config->get('value'), array('key' => 'original'));
=======
    $this->assertEqual($config->get('value'), ['key' => 'original']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $override = \Drupal::languageManager()->getLanguageConfigOverride('de', 'config_test.foo');
    $this->assertTrue($override->isNew());
    $this->assertEqual($override->get('value'), NULL);
    $override = \Drupal::languageManager()->getLanguageConfigOverride('de', 'config_test.bar');
    $this->assertFalse($override->isNew());
<<<<<<< HEAD
    $this->assertEqual($override->get('value'), array('key' => 'override'));
    $override = \Drupal::languageManager()->getLanguageConfigOverride('fr', 'config_test.bar');
    $this->assertFalse($override->isNew());
    $this->assertEqual($override->get('value'), array('key' => 'override'));

    // Ensure changing data in the config will update the overrides.
    $config = \Drupal::configFactory()->getEditable('config_test.bar')->clear('value.key')->save();
    $this->assertEqual($config->get('value'), array());
=======
    $this->assertEqual($override->get('value'), ['key' => 'override']);
    $override = \Drupal::languageManager()->getLanguageConfigOverride('fr', 'config_test.bar');
    $this->assertFalse($override->isNew());
    $this->assertEqual($override->get('value'), ['key' => 'override']);

    // Ensure changing data in the config will update the overrides.
    $config = \Drupal::configFactory()->getEditable('config_test.bar')->clear('value.key')->save();
    $this->assertEqual($config->get('value'), []);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $override = \Drupal::languageManager()->getLanguageConfigOverride('de', 'config_test.bar');
    $this->assertFalse($override->isNew());
    $this->assertEqual($override->get('value'), NULL);
    // The French override will become empty and therefore removed.
    $override = \Drupal::languageManager()->getLanguageConfigOverride('fr', 'config_test.bar');
    $this->assertTrue($override->isNew());
    $this->assertEqual($override->get('value'), NULL);

    // Ensure deleting the config will delete the override.
    \Drupal::configFactory()->getEditable('config_test.bar')->delete();
    $override = \Drupal::languageManager()->getLanguageConfigOverride('de', 'config_test.bar');
    $this->assertTrue($override->isNew());
    $this->assertEqual($override->get('value'), NULL);
  }

}
