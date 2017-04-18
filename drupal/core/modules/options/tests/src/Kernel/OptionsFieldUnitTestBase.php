<?php

namespace Drupal\Tests\options\Kernel;

use Drupal\field\Entity\FieldConfig;
use Drupal\Tests\field\Kernel\FieldKernelTestBase;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Base class for Options module integration tests.
 */
abstract class OptionsFieldUnitTestBase extends FieldKernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('options');
=======
  public static $modules = ['options'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The field name used in the test.
   *
   * @var string
   */
  protected $fieldName = 'test_options';

  /**
   * The field storage definition used to created the field storage.
   *
   * @var array
   */
  protected $fieldStorageDefinition;

  /**
   * The list field storage used in the test.
   *
   * @var \Drupal\field\Entity\FieldStorageConfig
   */
  protected $fieldStorage;

  /**
   * The list field used in the test.
   *
   * @var \Drupal\field\Entity\FieldConfig
   */
  protected $field;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->container->get('router.builder')->rebuild();

<<<<<<< HEAD
    $this->fieldStorageDefinition = array(
=======
    $this->fieldStorageDefinition = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      'field_name' => $this->fieldName,
      'entity_type' => 'entity_test',
      'type' => 'list_integer',
      'cardinality' => 1,
<<<<<<< HEAD
      'settings' => array(
        'allowed_values' => array(1 => 'One', 2 => 'Two', 3 => 'Three'),
      ),
    );
=======
      'settings' => [
        'allowed_values' => [1 => 'One', 2 => 'Two', 3 => 'Three'],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->fieldStorage = FieldStorageConfig::create($this->fieldStorageDefinition);
    $this->fieldStorage->save();

    $this->field = FieldConfig::create([
      'field_storage' => $this->fieldStorage,
      'bundle' => 'entity_test',
    ]);
    $this->field->save();

    entity_get_form_display('entity_test', 'entity_test', 'default')
<<<<<<< HEAD
      ->setComponent($this->fieldName, array(
        'type' => 'options_buttons',
      ))
=======
      ->setComponent($this->fieldName, [
        'type' => 'options_buttons',
      ])
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      ->save();
  }

}
