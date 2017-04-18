<?php

namespace Drupal\Tests\rdf\Kernel\Field;

use Drupal\entity_test\Entity\EntityTest;

/**
 * Tests RDFa output by email field formatters.
 *
 * @group rdf
 */
class EmailFieldRdfaTest extends FieldRdfaTestBase {

  /**
   * {@inheritdoc}
   */
  protected $fieldType = 'email';

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('text');
=======
  public static $modules = ['text'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();

    $this->createTestField();

    // Add the mapping.
    $mapping = rdf_get_mapping('entity_test', 'entity_test');
<<<<<<< HEAD
    $mapping->setFieldMapping($this->fieldName, array(
      'properties' => array('schema:email'),
    ))->save();

    // Set up test values.
    $this->testValue = 'test@example.com';
    $this->entity = EntityTest::create(array());
=======
    $mapping->setFieldMapping($this->fieldName, [
      'properties' => ['schema:email'],
    ])->save();

    // Set up test values.
    $this->testValue = 'test@example.com';
    $this->entity = EntityTest::create([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->entity->{$this->fieldName}->value = $this->testValue;
  }

  /**
   * Tests all email formatters.
   */
  public function testAllFormatters() {
    // Test the plain formatter.
<<<<<<< HEAD
    $this->assertFormatterRdfa(array('type' => 'string'), 'http://schema.org/email', array('value' => $this->testValue));
    // Test the mailto formatter.
    $this->assertFormatterRdfa(array('type' => 'email_mailto'), 'http://schema.org/email', array('value' => $this->testValue));
=======
    $this->assertFormatterRdfa(['type' => 'string'], 'http://schema.org/email', ['value' => $this->testValue]);
    // Test the mailto formatter.
    $this->assertFormatterRdfa(['type' => 'email_mailto'], 'http://schema.org/email', ['value' => $this->testValue]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
