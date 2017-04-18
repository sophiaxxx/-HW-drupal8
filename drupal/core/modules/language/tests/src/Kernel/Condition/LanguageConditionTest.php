<?php

namespace Drupal\Tests\language\Kernel\Condition;

use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests that the language condition, provided by the language module, is
 * working properly.
 *
 * @group language
 */
class LanguageConditionTest extends KernelTestBase {

  /**
   * The condition plugin manager.
   *
   * @var \Drupal\Core\Condition\ConditionManager
   */
  protected $manager;

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('system', 'language');
=======
  public static $modules = ['system', 'language'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();

<<<<<<< HEAD
    $this->installConfig(array('language'));
=======
    $this->installConfig(['language']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Setup Italian.
    ConfigurableLanguage::createFromLangcode('it')->save();

    $this->manager = $this->container->get('plugin.manager.condition');
  }

  /**
   * Test the language condition.
   */
  public function testConditions() {
    // Grab the language condition and configure it to check the content
    // language.
    $language = \Drupal::languageManager()->getLanguage('en');
    $condition = $this->manager->createInstance('language')
<<<<<<< HEAD
      ->setConfig('langcodes', array('en' => 'en', 'it' => 'it'))
=======
      ->setConfig('langcodes', ['en' => 'en', 'it' => 'it'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->setContextValue('language', $language);
    $this->assertTrue($condition->execute(), 'Language condition passes as expected.');
    // Check for the proper summary.
    $this->assertEqual($condition->summary(), 'The language is English, Italian.');

    // Change to Italian only.
<<<<<<< HEAD
    $condition->setConfig('langcodes', array('it' => 'it'));
=======
    $condition->setConfig('langcodes', ['it' => 'it']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertFalse($condition->execute(), 'Language condition fails as expected.');
    // Check for the proper summary.
    $this->assertEqual($condition->summary(), 'The language is Italian.');

    // Negate the condition
    $condition->setConfig('negate', TRUE);
    $this->assertTrue($condition->execute(), 'Language condition passes as expected.');
    // Check for the proper summary.
    $this->assertEqual($condition->summary(), 'The language is not Italian.');

    // Change the default language to Italian.
    $language = \Drupal::languageManager()->getLanguage('it');

    $condition = $this->manager->createInstance('language')
<<<<<<< HEAD
      ->setConfig('langcodes', array('en' => 'en', 'it' => 'it'))
=======
      ->setConfig('langcodes', ['en' => 'en', 'it' => 'it'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->setContextValue('language', $language);

    $this->assertTrue($condition->execute(), 'Language condition passes as expected.');
    // Check for the proper summary.
    $this->assertEqual($condition->summary(), 'The language is English, Italian.');

    // Change to Italian only.
<<<<<<< HEAD
    $condition->setConfig('langcodes', array('it' => 'it'));
=======
    $condition->setConfig('langcodes', ['it' => 'it']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($condition->execute(), 'Language condition passes as expected.');
    // Check for the proper summary.
    $this->assertEqual($condition->summary(), 'The language is Italian.');

    // Negate the condition
    $condition->setConfig('negate', TRUE);
    $this->assertFalse($condition->execute(), 'Language condition fails as expected.');
    // Check for the proper summary.
    $this->assertEqual($condition->summary(), 'The language is not Italian.');
  }

}
