<?php

namespace Drupal\Tests\rdf\Kernel\Field;

use Drupal\entity_test\Entity\EntityTest;

/**
 * Tests RDFa output by text field formatters.
 *
 * @group rdf
 */
class StringFieldRdfaTest extends FieldRdfaTestBase {

  /**
   * {@inheritdoc}
   */
  protected $fieldType = 'string';

  /**
   * The 'value' property value for testing.
   *
   * @var string
   */
  protected $testValue = 'test_text_value';

  /**
   * The 'summary' property value for testing.
   *
   * @var string
   */
  protected $testSummary = 'test_summary_value';

  protected function setUp() {
    parent::setUp();

    $this->createTestField();

    // Add the mapping.
    $mapping = rdf_get_mapping('entity_test', 'entity_test');
<<<<<<< HEAD
    $mapping->setFieldMapping($this->fieldName, array(
      'properties' => array('schema:text'),
    ))->save();
=======
    $mapping->setFieldMapping($this->fieldName, [
      'properties' => ['schema:text'],
    ])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Set up test entity.
    $this->entity = EntityTest::create();
    $this->entity->{$this->fieldName}->value = $this->testValue;
    $this->entity->{$this->fieldName}->summary = $this->testSummary;
  }

  /**
   * Tests string formatters.
   */
  public function testStringFormatters() {
    // Tests the string formatter.
<<<<<<< HEAD
    $this->assertFormatterRdfa(array('type' => 'string'), 'http://schema.org/text', array('value' => $this->testValue));
=======
    $this->assertFormatterRdfa(['type' => 'string'], 'http://schema.org/text', ['value' => $this->testValue]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
