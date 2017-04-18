<?php

namespace Drupal\migrate_drupal\Plugin;

<<<<<<< HEAD
use Drupal\migrate\Plugin\MigratePluginManagerInterface;
use Drupal\migrate\Plugin\MigrationInterface;

interface MigrateCckFieldPluginManagerInterface extends MigratePluginManagerInterface {

  /**
   * Get the plugin ID from the field type.
   *
   * @param string $field_type
   *   The field type being migrated.
   * @param array $configuration
   *   (optional) An array of configuration relevant to the plugin instance.
   * @param \Drupal\migrate\Plugin\MigrationInterface|null $migration
   *   (optional) The current migration instance.
   *
   * @return string
   *   The ID of the plugin for the field_type if available.
   *
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   *   If the plugin cannot be determined, such as if the field type is invalid.
   */
  public function getPluginIdFromFieldType($field_type, array $configuration = [], MigrationInterface $migration = NULL);

}
=======
@trigger_error('MigrateCckFieldPluginManagerInterface is deprecated in Drupal 8.3.x
and will be removed before Drupal 9.0.x. Use \Drupal\migrate_drupal\Annotation\MigrateFieldPluginManagerInterface
instead.', E_USER_DEPRECATED);

/**
 * Provides an interface for cck field plugin manager.
 *
 * @deprecated in Drupal 8.3.x, to be removed before Drupal 9.0.x. Use
 *   \Drupal\migrate_drupal\Plugin\MigrateFieldPluginManagerInterface instead.
 */
interface MigrateCckFieldPluginManagerInterface extends MigrateFieldPluginManagerInterface { }
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
