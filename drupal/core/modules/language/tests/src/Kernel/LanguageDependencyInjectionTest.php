<?php

namespace Drupal\Tests\language\Kernel;

use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\language\Exception\DeleteDefaultLanguageException;

/**
 * Compares the default language from $GLOBALS against the dependency injected
 * language object.
 *
 * @group language
 */
class LanguageDependencyInjectionTest extends LanguageTestBase {

  /**
   * Test dependency injected languages against a new Language object.
   *
   * @see \Drupal\Core\Language\LanguageInterface
   */
<<<<<<< HEAD
  function testDependencyInjectedNewLanguage() {
    $expected = $this->languageManager->getDefaultLanguage();
    $result = $this->languageManager->getCurrentLanguage();
    foreach ($expected as $property => $value) {
      $this->assertEqual($expected->$property, $result->$property, format_string('The dependency injected language object %prop property equals the new Language object %prop property.', array('%prop' => $property)));
=======
  public function testDependencyInjectedNewLanguage() {
    $expected = $this->languageManager->getDefaultLanguage();
    $result = $this->languageManager->getCurrentLanguage();
    foreach ($expected as $property => $value) {
      $this->assertEqual($expected->$property, $result->$property, format_string('The dependency injected language object %prop property equals the new Language object %prop property.', ['%prop' => $property]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }
  }

  /**
   * Test dependency injected Language object against a new default language
   * object.
   *
   * @see \Drupal\Core\Language\Language
   */
<<<<<<< HEAD
  function testDependencyInjectedNewDefaultLanguage() {
=======
  public function testDependencyInjectedNewDefaultLanguage() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $default_language = ConfigurableLanguage::load(\Drupal::languageManager()->getDefaultLanguage()->getId());
    // Change the language default object to different values.
    ConfigurableLanguage::createFromLangcode('fr')->save();
    $this->config('system.site')->set('default_langcode', 'fr')->save();

    // The language system creates a Language object which contains the
    // same properties as the new default language object.
    $result = \Drupal::languageManager()->getCurrentLanguage();
    $this->assertIdentical($result->getId(), 'fr');

    // Delete the language to check that we fallback to the default.
    try {
<<<<<<< HEAD
      entity_delete_multiple('configurable_language', array('fr'));
=======
      entity_delete_multiple('configurable_language', ['fr']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $this->fail('Expected DeleteDefaultLanguageException thrown.');
    }
    catch (DeleteDefaultLanguageException $e) {
      $this->pass('Expected DeleteDefaultLanguageException thrown.');
    }

    // Re-save the previous default language and the delete should work.
    $this->config('system.site')->set('default_langcode', $default_language->getId())->save();

<<<<<<< HEAD
    entity_delete_multiple('configurable_language', array('fr'));
=======
    entity_delete_multiple('configurable_language', ['fr']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $result = \Drupal::languageManager()->getCurrentLanguage();
    $this->assertIdentical($result->getId(), $default_language->getId());
  }

}
