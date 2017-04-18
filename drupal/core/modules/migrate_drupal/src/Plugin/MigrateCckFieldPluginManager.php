<?php

namespace Drupal\migrate_drupal\Plugin;

<<<<<<< HEAD
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\migrate\Plugin\MigratePluginManager;
use Drupal\migrate\Plugin\MigrationInterface;

/**
 * Plugin manager for migrate cckfield plugins.
 *
 * @see \Drupal\migrate_drupal\Plugin\MigrateCckFieldInterface
 * @see \Drupal\migrate\Annotation\MigrateCckField
 * @see plugin_api
 *
 * @ingroup migration
 */
class MigrateCckFieldPluginManager extends MigratePluginManager implements MigrateCckFieldPluginManagerInterface {

  /**
   * The default version of core to use for cck field plugins.
   *
   * These plugins were initially only built and used for Drupal 6 fields.
   * Having been extended for Drupal 7 with a "core" annotation, we fall back to
   * Drupal 6 where none exists.
   */
  const DEFAULT_CORE_VERSION = 6;

  /**
   * {@inheritdoc}
   */
  public function getPluginIdFromFieldType($field_type, array $configuration = [], MigrationInterface $migration = NULL) {
    $core = static::DEFAULT_CORE_VERSION;
    if (!empty($configuration['core'])) {
      $core = $configuration['core'];
    }
    elseif (!empty($migration->getPluginDefinition()['migration_tags'])) {
      foreach ($migration->getPluginDefinition()['migration_tags'] as $tag) {
        if ($tag == 'Drupal 7') {
          $core = 7;
        }
      }
    }

    foreach ($this->getDefinitions() as $plugin_id => $definition) {
      if (in_array($core, $definition['core'])) {
        if (array_key_exists($field_type, $definition['type_map']) || $field_type === $plugin_id) {
          return $plugin_id;
        }
      }
    }
    throw new PluginNotFoundException($field_type);
  }

}
=======
@trigger_error('MigrateCckFieldPluginManager is deprecated in Drupal 8.3.x and will
be removed before Drupal 9.0.x. Use \Drupal\migrate_drupal\Annotation\MigrateFieldPluginManager
instead.', E_USER_DEPRECATED);

/**
 * Deprecated: Plugin manager for migrate field plugins.
 *
 * @deprecated in Drupal 8.3.x, to be removed before Drupal 9.0.x. Use
 *   \Drupal\migrate_drupal\Plugin\MigrateFieldPluginManager instead.
 *
 * @ingroup migration
 */
class MigrateCckFieldPluginManager extends MigrateFieldPluginManager implements MigrateCckFieldPluginManagerInterface { }
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
