<?php

namespace Drupal\Tests\field\Kernel;

use Drupal\Component\Utility\Unicode;
use Drupal\field\Entity\FieldConfig;
use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests multilanguage fields logic.
 *
 * The following tests will check the multilanguage logic in field handling.
 *
 * @group field
 */
class TranslationTest extends FieldKernelTestBase {

  /**
   * Modules to enable.
   *
   * node is required because the tests alter the node entity type.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('language', 'node');
=======
  public static $modules = ['language', 'node'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The name of the field to use in this test.
   *
   * @var string
   */
  protected $fieldName;

  /**
   * The name of the entity type to use in this test.
   *
   * @var string
   */
  protected $entityType = 'test_entity';

  /**
   * An array defining the field storage to use in this test.
   *
   * @var array
   */
  protected $fieldStorageDefinition;

  /**
   * An array defining the field to use in this test.
   *
   * @var array
   */
  protected $fieldDefinition;

  /**
   * The field storage to use in this test.
   *
   * @var \Drupal\field\Entity\FieldStorageConfig
   */
  protected $fieldStorage;

  /**
   * The field to use in this test.
   *
   * @var \Drupal\field\Entity\FieldConfig
   */
  protected $field;

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

    $this->fieldName = Unicode::strtolower($this->randomMachineName());

    $this->entityType = 'entity_test';

<<<<<<< HEAD
    $this->fieldStorageDefinition = array(
=======
    $this->fieldStorageDefinition = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'field_name' => $this->fieldName,
      'entity_type' => $this->entityType,
      'type' => 'test_field',
      'cardinality' => 4,
<<<<<<< HEAD
    );
    $this->fieldStorage = FieldStorageConfig::create($this->fieldStorageDefinition);
    $this->fieldStorage->save();

    $this->fieldDefinition = array(
      'field_storage' => $this->fieldStorage,
      'bundle' => 'entity_test',
    );
=======
    ];
    $this->fieldStorage = FieldStorageConfig::create($this->fieldStorageDefinition);
    $this->fieldStorage->save();

    $this->fieldDefinition = [
      'field_storage' => $this->fieldStorage,
      'bundle' => 'entity_test',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->field = FieldConfig::create($this->fieldDefinition);
    $this->field->save();

    for ($i = 0; $i < 3; ++$i) {
<<<<<<< HEAD
      ConfigurableLanguage::create(array(
        'id' => 'l' . $i,
        'label' => $this->randomString(),
      ))->save();
=======
      ConfigurableLanguage::create([
        'id' => 'l' . $i,
        'label' => $this->randomString(),
      ])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }
  }

  /**
   * Test translatable fields storage/retrieval.
   */
<<<<<<< HEAD
  function testTranslatableFieldSaveLoad() {
=======
  public function testTranslatableFieldSaveLoad() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Enable field translations for nodes.
    field_test_entity_info_translatable('node', TRUE);
    $entity_type = \Drupal::entityManager()->getDefinition('node');
    $this->assertTrue($entity_type->isTranslatable(), 'Nodes are translatable.');

    // Prepare the field translations.
    $entity_type_id = 'entity_test';
    field_test_entity_info_translatable($entity_type_id, TRUE);
    $entity = $this->container->get('entity_type.manager')
      ->getStorage($entity_type_id)
<<<<<<< HEAD
      ->create(array('type' => $this->field->getTargetBundle()));
    $field_translations = array();
=======
      ->create(['type' => $this->field->getTargetBundle()]);
    $field_translations = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $available_langcodes = array_keys($this->container->get('language_manager')->getLanguages());
    $entity->langcode->value = reset($available_langcodes);
    foreach ($available_langcodes as $langcode) {
      $field_translations[$langcode] = $this->_generateTestFieldValues($this->fieldStorage->getCardinality());
      $translation = $entity->hasTranslation($langcode) ? $entity->getTranslation($langcode) : $entity->addTranslation($langcode);
      $translation->{$this->fieldName}->setValue($field_translations[$langcode]);
    }

    // Save and reload the field translations.
    $entity = $this->entitySaveReload($entity);

    // Check if the correct values were saved/loaded.
    foreach ($field_translations as $langcode => $items) {
      $result = TRUE;
      foreach ($items as $delta => $item) {
        $result = $result && $item['value'] == $entity->getTranslation($langcode)->{$this->fieldName}[$delta]->value;
      }
<<<<<<< HEAD
      $this->assertTrue($result, format_string('%language translation correctly handled.', array('%language' => $langcode)));
=======
      $this->assertTrue($result, format_string('%language translation correctly handled.', ['%language' => $langcode]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    // Test default values.
    $field_name_default = Unicode::strtolower($this->randomMachineName() . '_field_name');
    $field_storage_definition = $this->fieldStorageDefinition;
    $field_storage_definition['field_name'] = $field_name_default;
    $field_storage = FieldStorageConfig::create($field_storage_definition);
    $field_storage->save();

    $field_definition = $this->fieldDefinition;
    $field_definition['field_storage'] = $field_storage;
<<<<<<< HEAD
    $field_definition['default_value'] = array(array('value' => rand(1, 127)));
=======
    $field_definition['default_value'] = [['value' => rand(1, 127)]];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $field = FieldConfig::create($field_definition);
    $field->save();

    $translation_langcodes = array_slice($available_langcodes, 0, 2);
    asort($translation_langcodes);
    $translation_langcodes = array_values($translation_langcodes);

<<<<<<< HEAD
    $values = array('type' => $field->getTargetBundle(), 'langcode' => $translation_langcodes[0]);
=======
    $values = ['type' => $field->getTargetBundle(), 'langcode' => $translation_langcodes[0]];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity = $this->container->get('entity_type.manager')
      ->getStorage($entity_type_id)
      ->create($values);
    foreach ($translation_langcodes as $langcode) {
      $values[$this->fieldName][$langcode] = $this->_generateTestFieldValues($this->fieldStorage->getCardinality());
      $translation = $entity->hasTranslation($langcode) ? $entity->getTranslation($langcode) : $entity->addTranslation($langcode);
      $translation->{$this->fieldName}->setValue($values[$this->fieldName][$langcode]);
    }

    $field_langcodes = array_keys($entity->getTranslationLanguages());
    sort($field_langcodes);
    $this->assertEqual($translation_langcodes, $field_langcodes, 'Missing translations did not get a default value.');

    // @todo Test every translation once the Entity Translation API allows for
    //   multilingual defaults.
    $langcode = $entity->language()->getId();
<<<<<<< HEAD
    $this->assertEqual($entity->getTranslation($langcode)->{$field_name_default}->getValue(), $field->getDefaultValueLiteral(), format_string('Default value correctly populated for language %language.', array('%language' => $langcode)));

    // Check that explicit empty values are not overridden with default values.
    foreach (array(NULL, array()) as $empty_items) {
      $values = array('type' => $field->getTargetBundle(), 'langcode' => $translation_langcodes[0]);
=======
    $this->assertEqual($entity->getTranslation($langcode)->{$field_name_default}->getValue(), $field->getDefaultValueLiteral(), format_string('Default value correctly populated for language %language.', ['%language' => $langcode]));

    // Check that explicit empty values are not overridden with default values.
    foreach ([NULL, []] as $empty_items) {
      $values = ['type' => $field->getTargetBundle(), 'langcode' => $translation_langcodes[0]];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $entity = entity_create($entity_type_id, $values);
      foreach ($translation_langcodes as $langcode) {
        $values[$this->fieldName][$langcode] = $this->_generateTestFieldValues($this->fieldStorage->getCardinality());
        $translation = $entity->hasTranslation($langcode) ? $entity->getTranslation($langcode) : $entity->addTranslation($langcode);
        $translation->{$this->fieldName}->setValue($values[$this->fieldName][$langcode]);
        $translation->{$field_name_default}->setValue($empty_items);
        $values[$field_name_default][$langcode] = $empty_items;
      }

      foreach ($entity->getTranslationLanguages() as $langcode => $language) {
<<<<<<< HEAD
        $this->assertEquals([], $entity->getTranslation($langcode)->{$field_name_default}->getValue(), format_string('Empty value correctly populated for language %language.', array('%language' => $langcode)));
=======
        $this->assertEquals([], $entity->getTranslation($langcode)->{$field_name_default}->getValue(), format_string('Empty value correctly populated for language %language.', ['%language' => $langcode]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      }
    }
  }

  /**
   * Tests field access.
   *
   * Regression test to verify that fieldAccess() can be called while only
   * passing the required parameters.
   *
   * @see https://www.drupal.org/node/2404739
   */
  public function testFieldAccess() {
    $access_control_handler = \Drupal::entityManager()->getAccessControlHandler($this->entityType);
    $this->assertTrue($access_control_handler->fieldAccess('view', $this->field));
  }

}
