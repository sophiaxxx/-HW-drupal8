<?php

namespace Drupal\language\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Adds a new language with translations and tests language list order.
 *
 * @group language
 */
class LanguageLocaleListTest extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('language', 'locale');
=======
  public static $modules = ['language', 'locale'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    // Add a default locale storage for all these tests.
    $this->storage = $this->container->get('locale.storage');
  }

  /**
   * Tests adding, editing, and deleting languages.
   */
<<<<<<< HEAD
  function testLanguageLocaleList() {
    // User to add and remove language.
    $admin_user = $this->drupalCreateUser(array('administer languages', 'access administration pages'));
    $this->drupalLogin($admin_user);

    // Add predefined language.
    $edit = array(
      'predefined_langcode' => 'fr',
    );
=======
  public function testLanguageLocaleList() {
    // User to add and remove language.
    $admin_user = $this->drupalCreateUser(['administer languages', 'access administration pages']);
    $this->drupalLogin($admin_user);

    // Add predefined language.
    $edit = [
      'predefined_langcode' => 'fr',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->drupalPostForm('admin/config/regional/language/add', $edit, t('Add language'));
    $this->assertText('The language French has been created and can now be used');
    $this->assertUrl(\Drupal::url('entity.configurable_language.collection', [], ['absolute' => TRUE]));
    $this->rebuildContainer();

    // Translate Spanish language to French (Espagnol).
<<<<<<< HEAD
    $source = $this->storage->createString(array(
      'source' => 'Spanish',
      'context' => '',
    ))->save();
    $this->storage->createTranslation(array(
      'lid' => $source->lid,
      'language' => 'fr',
      'translation' => 'Espagnol',
    ))->save();
=======
    $source = $this->storage->createString([
      'source' => 'Spanish',
      'context' => '',
    ])->save();
    $this->storage->createTranslation([
      'lid' => $source->lid,
      'language' => 'fr',
      'translation' => 'Espagnol',
    ])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Get language list displayed in select list.
    $this->drupalGet('fr/admin/config/regional/language/add');
    $select = $this->xpath('//select[@id="edit-predefined-langcode"]');
    $select_element = (array) end($select);
    $options = $select_element['option'];
    // Remove the 'Custom language...' option form the end.
    array_pop($options);
    // Order language list.
    $options_ordered = $options;
    natcasesort($options_ordered);

    // Check the language list displayed is ordered.
    $this->assertTrue($options === $options_ordered, 'Language list is ordered.');
  }

}
