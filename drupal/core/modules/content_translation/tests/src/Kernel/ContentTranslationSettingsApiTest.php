<?php

namespace Drupal\Tests\content_translation\Kernel;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests the content translation settings API.
 *
 * @group content_translation
 */
class ContentTranslationSettingsApiTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('language', 'content_translation', 'user', 'entity_test');
=======
  public static $modules = ['language', 'content_translation', 'user', 'entity_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('entity_test_mul');
  }

  /**
   * Tests that enabling translation via the API triggers schema updates.
   */
<<<<<<< HEAD
  function testSettingsApi() {
=======
  public function testSettingsApi() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->container->get('content_translation.manager')->setEnabled('entity_test_mul', 'entity_test_mul', TRUE);
    $result =
      db_field_exists('entity_test_mul_property_data', 'content_translation_source') &&
      db_field_exists('entity_test_mul_property_data', 'content_translation_outdated');
    $this->assertTrue($result, 'Schema updates correctly performed.');
  }

}
