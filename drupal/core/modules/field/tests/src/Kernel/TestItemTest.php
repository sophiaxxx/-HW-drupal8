<?php

namespace Drupal\Tests\field\Kernel;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\entity_test\Entity\EntityTest;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests the new entity API for the test field type.
 *
 * @group field
 */
class TestItemTest extends FieldKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('field_test');
=======
  public static $modules = ['field_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The name of the field to use in this test.
   *
   * @var string
   */
  protected $fieldName = 'field_test';

  protected function setUp() {
    parent::setUp();

    // Create a 'test_field' field and storage for validation.
<<<<<<< HEAD
    FieldStorageConfig::create(array(
      'field_name' => $this->fieldName,
      'entity_type' => 'entity_test',
      'type' => 'test_field',
    ))->save();
=======
    FieldStorageConfig::create([
      'field_name' => $this->fieldName,
      'entity_type' => 'entity_test',
      'type' => 'test_field',
    ])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    FieldConfig::create([
      'entity_type' => 'entity_test',
      'field_name' => $this->fieldName,
      'bundle' => 'entity_test',
    ])->save();
  }

  /**
   * Tests using entity fields of the field field type.
   */
  public function testTestItem() {
    // Verify entity creation.
    $entity = EntityTest::create();
    $value = rand(1, 10);
    $entity->field_test = $value;
    $entity->name->value = $this->randomMachineName();
    $entity->save();

    // Verify entity has been created properly.
    $id = $entity->id();
<<<<<<< HEAD
    $entity = entity_load('entity_test', $id);
=======
    $entity = EntityTest::load($id);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue($entity->{$this->fieldName} instanceof FieldItemListInterface, 'Field implements interface.');
    $this->assertTrue($entity->{$this->fieldName}[0] instanceof FieldItemInterface, 'Field item implements interface.');
    $this->assertEqual($entity->{$this->fieldName}->value, $value);
    $this->assertEqual($entity->{$this->fieldName}[0]->value, $value);

    // Verify changing the field value.
    $new_value = rand(1, 10);
    $entity->field_test->value = $new_value;
    $this->assertEqual($entity->{$this->fieldName}->value, $new_value);

    // Read changed entity and assert changed values.
    $entity->save();
<<<<<<< HEAD
    $entity = entity_load('entity_test', $id);
    $this->assertEqual($entity->{$this->fieldName}->value, $new_value);

    // Test the schema for this field type.
    $expected_schema = array(
      'columns' => array(
        'value' => array(
          'type' => 'int',
          'size' => 'medium',
        ),
      ),
      'unique keys' => array(),
      'indexes' => array(
        'value' => array('value'),
      ),
      'foreign keys' => array(),
    );
=======
    $entity = EntityTest::load($id);
    $this->assertEqual($entity->{$this->fieldName}->value, $new_value);

    // Test the schema for this field type.
    $expected_schema = [
      'columns' => [
        'value' => [
          'type' => 'int',
          'size' => 'medium',
        ],
      ],
      'unique keys' => [],
      'indexes' => [
        'value' => ['value'],
      ],
      'foreign keys' => [],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $field_schema = BaseFieldDefinition::create('test_field')->getSchema();
    $this->assertEqual($field_schema, $expected_schema);
  }

}
