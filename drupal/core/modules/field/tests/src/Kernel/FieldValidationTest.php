<?php

namespace Drupal\Tests\field\Kernel;

/**
 * Tests field validation.
 *
 * @group field
 */
class FieldValidationTest extends FieldKernelTestBase {

  /**
   * @var string
   */
  private $entityType;

  /**
   * @var string
   */
  private $bundle;

  /**
   * @var \Drupal\Core\Entity\EntityInterface
   */
  private $entity;

  protected function setUp() {
    parent::setUp();

    // Create a field and storage of type 'test_field', on the 'entity_test'
    // entity type.
    $this->entityType = 'entity_test';
    $this->bundle = 'entity_test';
    $this->createFieldWithStorage('', $this->entityType, $this->bundle);

    // Create an 'entity_test' entity.
<<<<<<< HEAD
    $this->entity = entity_create($this->entityType, array(
      'type' => $this->bundle,
    ));
=======
    $this->entity = entity_create($this->entityType, [
      'type' => $this->bundle,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests that the number of values is validated against the field cardinality.
   */
<<<<<<< HEAD
  function testCardinalityConstraint() {
=======
  public function testCardinalityConstraint() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $cardinality = $this->fieldTestData->field_storage->getCardinality();
    $entity = $this->entity;

    for ($delta = 0; $delta < $cardinality + 1; $delta++) {
<<<<<<< HEAD
      $entity->{$this->fieldTestData->field_name}[] = array('value' => 1);
=======
      $entity->{$this->fieldTestData->field_name}[] = ['value' => 1];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    // Validate the field.
    $violations = $entity->{$this->fieldTestData->field_name}->validate();

    // Check that the expected constraint violations are reported.
    $this->assertEqual(count($violations), 1);
    $this->assertEqual($violations[0]->getPropertyPath(), '');
<<<<<<< HEAD
    $this->assertEqual($violations[0]->getMessage(), t('%name: this field cannot hold more than @count values.', array('%name' => $this->fieldTestData->field->getLabel(), '@count' => $cardinality)));
=======
    $this->assertEqual($violations[0]->getMessage(), t('%name: this field cannot hold more than @count values.', ['%name' => $this->fieldTestData->field->getLabel(), '@count' => $cardinality]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests that constraints defined by the field type are validated.
   */
<<<<<<< HEAD
  function testFieldConstraints() {
=======
  public function testFieldConstraints() {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $cardinality = $this->fieldTestData->field_storage->getCardinality();
    $entity = $this->entity;

    // The test is only valid if the field cardinality is greater than 2.
    $this->assertTrue($cardinality >= 2);

    // Set up values for the field.
<<<<<<< HEAD
    $expected_violations = array();
=======
    $expected_violations = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    for ($delta = 0; $delta < $cardinality; $delta++) {
      // All deltas except '1' have incorrect values.
      if ($delta == 1) {
        $value = 1;
      }
      else {
        $value = -1;
<<<<<<< HEAD
        $expected_violations[$delta . '.value'][] = t('%name does not accept the value -1.', array('%name' => $this->fieldTestData->field->getLabel()));
=======
        $expected_violations[$delta . '.value'][] = t('%name does not accept the value -1.', ['%name' => $this->fieldTestData->field->getLabel()]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      }
      $entity->{$this->fieldTestData->field_name}[] = $value;
    }

    // Validate the field.
    $violations = $entity->{$this->fieldTestData->field_name}->validate();

    // Check that the expected constraint violations are reported.
<<<<<<< HEAD
    $violations_by_path = array();
=======
    $violations_by_path = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    foreach ($violations as $violation) {
      $violations_by_path[$violation->getPropertyPath()][] = $violation->getMessage();
    }
    $this->assertEqual($violations_by_path, $expected_violations);
  }

}
