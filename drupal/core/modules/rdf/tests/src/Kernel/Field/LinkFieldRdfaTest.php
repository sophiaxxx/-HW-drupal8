<?php

namespace Drupal\Tests\rdf\Kernel\Field;

use Drupal\entity_test\Entity\EntityTest;

/**
 * Tests the placement of RDFa in link field formatters.
 *
 * @group rdf
 */
class LinkFieldRdfaTest extends FieldRdfaTestBase {

  /**
   * {@inheritdoc}
   */
  protected $fieldType = 'link';

  /**
   * {@inheritdoc}
   */
<<<<<<< HEAD
  public static $modules = array('link', 'text');
=======
  public static $modules = ['link', 'text'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->createTestField();

    // Add the mapping.
    $mapping = rdf_get_mapping('entity_test', 'entity_test');
<<<<<<< HEAD
    $mapping->setFieldMapping($this->fieldName, array(
      'properties' => array('schema:link'),
    ))->save();
=======
    $mapping->setFieldMapping($this->fieldName, [
      'properties' => ['schema:link'],
    ])->save();
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  }

  /**
   * Tests all formatters with link to external page.
   */
  public function testAllFormattersExternal() {
    // Set up test values.
    $this->testValue = 'http://test.me/foo/bar/neque/porro/quisquam/est/qui-dolorem?foo/bar/neque/porro/quisquam/est/qui-dolorem';
<<<<<<< HEAD
    $this->entity = EntityTest::create(array());
    $this->entity->{$this->fieldName}->uri = $this->testValue;

    // Set up the expected result.
    $expected_rdf = array(
      'value' => $this->testValue,
      'type' => 'uri',
    );
=======
    $this->entity = EntityTest::create([]);
    $this->entity->{$this->fieldName}->uri = $this->testValue;

    // Set up the expected result.
    $expected_rdf = [
      'value' => $this->testValue,
      'type' => 'uri',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->runTestAllFormatters($expected_rdf, 'external');
  }

  /**
   * Tests all formatters with link to internal page.
   */
  public function testAllFormattersInternal() {
    // Set up test values.
    $this->testValue = 'admin';
<<<<<<< HEAD
    $this->entity = EntityTest::create(array());
=======
    $this->entity = EntityTest::create([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->entity->{$this->fieldName}->uri = 'internal:/admin';

    // Set up the expected result.
    // AssertFormatterRdfa looks for a full path.
<<<<<<< HEAD
    $expected_rdf = array(
      'value' => $this->uri . '/' . $this->testValue,
      'type' => 'uri',
    );
=======
    $expected_rdf = [
      'value' => $this->uri . '/' . $this->testValue,
      'type' => 'uri',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->runTestAllFormatters($expected_rdf, 'internal');
  }

  /**
   * Tests all formatters with link to frontpage.
   */
  public function testAllFormattersFront() {
    // Set up test values.
    $this->testValue = '/';
<<<<<<< HEAD
    $this->entity = EntityTest::create(array());
    $this->entity->{$this->fieldName}->uri = 'internal:/';

    // Set up the expected result.
    $expected_rdf = array(
      'value' => $this->uri . '/',
      'type' => 'uri',
    );
=======
    $this->entity = EntityTest::create([]);
    $this->entity->{$this->fieldName}->uri = 'internal:/';

    // Set up the expected result.
    $expected_rdf = [
      'value' => $this->uri . '/',
      'type' => 'uri',
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->runTestAllFormatters($expected_rdf, 'front');
  }

  /**
   * Helper function to test all link formatters.
   */
  public function runTestAllFormatters($expected_rdf, $type = NULL) {

    // Test the link formatter: trim at 80, no other settings.
<<<<<<< HEAD
    $formatter = array(
      'type' => 'link',
      'settings' => array(
=======
    $formatter = [
      'type' => 'link',
      'settings' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'trim_length' => 80,
        'url_only' => FALSE,
        'url_plain' => FALSE,
        'rel' => '',
        'target' => '',
<<<<<<< HEAD
      ),
    );
    $this->assertFormatterRdfa($formatter, 'http://schema.org/link', $expected_rdf);

    // Test the link formatter: trim at 40, nofollow, new window.
    $formatter = array(
      'type' => 'link',
      'settings' => array(
=======
      ],
    ];
    $this->assertFormatterRdfa($formatter, 'http://schema.org/link', $expected_rdf);

    // Test the link formatter: trim at 40, nofollow, new window.
    $formatter = [
      'type' => 'link',
      'settings' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'trim_length' => 40,
        'url_only' => FALSE,
        'url_plain' => FALSE,
        'rel' => 'nofollow',
        'target' => '_blank',
<<<<<<< HEAD
      ),
    );
=======
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertFormatterRdfa($formatter, 'http://schema.org/link', $expected_rdf);

    // Test the link formatter: trim at 40, URL only (not plaintext) nofollow,
    // new window.
<<<<<<< HEAD
    $formatter = array(
      'type' => 'link',
      'settings' => array(
=======
    $formatter = [
      'type' => 'link',
      'settings' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'trim_length' => 40,
        'url_only' => TRUE,
        'url_plain' => FALSE,
        'rel' => 'nofollow',
        'target' => '_blank',
<<<<<<< HEAD
      ),
    );
    $this->assertFormatterRdfa($formatter, 'http://schema.org/link', $expected_rdf);

    // Test the link_separate formatter: trim at 40, nofollow, new window.
    $formatter = array(
      'type' => 'link_separate',
      'settings' => array(
        'trim_length' => 40,
        'rel' => 'nofollow',
        'target' => '_blank',
      ),
    );
=======
      ],
    ];
    $this->assertFormatterRdfa($formatter, 'http://schema.org/link', $expected_rdf);

    // Test the link_separate formatter: trim at 40, nofollow, new window.
    $formatter = [
      'type' => 'link_separate',
      'settings' => [
        'trim_length' => 40,
        'rel' => 'nofollow',
        'target' => '_blank',
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertFormatterRdfa($formatter, 'http://schema.org/link', $expected_rdf);

    // Change the expected value here to literal. When formatted as plaintext
    // then the RDF is expecting a 'literal' not a 'uri'.
<<<<<<< HEAD
    $expected_rdf = array(
      'value' => $this->testValue,
      'type' => 'literal',
    );
    // Test the link formatter: trim at 20, url only (as plaintext.)
    $formatter = array(
      'type' => 'link',
      'settings' => array(
=======
    $expected_rdf = [
      'value' => $this->testValue,
      'type' => 'literal',
    ];
    // Test the link formatter: trim at 20, url only (as plaintext.)
    $formatter = [
      'type' => 'link',
      'settings' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'trim_length' => 20,
        'url_only' => TRUE,
        'url_plain' => TRUE,
        'rel' => '0',
        'target' => '0',
<<<<<<< HEAD
      ),
    );
    $this->assertFormatterRdfa($formatter, 'http://schema.org/link', $expected_rdf);

    // Test the link formatter: do not trim, url only (as plaintext.)
    $formatter = array(
      'type' => 'link',
      'settings' => array(
=======
      ],
    ];
    $this->assertFormatterRdfa($formatter, 'http://schema.org/link', $expected_rdf);

    // Test the link formatter: do not trim, url only (as plaintext.)
    $formatter = [
      'type' => 'link',
      'settings' => [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        'trim_length' => 0,
        'url_only' => TRUE,
        'url_plain' => TRUE,
        'rel' => '0',
        'target' => '0',
<<<<<<< HEAD
      ),
    );
=======
      ],
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertFormatterRdfa($formatter, 'http://schema.org/link', $expected_rdf);
  }

}
