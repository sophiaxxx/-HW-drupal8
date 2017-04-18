<?php

namespace Drupal\Tests\datetime\Kernel;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldItemInterface;
<<<<<<< HEAD
=======
use Drupal\datetime\Plugin\Field\FieldType\DateTimeItem;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\entity_test\Entity\EntityTest;
use Drupal\field\Entity\FieldConfig;
use Drupal\Tests\field\Kernel\FieldKernelTestBase;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests the new entity API for the date field type.
 *
 * @group datetime
 */
class DateTimeItemTest extends FieldKernelTestBase {

  /**
<<<<<<< HEAD
=======
   * A field storage to use in this test class.
   *
   * @var \Drupal\field\Entity\FieldStorageConfig
   */
  protected $fieldStorage;

  /**
   * The field used in this test class.
   *
   * @var \Drupal\field\Entity\FieldConfig
   */
  protected $field;

  /**
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('datetime');
=======
  public static $modules = ['datetime'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();

    // Create a field with settings to validate.
<<<<<<< HEAD
    $field_storage = FieldStorageConfig::create(array(
      'field_name' => 'field_datetime',
      'type' => 'datetime',
      'entity_type' => 'entity_test',
      'settings' => array('datetime_type' => 'date'),
    ));
    $field_storage->save();
    $field = FieldConfig::create([
      'field_storage' => $field_storage,
      'bundle' => 'entity_test',
      'settings' => array(
        'default_value' => 'blank',
      ),
    ]);
    $field->save();
=======
    $this->fieldStorage = FieldStorageConfig::create([
      'field_name' => 'field_datetime',
      'type' => 'datetime',
      'entity_type' => 'entity_test',
      'settings' => ['datetime_type' => DateTimeItem::DATETIME_TYPE_DATETIME],
    ]);
    $this->fieldStorage->save();
    $this->field = FieldConfig::create([
      'field_storage' => $this->fieldStorage,
      'bundle' => 'entity_test',
      'settings' => [
        'default_value' => 'blank',
      ],
    ]);
    $this->field->save();
  }

  /**
   * Tests using entity fields of the datetime field type.
   */
  public function testDateTime() {
    $this->fieldStorage->setSetting('datetime_type', DateTimeItem::DATETIME_TYPE_DATETIME);
    $this->fieldStorage->save();

    // Verify entity creation.
    $entity = EntityTest::create();
    $value = '2014-01-01T20:00:00';
    $entity->field_datetime = $value;
    $entity->name->value = $this->randomMachineName();
    $this->entityValidateAndSave($entity);

    // Verify entity has been created properly.
    $id = $entity->id();
    $entity = EntityTest::load($id);
    $this->assertTrue($entity->field_datetime instanceof FieldItemListInterface, 'Field implements interface.');
    $this->assertTrue($entity->field_datetime[0] instanceof FieldItemInterface, 'Field item implements interface.');
    $this->assertEqual($entity->field_datetime->value, $value);
    $this->assertEqual($entity->field_datetime[0]->value, $value);

    // Verify changing the date value.
    $new_value = '2016-11-04T00:21:00';
    $entity->field_datetime->value = $new_value;
    $this->assertEqual($entity->field_datetime->value, $new_value);

    // Read changed entity and assert changed values.
    $this->entityValidateAndSave($entity);
    $entity = EntityTest::load($id);
    $this->assertEqual($entity->field_datetime->value, $new_value);

    // Test the generateSampleValue() method.
    $entity = EntityTest::create();
    $entity->field_datetime->generateSampleItems();
    $this->entityValidateAndSave($entity);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests using entity fields of the date field type.
   */
<<<<<<< HEAD
  public function testDateTimeItem() {
    // Verify entity creation.
    $entity = EntityTest::create();
    $value = '2014-01-01T20:00:00Z';
    $entity->field_datetime = $value;
    $entity->name->value = $this->randomMachineName();
    $entity->save();

    // Verify entity has been created properly.
    $id = $entity->id();
    $entity = entity_load('entity_test', $id);
=======
  public function testDateOnly() {
    $this->fieldStorage->setSetting('datetime_type', DateTimeItem::DATETIME_TYPE_DATE);
    $this->fieldStorage->save();

    // Verify entity creation.
    $entity = EntityTest::create();
    $value = '2014-01-01';
    $entity->field_datetime = $value;
    $entity->name->value = $this->randomMachineName();
    $this->entityValidateAndSave($entity);

    // Verify entity has been created properly.
    $id = $entity->id();
    $entity = EntityTest::load($id);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($entity->field_datetime instanceof FieldItemListInterface, 'Field implements interface.');
    $this->assertTrue($entity->field_datetime[0] instanceof FieldItemInterface, 'Field item implements interface.');
    $this->assertEqual($entity->field_datetime->value, $value);
    $this->assertEqual($entity->field_datetime[0]->value, $value);

    // Verify changing the date value.
<<<<<<< HEAD
    $new_value = $this->randomMachineName();
=======
    $new_value = '2016-11-04';
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity->field_datetime->value = $new_value;
    $this->assertEqual($entity->field_datetime->value, $new_value);

    // Read changed entity and assert changed values.
<<<<<<< HEAD
    $entity->save();
    $entity = entity_load('entity_test', $id);
=======
    $this->entityValidateAndSave($entity);
    $entity = EntityTest::load($id);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($entity->field_datetime->value, $new_value);

    // Test the generateSampleValue() method.
    $entity = EntityTest::create();
    $entity->field_datetime->generateSampleItems();
    $this->entityValidateAndSave($entity);
  }

  /**
   * Tests DateTimeItem::setValue().
   */
  public function testSetValue() {
<<<<<<< HEAD
    // Test DateTimeItem::setValue() using string.
    $entity = EntityTest::create();
    $value = '2014-01-01T20:00:00Z';
    $entity->get('field_datetime')->set(0, $value);
    $entity->save();
    // Load the entity and ensure the field was saved correctly.
    $id = $entity->id();
    $entity = entity_load('entity_test', $id);
=======
    // Test a date+time field.
    $this->fieldStorage->setSetting('datetime_type', DateTimeItem::DATETIME_TYPE_DATETIME);
    $this->fieldStorage->save();

    // Test DateTimeItem::setValue() using string.
    $entity = EntityTest::create();
    $value = '2014-01-01T20:00:00';
    $entity->get('field_datetime')->set(0, $value);
    $this->entityValidateAndSave($entity);
    // Load the entity and ensure the field was saved correctly.
    $id = $entity->id();
    $entity = EntityTest::load($id);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($entity->field_datetime[0]->value, $value, 'DateTimeItem::setValue() works with string value.');

    // Test DateTimeItem::setValue() using property array.
    $entity = EntityTest::create();
<<<<<<< HEAD
    $value = '2014-01-01T20:00:00Z';
    $entity->set('field_datetime', $value);
    $entity->save();
    // Load the entity and ensure the field was saved correctly.
    $id = $entity->id();
    $entity = entity_load('entity_test', $id);
=======
    $value = '2014-01-01T20:00:00';
    $entity->set('field_datetime', $value);
    $this->entityValidateAndSave($entity);
    // Load the entity and ensure the field was saved correctly.
    $id = $entity->id();
    $entity = EntityTest::load($id);
    $this->assertEqual($entity->field_datetime[0]->value, $value, 'DateTimeItem::setValue() works with array value.');

    // Test a date-only field.
    $this->fieldStorage->setSetting('datetime_type', DateTimeItem::DATETIME_TYPE_DATE);
    $this->fieldStorage->save();

    // Test DateTimeItem::setValue() using string.
    $entity = EntityTest::create();
    $value = '2014-01-01';
    $entity->get('field_datetime')->set(0, $value);
    $this->entityValidateAndSave($entity);
    // Load the entity and ensure the field was saved correctly.
    $id = $entity->id();
    $entity = EntityTest::load($id);
    $this->assertEqual($entity->field_datetime[0]->value, $value, 'DateTimeItem::setValue() works with string value.');

    // Test DateTimeItem::setValue() using property array.
    $entity = EntityTest::create();
    $value = '2014-01-01';
    $entity->set('field_datetime', $value);
    $this->entityValidateAndSave($entity);
    // Load the entity and ensure the field was saved correctly.
    $id = $entity->id();
    $entity = EntityTest::load($id);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($entity->field_datetime[0]->value, $value, 'DateTimeItem::setValue() works with array value.');
  }

  /**
   * Tests setting the value of the DateTimeItem directly.
   */
  public function testSetValueProperty() {
<<<<<<< HEAD
    // Test Date::setValue().
    $entity = EntityTest::create();
    $value = '2014-01-01T20:00:00Z';

    $entity->set('field_datetime', $value);
    $entity->save();
    // Load the entity and ensure the field was saved correctly.
    $id = $entity->id();
    $entity = entity_load('entity_test', $id);
=======
    // Test Date::setValue() with a date+time field.
    // Test a date+time field.
    $this->fieldStorage->setSetting('datetime_type', DateTimeItem::DATETIME_TYPE_DATETIME);
    $this->fieldStorage->save();
    $entity = EntityTest::create();
    $value = '2014-01-01T20:00:00';

    $entity->set('field_datetime', $value);
    $this->entityValidateAndSave($entity);
    // Load the entity and ensure the field was saved correctly.
    $id = $entity->id();
    $entity = EntityTest::load($id);
    $this->assertEqual($entity->field_datetime[0]->value, $value, '"Value" property can be set directly.');

    // Test Date::setValue() with a date-only field.
    // Test a date+time field.
    $this->fieldStorage->setSetting('datetime_type', DateTimeItem::DATETIME_TYPE_DATE);
    $this->fieldStorage->save();
    $entity = EntityTest::create();
    $value = '2014-01-01';

    $entity->set('field_datetime', $value);
    $this->entityValidateAndSave($entity);
    // Load the entity and ensure the field was saved correctly.
    $id = $entity->id();
    $entity = EntityTest::load($id);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($entity->field_datetime[0]->value, $value, '"Value" property can be set directly.');
  }

}
