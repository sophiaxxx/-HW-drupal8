<?php

namespace Drupal\Tests\hal\Kernel;

use Drupal\Core\Url;
use Drupal\field\Entity\FieldConfig;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

/**
<<<<<<< HEAD
 * Tests that entities can be denormalized from HAL.
=======
 * Tests HAL denormalization edge cases for EntityResource.
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
 *
 * @group hal
 */
class DenormalizeTest extends NormalizerTestBase {

  /**
   * Tests that the type link relation in incoming data is handled correctly.
   */
  public function testTypeHandling() {
    // Valid type.
<<<<<<< HEAD
    $data_with_valid_type = array(
      '_links' => array(
        'type' => array(
          'href' => Url::fromUri('base:rest/type/entity_test/entity_test', array('absolute' => TRUE))->toString(),
        ),
      ),
    );
=======
    $data_with_valid_type = [
      '_links' => [
        'type' => [
          'href' => Url::fromUri('base:rest/type/entity_test/entity_test', ['absolute' => TRUE])->toString(),
        ],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $denormalized = $this->serializer->denormalize($data_with_valid_type, $this->entityClass, $this->format);
    $this->assertEqual(get_class($denormalized), $this->entityClass, 'Request with valid type results in creation of correct bundle.');

    // Multiple types.
<<<<<<< HEAD
    $data_with_multiple_types = array(
      '_links' => array(
        'type' => array(
          array(
            'href' => Url::fromUri('base:rest/types/foo', array('absolute' => TRUE))->toString(),
          ),
          array(
            'href' => Url::fromUri('base:rest/type/entity_test/entity_test', array('absolute' => TRUE))->toString(),
          ),
        ),
      ),
    );
=======
    $data_with_multiple_types = [
      '_links' => [
        'type' => [
          [
            'href' => Url::fromUri('base:rest/types/foo', ['absolute' => TRUE])->toString(),
          ],
          [
            'href' => Url::fromUri('base:rest/type/entity_test/entity_test', ['absolute' => TRUE])->toString(),
          ],
        ],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $denormalized = $this->serializer->denormalize($data_with_multiple_types, $this->entityClass, $this->format);
    $this->assertEqual(get_class($denormalized), $this->entityClass, 'Request with multiple types results in creation of correct bundle.');

    // Invalid type.
<<<<<<< HEAD
    $data_with_invalid_type = array(
      '_links' => array(
        'type' => array(
          'href' => Url::fromUri('base:rest/types/foo', array('absolute' => TRUE))->toString(),
        ),
      ),
    );
=======
    $data_with_invalid_type = [
      '_links' => [
        'type' => [
          'href' => Url::fromUri('base:rest/types/foo', ['absolute' => TRUE])->toString(),
        ],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    try {
      $this->serializer->denormalize($data_with_invalid_type, $this->entityClass, $this->format);
      $this->fail('Exception should be thrown when type is invalid.');
    }
    catch (UnexpectedValueException $e) {
      $this->pass('Exception thrown when type is invalid.');
    }

    // No type.
<<<<<<< HEAD
    $data_with_no_type = array(
      '_links' => array(
      ),
    );
=======
    $data_with_no_type = [
      '_links' => [
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    try {
      $this->serializer->denormalize($data_with_no_type, $this->entityClass, $this->format);
      $this->fail('Exception should be thrown when no type is provided.');
    }
    catch (UnexpectedValueException $e) {
      $this->pass('Exception thrown when no type is provided.');
    }
  }

  /**
<<<<<<< HEAD
=======
   * Tests link relation handling with an invalid type.
   */
  public function testTypeHandlingWithInvalidType() {
    $data_with_invalid_type = [
      '_links' => [
        'type' => [
          'href' => Url::fromUri('base:rest/type/entity_test/entity_test_invalid', ['absolute' => TRUE])->toString(),
        ],
      ],
    ];

    $this->setExpectedException(UnexpectedValueException::class);
    $this->serializer->denormalize($data_with_invalid_type, $this->entityClass, $this->format);
  }

  /**
   * Tests link relation handling with no types.
   */
  public function testTypeHandlingWithNoTypes() {
    $data_with_no_types = [
      '_links' => [
        'type' => [],
      ],
    ];

    $this->setExpectedException(UnexpectedValueException::class);
    $this->serializer->denormalize($data_with_no_types, $this->entityClass, $this->format);
  }

  /**
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * Test that a field set to an empty array is different than an absent field.
   */
  public function testMarkFieldForDeletion() {
    // Add a default value for a field.
    $field = FieldConfig::loadByName('entity_test', 'entity_test', 'field_test_text');
<<<<<<< HEAD
    $field->setDefaultValue(array(array('value' => 'Llama')));
=======
    $field->setDefaultValue([['value' => 'Llama']]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $field->save();

    // Denormalize data that contains no entry for the field, and check that
    // the default value is present in the resulting entity.
<<<<<<< HEAD
    $data = array(
      '_links' => array(
        'type' => array(
          'href' => Url::fromUri('base:rest/type/entity_test/entity_test', array('absolute' => TRUE))->toString(),
        ),
      ),
    );
=======
    $data = [
      '_links' => [
        'type' => [
          'href' => Url::fromUri('base:rest/type/entity_test/entity_test', ['absolute' => TRUE])->toString(),
        ],
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity = $this->serializer->denormalize($data, $this->entityClass, $this->format);
    $this->assertEqual($entity->field_test_text->count(), 1);
    $this->assertEqual($entity->field_test_text->value, 'Llama');

    // Denormalize data that contains an empty entry for the field, and check
    // that the field is empty in the resulting entity.
<<<<<<< HEAD
    $data = array(
      '_links' => array(
        'type' => array(
          'href' => Url::fromUri('base:rest/type/entity_test/entity_test', array('absolute' => TRUE))->toString(),
        ),
      ),
      'field_test_text' => array(),
    );
=======
    $data = [
      '_links' => [
        'type' => [
          'href' => Url::fromUri('base:rest/type/entity_test/entity_test', ['absolute' => TRUE])->toString(),
        ],
      ],
      'field_test_text' => [],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $entity = $this->serializer->denormalize($data, get_class($entity), $this->format, [ 'target_instance' => $entity ]);
    $this->assertEqual($entity->field_test_text->count(), 0);
  }

<<<<<<< HEAD
  /**
   * Test that non-reference fields can be denormalized.
   */
  public function testBasicFieldDenormalization() {
    $data = array(
      '_links' => array(
        'type' => array(
          'href' => Url::fromUri('base:rest/type/entity_test/entity_test', array('absolute' => TRUE))->toString(),
        ),
      ),
      'uuid' => array(
        array(
          'value' => 'e5c9fb96-3acf-4a8d-9417-23de1b6c3311',
        ),
      ),
      'field_test_text' => array(
        array(
          'value' => $this->randomMachineName(),
          'format' => 'full_html',
        ),
      ),
      'field_test_translatable_text' => array(
        array(
          'value' => $this->randomMachineName(),
          'format' => 'full_html',
        ),
        array(
          'value' => $this->randomMachineName(),
          'format' => 'filtered_html',
        ),
        array(
          'value' => $this->randomMachineName(),
          'format' => 'filtered_html',
          'lang' => 'de',
        ),
        array(
          'value' => $this->randomMachineName(),
          'format' => 'full_html',
          'lang' => 'de',
        ),
      ),
    );

    $expected_value_default = array(
      array (
        'value' => $data['field_test_translatable_text'][0]['value'],
        'format' => 'full_html',
      ),
      array (
        'value' => $data['field_test_translatable_text'][1]['value'],
        'format' => 'filtered_html',
      ),
    );
    $expected_value_de = array(
      array (
        'value' => $data['field_test_translatable_text'][2]['value'],
        'format' => 'filtered_html',
      ),
      array (
        'value' => $data['field_test_translatable_text'][3]['value'],
        'format' => 'full_html',
      ),
    );
    $denormalized = $this->serializer->denormalize($data, $this->entityClass, $this->format);
    $this->assertEqual($data['uuid'], $denormalized->get('uuid')->getValue(), 'A preset value (e.g. UUID) is overridden by incoming data.');
    $this->assertEqual($data['field_test_text'], $denormalized->get('field_test_text')->getValue(), 'A basic text field is denormalized.');
    $this->assertEqual($expected_value_default, $denormalized->get('field_test_translatable_text')->getValue(), 'Values in the default language are properly handled for a translatable field.');
    $this->assertEqual($expected_value_de, $denormalized->getTranslation('de')->get('field_test_translatable_text')->getValue(), 'Values in a translation language are properly handled for a translatable field.');
  }

  /**
   * Verifies that the denormalized entity is correct in the PATCH context.
   */
  public function testPatchDenormalization() {
    $data = array(
      '_links' => array(
        'type' => array(
          'href' => Url::fromUri('base:rest/type/entity_test/entity_test', array('absolute' => TRUE))->toString(),
        ),
      ),
      'field_test_text' => array(
        array(
          'value' => $this->randomMachineName(),
          'format' => 'full_html',
        ),
      ),
    );
    $denormalized = $this->serializer->denormalize($data, $this->entityClass, $this->format, array('request_method' => 'patch'));
    // Check that the one field got populated as expected.
    $this->assertEqual($data['field_test_text'], $denormalized->get('field_test_text')->getValue());
    // Check the custom property that contains the list of fields to merge.
    $this->assertEqual($denormalized->_restSubmittedFields, ['field_test_text']);
  }

=======
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
}
