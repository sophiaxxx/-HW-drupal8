<?php

namespace Drupal\Tests\field\Kernel;

use Drupal\Component\Utility\Unicode;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\KernelTests\KernelTestBase;

/**
 * Parent class for Field API unit tests.
 */
abstract class FieldKernelTestBase extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['user', 'system', 'field', 'text', 'entity_test', 'field_test'];

  /**
   * Bag of created field storages and fields.
   *
   * Allows easy access to test field storage/field names/IDs/objects via:
   * - $this->fieldTestData->field_name[suffix]
   * - $this->fieldTestData->field_storage[suffix]
   * - $this->fieldTestData->field_storage_uuid[suffix]
   * - $this->fieldTestData->field[suffix]
   * - $this->fieldTestData->field_definition[suffix]
   *
   * @see \Drupal\field\Tests\FieldUnitTestBase::createFieldWithStorage()
   *
   * @var \ArrayObject
   */
  protected $fieldTestData;

  /**
   * Set the default field storage backend for fields created during tests.
   */
  protected function setUp() {
    parent::setUp();

<<<<<<< HEAD
    $this->fieldTestData = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
=======
    $this->fieldTestData = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->installEntitySchema('entity_test');
    $this->installEntitySchema('user');
    $this->installSchema('system', ['sequences', 'key_value']);

    // Set default storage backend and configure the theme system.
<<<<<<< HEAD
    $this->installConfig(array('field', 'system'));
=======
    $this->installConfig(['field', 'system']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Create user 1.
    $storage = \Drupal::entityManager()->getStorage('user');
    $storage
<<<<<<< HEAD
      ->create(array(
=======
      ->create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'uid' => 1,
        'name' => 'entity-test',
        'mail' => 'entity@localhost',
        'status' => TRUE,
<<<<<<< HEAD
      ))
=======
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->save();
  }

  /**
   * Create a field and an associated field storage.
   *
   * @param string $suffix
   *   (optional) A string that should only contain characters that are valid in
   *   PHP variable names as well.
   * @param string $entity_type
   *   (optional) The entity type on which the field should be created.
   *   Defaults to "entity_test".
   * @param string $bundle
   *   (optional) The entity type on which the field should be created.
   *   Defaults to the default bundle of the entity type.
   */
  protected function createFieldWithStorage($suffix = '', $entity_type = 'entity_test', $bundle = NULL) {
    if (empty($bundle)) {
      $bundle = $entity_type;
    }
    $field_name = 'field_name' . $suffix;
    $field_storage = 'field_storage' . $suffix;
    $field_storage_uuid = 'field_storage_uuid' . $suffix;
    $field = 'field' . $suffix;
    $field_definition = 'field_definition' . $suffix;

    $this->fieldTestData->$field_name = Unicode::strtolower($this->randomMachineName() . '_field_name' . $suffix);
<<<<<<< HEAD
    $this->fieldTestData->$field_storage = FieldStorageConfig::create(array(
=======
    $this->fieldTestData->$field_storage = FieldStorageConfig::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'field_name' => $this->fieldTestData->$field_name,
      'entity_type' => $entity_type,
      'type' => 'test_field',
      'cardinality' => 4,
<<<<<<< HEAD
    ));
    $this->fieldTestData->$field_storage->save();
    $this->fieldTestData->$field_storage_uuid = $this->fieldTestData->$field_storage->uuid();
    $this->fieldTestData->$field_definition = array(
=======
    ]);
    $this->fieldTestData->$field_storage->save();
    $this->fieldTestData->$field_storage_uuid = $this->fieldTestData->$field_storage->uuid();
    $this->fieldTestData->$field_definition = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'field_storage' => $this->fieldTestData->$field_storage,
      'bundle' => $bundle,
      'label' => $this->randomMachineName() . '_label',
      'description' => $this->randomMachineName() . '_description',
<<<<<<< HEAD
      'settings' => array(
        'test_field_setting' => $this->randomMachineName(),
      ),
    );
=======
      'settings' => [
        'test_field_setting' => $this->randomMachineName(),
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->fieldTestData->$field = FieldConfig::create($this->fieldTestData->$field_definition);
    $this->fieldTestData->$field->save();

    entity_get_form_display($entity_type, $bundle, 'default')
<<<<<<< HEAD
      ->setComponent($this->fieldTestData->$field_name, array(
        'type' => 'test_field_widget',
        'settings' => array(
          'test_widget_setting' => $this->randomMachineName(),
        )
      ))
=======
      ->setComponent($this->fieldTestData->$field_name, [
        'type' => 'test_field_widget',
        'settings' => [
          'test_widget_setting' => $this->randomMachineName(),
        ]
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->save();
  }

  /**
   * Saves and reloads an entity.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity to save.
   *
   * @return \Drupal\Core\Entity\EntityInterface
   *   The entity, freshly reloaded from storage.
   */
  protected function entitySaveReload(EntityInterface $entity) {
    $entity->save();
    $controller = $this->container->get('entity.manager')->getStorage($entity->getEntityTypeId());
    $controller->resetCache();
    return $controller->load($entity->id());
  }

  /**
   * Validate and save entity. Fail if violations are found.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity to save.
   */
  protected function entityValidateAndSave(EntityInterface $entity) {
    $violations = $entity->validate();
    if ($violations->count()) {
      $this->fail($violations);
    }
    else {
      $entity->save();
    }
  }

  /**
   * Generate random values for a field_test field.
   *
   * @param $cardinality
   *   Number of values to generate.
   * @return
   *   An array of random values, in the format expected for field values.
   */
  protected function _generateTestFieldValues($cardinality) {
<<<<<<< HEAD
    $values = array();
=======
    $values = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    for ($i = 0; $i < $cardinality; $i++) {
      // field_test fields treat 0 as 'empty value'.
      $values[$i]['value'] = mt_rand(1, 127);
    }
    return $values;
  }

  /**
   * Assert that a field has the expected values in an entity.
   *
   * This function only checks a single column in the field values.
   *
   * @param EntityInterface $entity
   *   The entity to test.
   * @param $field_name
   *   The name of the field to test
   * @param $expected_values
   *   The array of expected values.
   * @param $langcode
   *   (Optional) The language code for the values. Defaults to
   *   \Drupal\Core\Language\LanguageInterface::LANGCODE_NOT_SPECIFIED.
   * @param $column
   *   (Optional) The name of the column to check. Defaults to 'value'.
   */
  protected function assertFieldValues(EntityInterface $entity, $field_name, $expected_values, $langcode = LanguageInterface::LANGCODE_NOT_SPECIFIED, $column = 'value') {
    // Re-load the entity to make sure we have the latest changes.
<<<<<<< HEAD
    \Drupal::entityManager()->getStorage($entity->getEntityTypeId())->resetCache(array($entity->id()));
    $e = entity_load($entity->getEntityTypeId(), $entity->id());
=======
    $storage = $this->container->get('entity_type.manager')
      ->getStorage($entity->getEntityTypeId());
    $storage->resetCache([$entity->id()]);
    $e = $storage->load($this->entityId);

>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $field = $values = $e->getTranslation($langcode)->$field_name;
    // Filter out empty values so that they don't mess with the assertions.
    $field->filterEmptyItems();
    $values = $field->getValue();
    $this->assertEqual(count($values), count($expected_values), 'Expected number of values were saved.');
    foreach ($expected_values as $key => $value) {
<<<<<<< HEAD
      $this->assertEqual($values[$key][$column], $value, format_string('Value @value was saved correctly.', array('@value' => $value)));
=======
      $this->assertEqual($values[$key][$column], $value, format_string('Value @value was saved correctly.', ['@value' => $value]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }
  }

}
