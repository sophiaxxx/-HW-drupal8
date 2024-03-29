<?php

namespace Drupal\Tests\filter\Kernel;

use Drupal\filter\Entity\FilterFormat;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests creation, loading, updating, deleting of text formats and filters.
 *
 * @group filter
 */
class FilterCrudTest extends KernelTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = ['filter', 'filter_test', 'system', 'user'];

  /**
   * Tests CRUD operations for text formats and filters.
   */
<<<<<<< HEAD
  function testTextFormatCrud() {
    // Add a text format with minimum data only.
    $format = FilterFormat::create(array(
      'format' => 'empty_format',
      'name' => 'Empty format',
    ));
=======
  public function testTextFormatCrud() {
    // Add a text format with minimum data only.
    $format = FilterFormat::create([
      'format' => 'empty_format',
      'name' => 'Empty format',
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $format->save();
    $this->verifyTextFormat($format);

    // Add another text format specifying all possible properties.
<<<<<<< HEAD
    $format = FilterFormat::create(array(
      'format' => 'custom_format',
      'name' => 'Custom format',
    ));
    $format->setFilterConfig('filter_url', array(
      'status' => 1,
      'settings' => array(
        'filter_url_length' => 30,
      ),
    ));
=======
    $format = FilterFormat::create([
      'format' => 'custom_format',
      'name' => 'Custom format',
    ]);
    $format->setFilterConfig('filter_url', [
      'status' => 1,
      'settings' => [
        'filter_url_length' => 30,
      ],
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $format->save();
    $this->verifyTextFormat($format);

    // Alter some text format properties and save again.
    $format->set('name', 'Altered format');
<<<<<<< HEAD
    $format->setFilterConfig('filter_url', array(
      'status' => 0,
    ));
    $format->setFilterConfig('filter_autop', array(
      'status' => 1,
    ));
=======
    $format->setFilterConfig('filter_url', [
      'status' => 0,
    ]);
    $format->setFilterConfig('filter_autop', [
      'status' => 1,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $format->save();
    $this->verifyTextFormat($format);

    // Add a filter_test_replace  filter and save again.
<<<<<<< HEAD
    $format->setFilterConfig('filter_test_replace', array(
      'status' => 1,
    ));
=======
    $format->setFilterConfig('filter_test_replace', [
      'status' => 1,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $format->save();
    $this->verifyTextFormat($format);

    // Disable the text format.
    $format->disable()->save();

    $formats = filter_formats();
    $this->assertTrue(!isset($formats[$format->id()]), 'filter_formats: Disabled text format no longer exists.');
  }

  /**
   * Tests disabling the fallback text format.
   */
  public function testDisableFallbackFormat() {
    $this->installConfig(['filter']);
    $message = '\LogicException with message "The fallback text format \'plain_text\' cannot be disabled." was thrown.';
    try {
      FilterFormat::load('plain_text')->disable();
      $this->fail($message);
    }
    catch (\LogicException $e) {
      $this->assertIdentical($e->getMessage(), "The fallback text format 'plain_text' cannot be disabled.", $message);
    }
  }

  /**
   * Verifies that a text format is properly stored.
   */
<<<<<<< HEAD
  function verifyTextFormat($format) {
    $t_args = array('%format' => $format->label());
    $default_langcode = \Drupal::languageManager()->getDefaultLanguage()->getId();

    // Verify the loaded filter has all properties.
    $filter_format = entity_load('filter_format', $format->id());
=======
  public function verifyTextFormat($format) {
    $t_args = ['%format' => $format->label()];
    $default_langcode = \Drupal::languageManager()->getDefaultLanguage()->getId();

    // Verify the loaded filter has all properties.
    $filter_format = FilterFormat::load($format->id());
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertEqual($filter_format->id(), $format->id(), format_string('filter_format_load: Proper format id for text format %format.', $t_args));
    $this->assertEqual($filter_format->label(), $format->label(), format_string('filter_format_load: Proper title for text format %format.', $t_args));
    $this->assertEqual($filter_format->get('weight'), $format->get('weight'), format_string('filter_format_load: Proper weight for text format %format.', $t_args));
    // Check that the filter was created in site default language.
    $this->assertEqual($format->language()->getId(), $default_langcode, format_string('filter_format_load: Proper language code for text format %format.', $t_args));
  }

}
