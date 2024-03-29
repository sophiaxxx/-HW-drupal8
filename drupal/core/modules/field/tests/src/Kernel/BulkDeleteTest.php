<?php

namespace Drupal\Tests\field\Kernel;

use Drupal\Core\Entity\EntityInterface;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Bulk delete storages and fields, and clean up afterwards.
 *
 * @group field
 */
class BulkDeleteTest extends FieldKernelTestBase {

  /**
   * The fields to use in this test.
   *
   * @var array
   */
  protected $fieldStorages;

  /**
   * The entities to use in this test.
   *
   * @var array
   */
  protected $entities;

  /**
   * The entities to use in this test, keyed by bundle.
   *
   * @var array
   */
  protected $entitiesByBundles;

  /**
   * The bundles for the entities used in this test.
   *
   * @var array
   */
  protected $bundles;

  /**
   * The entity type to be used in the test classes.
   *
   * @var string
   */
  protected $entityTypeId = 'entity_test';

  /**
   * Tests that the expected hooks have been invoked on the expected entities.
   *
   * @param $expected_hooks
   *   An array keyed by hook name, with one entry per expected invocation.
   *   Each entry is the value of the "$entity" parameter the hook is expected
   *   to have been passed.
   * @param $actual_hooks
   *   The array of actual hook invocations recorded by field_test_memorize().
   */
<<<<<<< HEAD
  function checkHooksInvocations($expected_hooks, $actual_hooks) {
=======
  public function checkHooksInvocations($expected_hooks, $actual_hooks) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($expected_hooks as $hook => $invocations) {
      $actual_invocations = $actual_hooks[$hook];

      // Check that the number of invocations is correct.
      $this->assertEqual(count($actual_invocations), count($invocations), "$hook() was called the expected number of times.");

      // Check that the hook was called for each expected argument.
      foreach ($invocations as $argument) {
        $found = FALSE;
        foreach ($actual_invocations as $actual_arguments) {
          // The argument we are looking for is either an array of entities as
          // the second argument or a single entity object as the first.
          if ($argument instanceof EntityInterface && $actual_arguments[0]->id() == $argument->id()) {
            $found = TRUE;
            break;
          }
          // In case of an array, compare the array size and make sure it
          // contains the same elements.
          elseif (is_array($argument) && count($actual_arguments[1]) == count($argument) && count(array_diff_key($actual_arguments[1], $argument)) == 0) {
            $found = TRUE;
            break;
          }
        }
        $this->assertTrue($found, "$hook() was called on expected argument");
      }
    }
  }

  protected function setUp() {
    parent::setUp();

<<<<<<< HEAD
    $this->fieldStorages = array();
    $this->entities = array();
    $this->entitiesByBundles = array();

    // Create two bundles.
    $this->bundles = array('bb_1' => 'bb_1', 'bb_2' => 'bb_2');
=======
    $this->fieldStorages = [];
    $this->entities = [];
    $this->entitiesByBundles = [];

    // Create two bundles.
    $this->bundles = ['bb_1' => 'bb_1', 'bb_2' => 'bb_2'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($this->bundles as $name => $desc) {
      entity_test_create_bundle($name, $desc);
    }

    // Create two field storages.
<<<<<<< HEAD
    $field_storage = FieldStorageConfig::create(array(
=======
    $field_storage = FieldStorageConfig::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'field_name' => 'bf_1',
      'entity_type' => $this->entityTypeId,
      'type' => 'test_field',
      'cardinality' => 1
<<<<<<< HEAD
    ));
    $field_storage->save();
    $this->fieldStorages[] = $field_storage;
    $field_storage = FieldStorageConfig::create(array(
=======
    ]);
    $field_storage->save();
    $this->fieldStorages[] = $field_storage;
    $field_storage = FieldStorageConfig::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'field_name' => 'bf_2',
      'entity_type' => $this->entityTypeId,
      'type' => 'test_field',
      'cardinality' => 4
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $field_storage->save();
    $this->fieldStorages[] = $field_storage;

    // For each bundle, create each field, and 10 entities with values for the
    // fields.
    foreach ($this->bundles as $bundle) {
      foreach ($this->fieldStorages as $field_storage) {
        FieldConfig::create([
          'field_storage' => $field_storage,
          'bundle' => $bundle,
        ])->save();
      }
      for ($i = 0; $i < 10; $i++) {
        $entity = $this->container->get('entity_type.manager')
          ->getStorage($this->entityTypeId)
<<<<<<< HEAD
          ->create(array('type' => $bundle));
=======
          ->create(['type' => $bundle]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        foreach ($this->fieldStorages as $field_storage) {
          $entity->{$field_storage->getName()}->setValue($this->_generateTestFieldValues($field_storage->getCardinality()));
        }
        $entity->save();
      }
    }
<<<<<<< HEAD
    $this->entities = entity_load_multiple($this->entityTypeId);
=======
    $this->entities = $this->container->get('entity_type.manager')
      ->getStorage($this->entityTypeId)->loadMultiple();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($this->entities as $entity) {
      // This test relies on the entities having stale field definitions
      // so that the deleted field can be accessed on them. Access the field
      // now, so that they are always loaded.
      $entity->bf_1->value;

      // Also keep track of the entities per bundle.
      $this->entitiesByBundles[$entity->bundle()][$entity->id()] = $entity;
    }
  }

  /**
   * Verify that deleting a field leaves the field data items in the database
   * and that the appropriate Field API functions can operate on the deleted
   * data and field definition.
   *
   * This tests how EntityFieldQuery interacts with field deletion and could be
   * moved to FieldCrudTestCase, but depends on this class's setUp().
   */
<<<<<<< HEAD
  function testDeleteField() {
=======
  public function testDeleteField() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $bundle = reset($this->bundles);
    $field_storage = reset($this->fieldStorages);
    $field_name = $field_storage->getName();
    $factory = \Drupal::service('entity.query');

    // There are 10 entities of this bundle.
    $found = $factory->get('entity_test')
      ->condition('type', $bundle)
      ->execute();
    $this->assertEqual(count($found), 10, 'Correct number of entities found before deleting');

    // Delete the field.
    $field = FieldConfig::loadByName($this->entityTypeId, $bundle, $field_name);
    $field->delete();

    // The field still exists, deleted.
<<<<<<< HEAD
    $fields = entity_load_multiple_by_properties('field_config', array('field_storage_uuid' => $field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE));
=======
    $fields = entity_load_multiple_by_properties('field_config', ['field_storage_uuid' => $field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual(count($fields), 1, 'There is one deleted field');
    $field = $fields[$field->uuid()];
    $this->assertEqual($field->getTargetBundle(), $bundle, 'The deleted field is for the correct bundle');

    // Check that the actual stored content did not change during delete.
    $storage = \Drupal::entityManager()->getStorage($this->entityTypeId);
    /** @var \Drupal\Core\Entity\Sql\DefaultTableMapping $table_mapping */
    $table_mapping = $storage->getTableMapping();
    $table = $table_mapping->getDedicatedDataTableName($field_storage);
    $column = $table_mapping->getFieldColumnName($field_storage, 'value');
    $result = db_select($table, 't')
      ->fields('t')
      ->execute();
    foreach ($result as $row) {
      $this->assertEqual($this->entities[$row->entity_id]->{$field_name}->value, $row->$column);
    }

    // There are 0 entities of this bundle with non-deleted data.
    $found = $factory->get('entity_test')
      ->condition('type', $bundle)
      ->condition("$field_name.deleted", 0)
      ->execute();
    $this->assertFalse($found, 'No entities found after deleting');

    // There are 10 entities of this bundle when deleted fields are allowed, and
    // their values are correct.
    $found = $factory->get('entity_test')
      ->condition('type', $bundle)
      ->condition("$field_name.deleted", 1)
      ->sort('id')
      ->execute();
    $this->assertEqual(count($found), 10, 'Correct number of entities found after deleting');
    $this->assertFalse(array_diff($found, array_keys($this->entities)));
  }

  /**
   * Tests that recreating a field with the name as a deleted field works.
   */
  public function testPurgeWithDeletedAndActiveField() {
    $bundle = reset($this->bundles);
    // Create another field storage.
    $field_name = 'bf_3';
<<<<<<< HEAD
    $deleted_field_storage = FieldStorageConfig::create(array(
=======
    $deleted_field_storage = FieldStorageConfig::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'field_name' => $field_name,
      'entity_type' => $this->entityTypeId,
      'type' => 'test_field',
      'cardinality' => 1
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $deleted_field_storage->save();
    // Create the field.
    FieldConfig::create([
      'field_storage' => $deleted_field_storage,
      'bundle' => $bundle,
    ])->save();

    for ($i = 0; $i < 20; $i++) {
      $entity = $this->container->get('entity_type.manager')
        ->getStorage($this->entityTypeId)
<<<<<<< HEAD
        ->create(array('type' => $bundle));
=======
        ->create(['type' => $bundle]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $entity->{$field_name}->setValue($this->_generateTestFieldValues(1));
      $entity->save();
    }

    // Delete the field.
    $deleted_field = FieldConfig::loadByName($this->entityTypeId, $bundle, $field_name);
    $deleted_field->delete();
    $deleted_field_uuid = $deleted_field->uuid();

    // Reload the field storage.
<<<<<<< HEAD
    $field_storages = entity_load_multiple_by_properties('field_storage_config', array('uuid' => $deleted_field_storage->uuid(), 'include_deleted' => TRUE));
    $deleted_field_storage = reset($field_storages);

    // Create the field again.
    $field_storage = FieldStorageConfig::create(array(
=======
    $field_storages = entity_load_multiple_by_properties('field_storage_config', ['uuid' => $deleted_field_storage->uuid(), 'include_deleted' => TRUE]);
    $deleted_field_storage = reset($field_storages);

    // Create the field again.
    $field_storage = FieldStorageConfig::create([
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'field_name' => $field_name,
      'entity_type' => $this->entityTypeId,
      'type' => 'test_field',
      'cardinality' => 1
<<<<<<< HEAD
    ));
=======
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $field_storage->save();
    FieldConfig::create([
      'field_storage' => $field_storage,
      'bundle' => $bundle,
    ])->save();

    // The field still exists, deleted, with the same field name.
<<<<<<< HEAD
    $fields = entity_load_multiple_by_properties('field_config', array('uuid' => $deleted_field_uuid, 'include_deleted' => TRUE));
=======
    $fields = entity_load_multiple_by_properties('field_config', ['uuid' => $deleted_field_uuid, 'include_deleted' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue(isset($fields[$deleted_field_uuid]) && $fields[$deleted_field_uuid]->isDeleted(), 'The field exists and is deleted');
    $this->assertTrue(isset($fields[$deleted_field_uuid]) && $fields[$deleted_field_uuid]->getName() == $field_name);

    for ($i = 0; $i < 10; $i++) {
      $entity = $this->container->get('entity_type.manager')
        ->getStorage($this->entityTypeId)
<<<<<<< HEAD
        ->create(array('type' => $bundle));
=======
        ->create(['type' => $bundle]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      $entity->{$field_name}->setValue($this->_generateTestFieldValues(1));
      $entity->save();
    }

    // Check that the two field storages have different tables.
    $storage = \Drupal::entityManager()->getStorage($this->entityTypeId);
    /** @var \Drupal\Core\Entity\Sql\DefaultTableMapping $table_mapping */
    $table_mapping = $storage->getTableMapping();
    $deleted_table_name = $table_mapping->getDedicatedDataTableName($deleted_field_storage, TRUE);
    $active_table_name = $table_mapping->getDedicatedDataTableName($field_storage);

    field_purge_batch(50);

    // Ensure the new field still has its table and the deleted one has been
    // removed.
    $this->assertTrue(\Drupal::database()->schema()->tableExists($active_table_name));
    $this->assertFalse(\Drupal::database()->schema()->tableExists($deleted_table_name));

    // The field has been removed from the system.
<<<<<<< HEAD
    $fields = entity_load_multiple_by_properties('field_config', array('field_storage_uuid' => $deleted_field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE));
=======
    $fields = entity_load_multiple_by_properties('field_config', ['field_storage_uuid' => $deleted_field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual(count($fields), 0, 'The field is gone');

    // Verify there are still 10 entries in the main table.
    $count = \Drupal::database()
      ->select('entity_test__' . $field_name, 'f')
<<<<<<< HEAD
      ->fields('f', array('entity_id'))
=======
      ->fields('f', ['entity_id'])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->condition('bundle', $bundle)
      ->countQuery()
      ->execute()
      ->fetchField();
    $this->assertEqual($count, 10);
  }

  /**
   * Verify that field data items and fields are purged when a field storage is
   * deleted.
   */
<<<<<<< HEAD
  function testPurgeField() {
=======
  public function testPurgeField() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Start recording hook invocations.
    field_test_memorize();

    $bundle = reset($this->bundles);
    $field_storage = reset($this->fieldStorages);
    $field_name = $field_storage->getName();

    // Delete the field.
    $field = FieldConfig::loadByName($this->entityTypeId, $bundle, $field_name);
    $field->delete();

    // No field hooks were called.
    $mem = field_test_memorize();
    $this->assertEqual(count($mem), 0, 'No field hooks were called');

    $batch_size = 2;
    for ($count = 8; $count >= 0; $count -= $batch_size) {
      // Purge two entities.
      field_purge_batch($batch_size);

      // There are $count deleted entities left.
      $found = \Drupal::entityQuery('entity_test')
        ->condition('type', $bundle)
        ->condition($field_name . '.deleted', 1)
        ->execute();
      $this->assertEqual(count($found), $count, 'Correct number of entities found after purging 2');
    }

    // Check hooks invocations.
    // FieldItemInterface::delete() should have been called once for each entity in the
    // bundle.
    $actual_hooks = field_test_memorize();
<<<<<<< HEAD
    $hooks = array();
=======
    $hooks = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entities = $this->entitiesByBundles[$bundle];
    foreach ($entities as $id => $entity) {
      $hooks['field_test_field_delete'][] = $entity;
    }
    $this->checkHooksInvocations($hooks, $actual_hooks);

    // The field still exists, deleted.
<<<<<<< HEAD
    $fields = entity_load_multiple_by_properties('field_config', array('field_storage_uuid' => $field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE));
=======
    $fields = entity_load_multiple_by_properties('field_config', ['field_storage_uuid' => $field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual(count($fields), 1, 'There is one deleted field');

    // Purge the field.
    field_purge_batch($batch_size);

    // The field is gone.
<<<<<<< HEAD
    $fields = entity_load_multiple_by_properties('field_config', array('field_storage_uuid' => $field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE));
=======
    $fields = entity_load_multiple_by_properties('field_config', ['field_storage_uuid' => $field_storage->uuid(), 'deleted' => TRUE, 'include_deleted' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual(count($fields), 0, 'The field is gone');

    // The field storage still exists, not deleted, because it has a second
    // field.
<<<<<<< HEAD
    $storages = entity_load_multiple_by_properties('field_storage_config', array('uuid' => $field_storage->uuid(), 'include_deleted' => TRUE));
=======
    $storages = entity_load_multiple_by_properties('field_storage_config', ['uuid' => $field_storage->uuid(), 'include_deleted' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue(isset($storages[$field_storage->uuid()]), 'The field storage exists and is not deleted');
  }

  /**
   * Verify that field storages are preserved and purged correctly as multiple
   * fields are deleted and purged.
   */
<<<<<<< HEAD
  function testPurgeFieldStorage() {
=======
  public function testPurgeFieldStorage() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Start recording hook invocations.
    field_test_memorize();

    $field_storage = reset($this->fieldStorages);
    $field_name = $field_storage->getName();

    // Delete the first field.
    $bundle = reset($this->bundles);
    $field = FieldConfig::loadByName($this->entityTypeId, $bundle, $field_name);
    $field->delete();

    // Assert that FieldItemInterface::delete() was not called yet.
    $mem = field_test_memorize();
    $this->assertEqual(count($mem), 0, 'No field hooks were called.');

    // Purge the data.
    field_purge_batch(10);

    // Check hooks invocations.
    // FieldItemInterface::delete() should have been called once for each entity in the
    // bundle.
    $actual_hooks = field_test_memorize();
<<<<<<< HEAD
    $hooks = array();
=======
    $hooks = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entities = $this->entitiesByBundles[$bundle];
    foreach ($entities as $id => $entity) {
      $hooks['field_test_field_delete'][] = $entity;
    }
    $this->checkHooksInvocations($hooks, $actual_hooks);

    // The field still exists, deleted.
<<<<<<< HEAD
    $fields = entity_load_multiple_by_properties('field_config', array('uuid' => $field->uuid(), 'include_deleted' => TRUE));
=======
    $fields = entity_load_multiple_by_properties('field_config', ['uuid' => $field->uuid(), 'include_deleted' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue(isset($fields[$field->uuid()]) && $fields[$field->uuid()]->isDeleted(), 'The field exists and is deleted');

    // Purge again to purge the field.
    field_purge_batch(0);

    // The field is gone.
<<<<<<< HEAD
    $fields = entity_load_multiple_by_properties('field_config', array('uuid' => $field->uuid(), 'include_deleted' => TRUE));
    $this->assertEqual(count($fields), 0, 'The field is purged.');
    // The field storage still exists, not deleted.
    $storages = entity_load_multiple_by_properties('field_storage_config', array('uuid' => $field_storage->uuid(), 'include_deleted' => TRUE));
=======
    $fields = entity_load_multiple_by_properties('field_config', ['uuid' => $field->uuid(), 'include_deleted' => TRUE]);
    $this->assertEqual(count($fields), 0, 'The field is purged.');
    // The field storage still exists, not deleted.
    $storages = entity_load_multiple_by_properties('field_storage_config', ['uuid' => $field_storage->uuid(), 'include_deleted' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue(isset($storages[$field_storage->uuid()]) && !$storages[$field_storage->uuid()]->isDeleted(), 'The field storage exists and is not deleted');

    // Delete the second field.
    $bundle = next($this->bundles);
    $field = FieldConfig::loadByName($this->entityTypeId, $bundle, $field_name);
    $field->delete();

    // Assert that FieldItemInterface::delete() was not called yet.
    $mem = field_test_memorize();
    $this->assertEqual(count($mem), 0, 'No field hooks were called.');

    // Purge the data.
    field_purge_batch(10);

    // Check hooks invocations (same as above, for the 2nd bundle).
    $actual_hooks = field_test_memorize();
<<<<<<< HEAD
    $hooks = array();
=======
    $hooks = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entities = $this->entitiesByBundles[$bundle];
    foreach ($entities as $id => $entity) {
      $hooks['field_test_field_delete'][] = $entity;
    }
    $this->checkHooksInvocations($hooks, $actual_hooks);

    // The field and the storage still exist, deleted.
<<<<<<< HEAD
    $fields = entity_load_multiple_by_properties('field_config', array('uuid' => $field->uuid(), 'include_deleted' => TRUE));
    $this->assertTrue(isset($fields[$field->uuid()]) && $fields[$field->uuid()]->isDeleted(), 'The field exists and is deleted');
    $storages = entity_load_multiple_by_properties('field_storage_config', array('uuid' => $field_storage->uuid(), 'include_deleted' => TRUE));
=======
    $fields = entity_load_multiple_by_properties('field_config', ['uuid' => $field->uuid(), 'include_deleted' => TRUE]);
    $this->assertTrue(isset($fields[$field->uuid()]) && $fields[$field->uuid()]->isDeleted(), 'The field exists and is deleted');
    $storages = entity_load_multiple_by_properties('field_storage_config', ['uuid' => $field_storage->uuid(), 'include_deleted' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue(isset($storages[$field_storage->uuid()]) && $storages[$field_storage->uuid()]->isDeleted(), 'The field storage exists and is deleted');

    // Purge again to purge the field and the storage.
    field_purge_batch(0);

    // The field and the storage are gone.
<<<<<<< HEAD
    $fields = entity_load_multiple_by_properties('field_config', array('uuid' => $field->uuid(), 'include_deleted' => TRUE));
    $this->assertEqual(count($fields), 0, 'The field is purged.');
    $storages = entity_load_multiple_by_properties('field_storage_config', array('uuid' => $field_storage->uuid(), 'include_deleted' => TRUE));
=======
    $fields = entity_load_multiple_by_properties('field_config', ['uuid' => $field->uuid(), 'include_deleted' => TRUE]);
    $this->assertEqual(count($fields), 0, 'The field is purged.');
    $storages = entity_load_multiple_by_properties('field_storage_config', ['uuid' => $field_storage->uuid(), 'include_deleted' => TRUE]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual(count($storages), 0, 'The field storage is purged.');
  }

}
