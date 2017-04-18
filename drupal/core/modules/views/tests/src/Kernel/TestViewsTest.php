<?php

namespace Drupal\Tests\views\Kernel;

<<<<<<< HEAD
use Drupal\config\Tests\SchemaCheckTestTrait;
=======
use Drupal\Tests\SchemaCheckTestTrait;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\config_test\TestInstallStorage;
use Drupal\Core\Config\InstallStorage;
use Drupal\Core\Config\TypedConfigManager;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests that test views provided by all modules match schema.
 *
 * @group config
 */
class TestViewsTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * Modules to enable.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('views_test_data');
=======
  public static $modules = ['views_test_data'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests default configuration data type.
   */
  public function testDefaultConfig() {
    // Create a typed config manager with access to configuration schema in
    // every module, profile and theme.
    $typed_config = new TypedConfigManager(
      \Drupal::service('config.storage'),
      new TestInstallStorage(InstallStorage::CONFIG_SCHEMA_DIRECTORY),
      \Drupal::service('cache.discovery'),
<<<<<<< HEAD
      \Drupal::service('module_handler')
=======
      \Drupal::service('module_handler'),
      \Drupal::service('class_resolver')
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    );

    // Create a configuration storage with access to default configuration in
    // every module, profile and theme.
    $default_config_storage = new TestInstallStorage('test_views');

    foreach ($default_config_storage->listAll() as $config_name) {
      // Skip files provided by the config_schema_test module since that module
      // is explicitly for testing schema.
      if (strpos($config_name, 'config_schema_test') === 0) {
        continue;
      }

      $data = $default_config_storage->read($config_name);
      $this->assertConfigSchema($typed_config, $config_name, $data);
    }
  }

}
