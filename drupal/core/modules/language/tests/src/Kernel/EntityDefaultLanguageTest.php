<?php

namespace Drupal\Tests\language\Kernel;

use Drupal\Core\Language\LanguageInterface;
use Drupal\language\Entity\ContentLanguageSettings;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests default language code is properly generated for entities.
 *
 * @group language
 */
class EntityDefaultLanguageTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('language', 'node', 'field', 'text', 'user', 'system');
=======
  public static $modules = ['language', 'node', 'field', 'text', 'user', 'system'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->installEntitySchema('user');

    // Activate Spanish language, so there are two languages activated.
<<<<<<< HEAD
    $language = $this->container->get('entity.manager')->getStorage('configurable_language')->create(array(
      'id' => 'es',
    ));
=======
    $language = $this->container->get('entity.manager')->getStorage('configurable_language')->create([
      'id' => 'es',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $language->save();

    // Create a new content type which has Undefined language by default.
    $this->createContentType('ctund', LanguageInterface::LANGCODE_NOT_SPECIFIED);
    // Create a new content type which has Spanish language by default.
    $this->createContentType('ctes', 'es');
  }

  /**
   * Tests that default language code is properly set for new nodes.
   */
  public function testEntityTranslationDefaultLanguageViaCode() {
    // With language module activated, and a content type that is configured to
    // have no language by default, a new node of this content type will have
    // "und" language code when language is not specified.
    $node = $this->createNode('ctund');
    $this->assertEqual($node->langcode->value, LanguageInterface::LANGCODE_NOT_SPECIFIED);
    // With language module activated, and a content type that is configured to
    // have no language by default, a new node of this content type will have
    // "es" language code when language is specified as "es".
    $node = $this->createNode('ctund', 'es');
    $this->assertEqual($node->langcode->value, 'es');

    // With language module activated, and a content type that is configured to
    // have language "es" by default, a new node of this content type will have
    // "es" language code when language is not specified.
    $node = $this->createNode('ctes');
    $this->assertEqual($node->langcode->value, 'es');
    // With language module activated, and a content type that is configured to
    // have language "es" by default, a new node of this content type will have
    // "en" language code when language "en" is specified.
    $node = $this->createNode('ctes', 'en');
    $this->assertEqual($node->langcode->value, 'en');

    // Disable language module.
<<<<<<< HEAD
    $this->disableModules(array('language'));
=======
    $this->disableModules(['language']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // With language module disabled, and a content type that is configured to
    // have no language specified by default, a new node of this content type
    // will have site's default language code when language is not specified.
    $node = $this->createNode('ctund');
    $this->assertEqual($node->langcode->value, 'en');
    // With language module disabled, and a content type that is configured to
    // have no language specified by default, a new node of this type will have
    // "es" language code when language "es" is specified.
    $node = $this->createNode('ctund', 'es');
    $this->assertEqual($node->langcode->value, 'es');

    // With language module disabled, and a content type that is configured to
    // have language "es" by default, a new node of this type will have site's
    // default language code when language is not specified.
    $node = $this->createNode('ctes');
    $this->assertEqual($node->langcode->value, 'en');
    // With language module disabled, and a content type that is configured to
    // have language "es" by default, a new node of this type will have "en"
    // language code when language "en" is specified.
    $node = $this->createNode('ctes', 'en');
    $this->assertEqual($node->langcode->value, 'en');
  }

  /**
   * Creates a new node content type.
   *
   * @param string $name
   *   The content type name.
   * @param string $langcode
   *   Default language code of the nodes of this type.
   */
  protected function createContentType($name, $langcode) {
<<<<<<< HEAD
    $content_type = $this->container->get('entity.manager')->getStorage('node_type')->create(array(
=======
    $content_type = $this->container->get('entity.manager')->getStorage('node_type')->create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'name' => 'Test ' . $name,
      'title_label' => 'Title',
      'type' => $name,
      'create_body' => FALSE,
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $content_type->save();
    ContentLanguageSettings::loadByEntityTypeBundle('node', $name)
      ->setLanguageAlterable(FALSE)
      ->setDefaultLangcode($langcode)
      ->save();

  }

  /**
   * Creates a new node of given type and language using Entity API.
   *
   * @param string $type
   *   The node content type.
   * @param string $langcode
   *   (optional) Language code to pass to entity create.
   *
   * @return \Drupal\node\NodeInterface
   *   The node created.
   */
  protected function createNode($type, $langcode = NULL) {
<<<<<<< HEAD
    $values = array(
      'type' => $type,
      'title' => $this->randomString(),
    );
=======
    $values = [
      'type' => $type,
      'title' => $this->randomString(),
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    if (!empty($langcode)) {
      $values['langcode'] = $langcode;
    }
    $node = $this->container->get('entity.manager')->getStorage('node')->create($values);
    return $node;
  }

}
