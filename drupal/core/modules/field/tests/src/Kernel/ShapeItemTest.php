<?php

namespace Drupal\Tests\field\Kernel;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\entity_test\Entity\EntityTest;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests the new entity API for the shape field type.
 *
 * @group field
 */
class ShapeItemTest extends FieldKernelTestBase {

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
  protected $fieldName = 'field_shape';

  protected function setUp() {
    parent::setUp();

    // Create a 'shape' field and storage for validation.
<<<<<<< HEAD
    FieldStorageConfig::create(array(
      'field_name' => $this->fieldName,
      'entity_type' => 'entity_test',
      'type' => 'shape',
    ))->save();
=======
    FieldStorageConfig::create([
      'field_name' => $this->fieldName,
      'entity_type' => 'entity_test',
      'type' => 'shape',
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
  public function testShapeItem() {
    // Verify entity creation.
    $entity = EntityTest::create();
    $shape = 'cube';
    $color = 'blue';
    $entity->{$this->fieldName}->shape = $shape;
    $entity->{$this->fieldName}->color = $color;
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
    $this->assertEqual($entity->{$this->fieldName}->shape, $shape);
    $this->assertEqual($entity->{$this->fieldName}->color, $color);
    $this->assertEqual($entity->{$this->fieldName}[0]->shape, $shape);
    $this->assertEqual($entity->{$this->fieldName}[0]->color, $color);

    // Verify changing the field value.
    $new_shape = 'circle';
    $new_color = 'red';
    $entity->{$this->fieldName}->shape = $new_shape;
    $entity->{$this->fieldName}->color = $new_color;
    $this->assertEqual($entity->{$this->fieldName}->shape, $new_shape);
    $this->assertEqual($entity->{$this->fieldName}->color, $new_color);

    // Read changed entity and assert changed values.
    $entity->save();
<<<<<<< HEAD
    $entity = entity_load('entity_test', $id);
=======
    $entity = EntityTest::load($id);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($entity->{$this->fieldName}->shape, $new_shape);
    $this->assertEqual($entity->{$this->fieldName}->color, $new_color);
  }

}
