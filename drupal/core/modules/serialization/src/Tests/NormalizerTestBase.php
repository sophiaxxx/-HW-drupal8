<?php

namespace Drupal\serialization\Tests;

use Drupal\Tests\serialization\Kernel\NormalizerTestBase as SerializationNormalizerTestBase;

<<<<<<< HEAD
  protected function setUp() {
    parent::setUp();

    $this->installEntitySchema('entity_test_mulrev');
    $this->installEntitySchema('user');
    $this->installConfig(array('field'));
    \Drupal::service('router.builder')->rebuild();
    \Drupal::moduleHandler()->invoke('rest', 'install');

    // Auto-create a field for testing.
    FieldStorageConfig::create(array(
      'entity_type' => 'entity_test_mulrev',
      'field_name' => 'field_test_text',
      'type' => 'text',
      'cardinality' => 1,
      'translatable' => FALSE,
    ))->save();
    FieldConfig::create(array(
      'entity_type' => 'entity_test_mulrev',
      'field_name' => 'field_test_text',
      'bundle' => 'entity_test_mulrev',
      'label' => 'Test text-field',
      'widget' => array(
        'type' => 'text_textfield',
        'weight' => 0,
      ),
    ))->save();
  }

}
=======
/**
 * Helper base class to set up some test fields for serialization testing.
 *
 * @deprecated Scheduled for removal in Drupal 9.0.0.
 *   Use \Drupal\Tests\serialization\Kernel\NormalizerTestBase instead.
 */
abstract class NormalizerTestBase extends SerializationNormalizerTestBase { }
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
