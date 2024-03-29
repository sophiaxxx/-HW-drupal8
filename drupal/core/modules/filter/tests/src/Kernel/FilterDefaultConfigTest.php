<?php

namespace Drupal\Tests\filter\Kernel;

<<<<<<< HEAD
=======
use Drupal\filter\Entity\FilterFormat;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\KernelTests\KernelTestBase;
use Drupal\user\RoleInterface;

/**
 * Tests text format default configuration.
 *
 * @group filter
 */
class FilterDefaultConfigTest extends KernelTestBase {

<<<<<<< HEAD
  public static $modules = array('system', 'user', 'filter', 'filter_test');
=======
  public static $modules = ['system', 'user', 'filter', 'filter_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  protected function setUp() {
    parent::setUp();

    // Drupal\filter\FilterPermissions::permissions() builds a URL to output
    // a link in the description.

    $this->installEntitySchema('user');

    // Install filter_test module, which ships with custom default format.
<<<<<<< HEAD
    $this->installConfig(array('user', 'filter_test'));
=======
    $this->installConfig(['user', 'filter_test']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests installation of default formats.
   */
<<<<<<< HEAD
  function testInstallation() {
    // Verify that the format was installed correctly.
    $format = entity_load('filter_format', 'filter_test');
=======
  public function testInstallation() {
    // Verify that the format was installed correctly.
    $format = FilterFormat::load('filter_test');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertTrue((bool) $format);
    $this->assertEqual($format->id(), 'filter_test');
    $this->assertEqual($format->label(), 'Test format');
    $this->assertEqual($format->get('weight'), 2);

    // Verify that format default property values have been added/injected.
    $this->assertTrue($format->uuid());

    // Verify that the loaded format does not contain any roles.
    $this->assertEqual($format->get('roles'), NULL);
    // Verify that the defined roles in the default config have been processed.
<<<<<<< HEAD
    $this->assertEqual(array_keys(filter_get_roles_by_format($format)), array(
      RoleInterface::ANONYMOUS_ID,
      RoleInterface::AUTHENTICATED_ID,
    ));
=======
    $this->assertEqual(array_keys(filter_get_roles_by_format($format)), [
      RoleInterface::ANONYMOUS_ID,
      RoleInterface::AUTHENTICATED_ID,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Verify enabled filters.
    $filters = $format->get('filters');
    $this->assertEqual($filters['filter_html_escape']['status'], 1);
    $this->assertEqual($filters['filter_html_escape']['weight'], -10);
    $this->assertEqual($filters['filter_html_escape']['provider'], 'filter');
<<<<<<< HEAD
    $this->assertEqual($filters['filter_html_escape']['settings'], array());
    $this->assertEqual($filters['filter_autop']['status'], 1);
    $this->assertEqual($filters['filter_autop']['weight'], 0);
    $this->assertEqual($filters['filter_autop']['provider'], 'filter');
    $this->assertEqual($filters['filter_autop']['settings'], array());
    $this->assertEqual($filters['filter_url']['status'], 1);
    $this->assertEqual($filters['filter_url']['weight'], 0);
    $this->assertEqual($filters['filter_url']['provider'], 'filter');
    $this->assertEqual($filters['filter_url']['settings'], array(
      'filter_url_length' => 72,
    ));
=======
    $this->assertEqual($filters['filter_html_escape']['settings'], []);
    $this->assertEqual($filters['filter_autop']['status'], 1);
    $this->assertEqual($filters['filter_autop']['weight'], 0);
    $this->assertEqual($filters['filter_autop']['provider'], 'filter');
    $this->assertEqual($filters['filter_autop']['settings'], []);
    $this->assertEqual($filters['filter_url']['status'], 1);
    $this->assertEqual($filters['filter_url']['weight'], 0);
    $this->assertEqual($filters['filter_url']['provider'], 'filter');
    $this->assertEqual($filters['filter_url']['settings'], [
      'filter_url_length' => 72,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Tests that changes to FilterFormat::$roles do not have an effect.
   */
<<<<<<< HEAD
  function testUpdateRoles() {
    // Verify role permissions declared in default config.
    $format = entity_load('filter_format', 'filter_test');
    $this->assertEqual(array_keys(filter_get_roles_by_format($format)), array(
      RoleInterface::ANONYMOUS_ID,
      RoleInterface::AUTHENTICATED_ID,
    ));

    // Attempt to change roles.
    $format->set('roles', array(
      RoleInterface::AUTHENTICATED_ID,
    ));
    $format->save();

    // Verify that roles have not been updated.
    $format = entity_load('filter_format', 'filter_test');
    $this->assertEqual(array_keys(filter_get_roles_by_format($format)), array(
      RoleInterface::ANONYMOUS_ID,
      RoleInterface::AUTHENTICATED_ID,
    ));
=======
  public function testUpdateRoles() {
    // Verify role permissions declared in default config.
    $format = FilterFormat::load('filter_test');
    $this->assertEqual(array_keys(filter_get_roles_by_format($format)), [
      RoleInterface::ANONYMOUS_ID,
      RoleInterface::AUTHENTICATED_ID,
    ]);

    // Attempt to change roles.
    $format->set('roles', [
      RoleInterface::AUTHENTICATED_ID,
    ]);
    $format->save();

    // Verify that roles have not been updated.
    $format = FilterFormat::load('filter_test');
    $this->assertEqual(array_keys(filter_get_roles_by_format($format)), [
      RoleInterface::ANONYMOUS_ID,
      RoleInterface::AUTHENTICATED_ID,
    ]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
