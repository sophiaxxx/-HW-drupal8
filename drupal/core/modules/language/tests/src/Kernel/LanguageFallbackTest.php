<?php

namespace Drupal\Tests\language\Kernel;

use Drupal\Core\Language\LanguageInterface;
use Drupal\language\Entity\ConfigurableLanguage;

/**
 * Tests the language fallback behavior.
 *
 * @group language
 */
class LanguageFallbackTest extends LanguageTestBase {

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $i = 0;
<<<<<<< HEAD
    foreach (array('af', 'am', 'ar') as $langcode) {
=======
    foreach (['af', 'am', 'ar'] as $langcode) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $language = ConfigurableLanguage::createFromLangcode($langcode);
      $language->set('weight', $i--);
      $language->save();
    }
  }

  /**
   * Tests language fallback candidates.
   */
  public function testCandidates() {
    $language_list = $this->languageManager->getLanguages();
<<<<<<< HEAD
    $expected = array_keys($language_list + array(LanguageInterface::LANGCODE_NOT_SPECIFIED => NULL));
=======
    $expected = array_keys($language_list + [LanguageInterface::LANGCODE_NOT_SPECIFIED => NULL]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Check that language fallback candidates by default are all the available
    // languages sorted by weight.
    $candidates = $this->languageManager->getFallbackCandidates();
    $this->assertEqual(array_values($candidates), $expected, 'Language fallback candidates are properly returned.');

    // Check that candidates are alterable.
    $this->state->set('language_test.fallback_alter.candidates', TRUE);
    $expected = array_slice($expected, 0, count($expected) - 1);
    $candidates = $this->languageManager->getFallbackCandidates();
    $this->assertEqual(array_values($candidates), $expected, 'Language fallback candidates are alterable.');

    // Check that candidates are alterable for specific operations.
    $this->state->set('language_test.fallback_alter.candidates', FALSE);
    $this->state->set('language_test.fallback_operation_alter.candidates', TRUE);
    $expected[] = LanguageInterface::LANGCODE_NOT_SPECIFIED;
    $expected[] = LanguageInterface::LANGCODE_NOT_APPLICABLE;
<<<<<<< HEAD
    $candidates = $this->languageManager->getFallbackCandidates(array('operation' => 'test'));
    $this->assertEqual(array_values($candidates), $expected, 'Language fallback candidates are alterable for specific operations.');

    // Check that when the site is monolingual no language fallback is applied.
    $langcodes_to_delete = array();
=======
    $candidates = $this->languageManager->getFallbackCandidates(['operation' => 'test']);
    $this->assertEqual(array_values($candidates), $expected, 'Language fallback candidates are alterable for specific operations.');

    // Check that when the site is monolingual no language fallback is applied.
    $langcodes_to_delete = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($language_list as $langcode => $language) {
      if (!$language->isDefault()) {
        $langcodes_to_delete[] = $langcode;
      }
    }
    entity_delete_multiple('configurable_language', $langcodes_to_delete);
    $candidates = $this->languageManager->getFallbackCandidates();
<<<<<<< HEAD
    $this->assertEqual(array_values($candidates), array(LanguageInterface::LANGCODE_DEFAULT), 'Language fallback is not applied when the Language module is not enabled.');
=======
    $this->assertEqual(array_values($candidates), [LanguageInterface::LANGCODE_DEFAULT], 'Language fallback is not applied when the Language module is not enabled.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
