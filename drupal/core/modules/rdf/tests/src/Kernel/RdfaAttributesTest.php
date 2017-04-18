<?php

namespace Drupal\Tests\rdf\Kernel;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests RDFa attribute generation from RDF mapping.
 *
 * @group rdf
 */
class RdfaAttributesTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('rdf');
=======
  public static $modules = ['rdf'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Test attribute creation for mappings which use 'property'.
   */
<<<<<<< HEAD
  function testProperty() {
    $properties = array('dc:title');

    $mapping = array('properties' => $properties);
    $expected_attributes = array('property' => $properties);
=======
  public function testProperty() {
    $properties = ['dc:title'];

    $mapping = ['properties' => $properties];
    $expected_attributes = ['property' => $properties];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->_testAttributes($expected_attributes, $mapping);
  }

  /**
   * Test attribute creation for mappings which use 'datatype'.
   */
<<<<<<< HEAD
  function testDatatype() {
    $properties = array('foo:bar1');
    $datatype = 'foo:bar1type';

    $mapping = array(
      'datatype' => $datatype,
      'properties' => $properties,
    );
    $expected_attributes = array(
      'datatype' => $datatype,
      'property' => $properties,
    );
=======
  public function testDatatype() {
    $properties = ['foo:bar1'];
    $datatype = 'foo:bar1type';

    $mapping = [
      'datatype' => $datatype,
      'properties' => $properties,
    ];
    $expected_attributes = [
      'datatype' => $datatype,
      'property' => $properties,
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->_testAttributes($expected_attributes, $mapping);
  }

  /**
   * Test attribute creation for mappings which override human-readable content.
   */
<<<<<<< HEAD
  function testDatatypeCallback() {
    $properties = array('dc:created');
=======
  public function testDatatypeCallback() {
    $properties = ['dc:created'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $datatype = 'xsd:dateTime';

    $date = 1252750327;
    $iso_date = date('c', $date);

<<<<<<< HEAD
    $mapping = array(
      'datatype' => $datatype,
      'properties' => $properties,
      'datatype_callback' => array('callable' => 'date_iso8601'),
    );
    $expected_attributes = array(
      'datatype' => $datatype,
      'property' => $properties,
      'content' => $iso_date,
    );
=======
    $mapping = [
      'datatype' => $datatype,
      'properties' => $properties,
      'datatype_callback' => ['callable' => 'date_iso8601'],
    ];
    $expected_attributes = [
      'datatype' => $datatype,
      'property' => $properties,
      'content' => $iso_date,
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->_testAttributes($expected_attributes, $mapping, $date);
  }


  /**
   * Test attribute creation for mappings which use data converters.
   */
<<<<<<< HEAD
  function testDatatypeCallbackWithConverter() {
    $properties = array('schema:interactionCount');
=======
  public function testDatatypeCallbackWithConverter() {
    $properties = ['schema:interactionCount'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $data = "23";
    $content = "UserComments:23";

<<<<<<< HEAD
    $mapping = array(
      'properties' => $properties,
      'datatype_callback' => array(
        'callable' => 'Drupal\rdf\SchemaOrgDataConverter::interactionCount',
        'arguments' => array('interaction_type' => 'UserComments'),
      ),
    );
    $expected_attributes = array(
      'property' => $properties,
      'content' => $content,
    );
=======
    $mapping = [
      'properties' => $properties,
      'datatype_callback' => [
        'callable' => 'Drupal\rdf\SchemaOrgDataConverter::interactionCount',
        'arguments' => ['interaction_type' => 'UserComments'],
      ],
    ];
    $expected_attributes = [
      'property' => $properties,
      'content' => $content,
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->_testAttributes($expected_attributes, $mapping, $data);
  }

  /**
   * Test attribute creation for mappings which use 'rel'.
   */
<<<<<<< HEAD
  function testRel() {
    $properties = array('sioc:has_creator', 'dc:creator');

    $mapping = array(
      'properties' => $properties,
      'mapping_type' => 'rel',
    );
    $expected_attributes = array('rel' => $properties);
=======
  public function testRel() {
    $properties = ['sioc:has_creator', 'dc:creator'];

    $mapping = [
      'properties' => $properties,
      'mapping_type' => 'rel',
    ];
    $expected_attributes = ['rel' => $properties];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    $this->_testAttributes($expected_attributes, $mapping);
  }

  /**
   * Helper function to test attribute generation.
   *
   * @param array $expected_attributes
   *   The expected return of rdf_rdfa_attributes.
   * @param array $field_mapping
   *   The field mapping to merge into the RDF mapping config.
   * @param mixed $data
   *   The data to pass into the datatype callback, if specified.
   */
  protected function _testAttributes($expected_attributes, $field_mapping, $data = NULL) {
    $mapping = rdf_get_mapping('node', 'article')
      ->setFieldMapping('field_test', $field_mapping)
      ->getPreparedFieldMapping('field_test');
    $attributes = rdf_rdfa_attributes($mapping, $data);
    ksort($expected_attributes);
    ksort($attributes);
    $this->assertEqual($expected_attributes, $attributes);
  }

}
