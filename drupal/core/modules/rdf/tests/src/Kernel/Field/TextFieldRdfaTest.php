<?php

namespace Drupal\Tests\rdf\Kernel\Field;

use Drupal\entity_test\Entity\EntityTest;

/**
 * Tests RDFa output by text field formatters.
 *
 * @group rdf
 */
class TextFieldRdfaTest extends FieldRdfaTestBase {

  /**
   * {@inheritdoc}
   */
  protected $fieldType = 'text';

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

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('text', 'filter');
=======
  public static $modules = ['text', 'filter'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();

<<<<<<< HEAD
    $this->installConfig(array('filter'));
=======
    $this->installConfig(['filter']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

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
   * Tests all formatters.
   *
   * @todo Check for the summary mapping.
   */
  public function testAllFormatters() {
    $formatted_value = strip_tags($this->entity->{$this->fieldName}->processed);

    // Tests the default formatter.
<<<<<<< HEAD
    $this->assertFormatterRdfa(array('type' => 'text_default'), 'http://schema.org/text', array('value' => $formatted_value));
    // Tests the summary formatter.
    $this->assertFormatterRdfa(array('type' => 'text_summary_or_trimmed'), 'http://schema.org/text', array('value' => $formatted_value));
    // Tests the trimmed formatter.
    $this->assertFormatterRdfa(array('type' => 'text_trimmed'), 'http://schema.org/text', array('value' => $formatted_value));
=======
    $this->assertFormatterRdfa(['type' => 'text_default'], 'http://schema.org/text', ['value' => $formatted_value]);
    // Tests the summary formatter.
    $this->assertFormatterRdfa(['type' => 'text_summary_or_trimmed'], 'http://schema.org/text', ['value' => $formatted_value]);
    // Tests the trimmed formatter.
    $this->assertFormatterRdfa(['type' => 'text_trimmed'], 'http://schema.org/text', ['value' => $formatted_value]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
