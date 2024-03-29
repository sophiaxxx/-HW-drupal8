<?php

namespace Drupal\KernelTests\Core\Entity;

use Drupal\Core\TypedData\DataDefinition;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests validation constraints for BundleConstraintValidator.
 *
 * @group Entity
 */
class BundleConstraintValidatorTest extends KernelTestBase {

  /**
   * The typed data manager to use.
   *
   * @var \Drupal\Core\TypedData\TypedDataManager
   */
  protected $typedData;

<<<<<<< HEAD
  public static $modules = array('node', 'field', 'text', 'user');
=======
  public static $modules = ['node', 'field', 'text', 'user'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('user');
    $this->typedData = $this->container->get('typed_data_manager');
  }

  /**
   * Tests bundle constraint validation.
   */
  public function testValidation() {
    // Test with multiple values.
<<<<<<< HEAD
    $this->assertValidation(array('foo', 'bar'));
=======
    $this->assertValidation(['foo', 'bar']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Test with a single string value as well.
    $this->assertValidation('foo');
  }

  /**
   * Executes the BundleConstraintValidator test for a given bundle.
   *
   * @param string|array $bundle
   *   Bundle/bundles to use as constraint option.
   */
  protected function assertValidation($bundle) {
    // Create a typed data definition with a Bundle constraint.
    $definition = DataDefinition::create('entity_reference')
      ->addConstraint('Bundle', $bundle);

    // Test the validation.
<<<<<<< HEAD
    $node = $this->container->get('entity.manager')->getStorage('node')->create(array('type' => 'foo'));
=======
    $node = $this->container->get('entity.manager')->getStorage('node')->create(['type' => 'foo']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $typed_data = $this->typedData->create($definition, $node);
    $violations = $typed_data->validate();
    $this->assertEqual($violations->count(), 0, 'Validation passed for correct value.');

    // Test the validation when an invalid value is passed.
<<<<<<< HEAD
    $page_node = $this->container->get('entity.manager')->getStorage('node')->create(array('type' => 'baz'));
=======
    $page_node = $this->container->get('entity.manager')->getStorage('node')->create(['type' => 'baz']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $typed_data = $this->typedData->create($definition, $page_node);
    $violations = $typed_data->validate();
    $this->assertEqual($violations->count(), 1, 'Validation failed for incorrect value.');

    // Make sure the information provided by a violation is correct.
    $violation = $violations[0];
<<<<<<< HEAD
    $this->assertEqual($violation->getMessage(), t('The entity must be of bundle %bundle.', array('%bundle' => implode(', ', (array) $bundle))), 'The message for invalid value is correct.');
=======
    $this->assertEqual($violation->getMessage(), t('The entity must be of bundle %bundle.', ['%bundle' => implode(', ', (array) $bundle)]), 'The message for invalid value is correct.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($violation->getRoot(), $typed_data, 'Violation root is correct.');
    $this->assertEqual($violation->getInvalidValue(), $page_node, 'The invalid value is set correctly in the violation.');
  }

}
