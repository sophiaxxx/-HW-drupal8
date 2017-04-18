<?php

namespace Drupal\Tests\rdf\Kernel\Field;

use Drupal\entity_test\Entity\EntityTest;

/**
 * Tests RDFa output by telephone field formatters.
 *
 * @group rdf
 */
class TelephoneFieldRdfaTest extends FieldRdfaTestBase {

  /**
   * A test value for the telephone field.
   *
   * @var string
   */
  protected $testValue;

  /**
   * {@inheritdoc}
   */
  protected $fieldType = 'telephone';

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('telephone', 'text');
=======
  public static $modules = ['telephone', 'text'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();

    $this->createTestField();

    // Add the mapping.
    $mapping = rdf_get_mapping('entity_test', 'entity_test');
<<<<<<< HEAD
    $mapping->setFieldMapping($this->fieldName, array(
      'properties' => array('schema:telephone'),
    ))->save();

    // Set up test values.
    $this->testValue = '555-555-5555';
    $this->entity = EntityTest::create(array());
=======
    $mapping->setFieldMapping($this->fieldName, [
      'properties' => ['schema:telephone'],
    ])->save();

    // Set up test values.
    $this->testValue = '555-555-5555';
    $this->entity = EntityTest::create([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->entity->{$this->fieldName}->value = $this->testValue;
  }

  /**
   * Tests the field formatters.
   */
  public function testAllFormatters() {
    // Tests the plain formatter.
<<<<<<< HEAD
    $this->assertFormatterRdfa(array('type' => 'string'), 'http://schema.org/telephone', array('value' => $this->testValue));
    // Tests the telephone link formatter.
    $this->assertFormatterRdfa(array('type' => 'telephone_link'), 'http://schema.org/telephone', array('value' => 'tel:' . $this->testValue, 'type' => 'uri'));

    $formatter = array(
      'type' => 'telephone_link',
      'settings' => array('title' => 'Contact us'),
    );
    $expected_rdf_value = array(
      'value' => 'tel:' . $this->testValue,
      'type' => 'uri',
    );
=======
    $this->assertFormatterRdfa(['type' => 'string'], 'http://schema.org/telephone', ['value' => $this->testValue]);
    // Tests the telephone link formatter.
    $this->assertFormatterRdfa(['type' => 'telephone_link'], 'http://schema.org/telephone', ['value' => 'tel:' . $this->testValue, 'type' => 'uri']);

    $formatter = [
      'type' => 'telephone_link',
      'settings' => ['title' => 'Contact us'],
    ];
    $expected_rdf_value = [
      'value' => 'tel:' . $this->testValue,
      'type' => 'uri',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    // Tests the telephone link formatter with custom title.
    $this->assertFormatterRdfa($formatter, 'http://schema.org/telephone', $expected_rdf_value);
  }

}
