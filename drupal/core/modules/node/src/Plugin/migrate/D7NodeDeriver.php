<?php

namespace Drupal\node\Plugin\migrate;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Database\DatabaseExceptionWrapper;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Drupal\migrate\Exception\RequirementsException;
use Drupal\migrate\Plugin\MigrationDeriverTrait;
use Drupal\migrate_drupal\Plugin\MigrateCckFieldPluginManagerInterface;
<<<<<<< HEAD
=======
use Drupal\migrate_drupal\Plugin\MigrateFieldPluginManagerInterface;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Deriver for Drupal 7 node and node revision migrations based on node types.
 */
class D7NodeDeriver extends DeriverBase implements ContainerDeriverInterface {
  use MigrationDeriverTrait;

  /**
   * The base plugin ID this derivative is for.
   *
   * @var string
   */
  protected $basePluginId;

  /**
   * Already-instantiated cckfield plugins, keyed by ID.
   *
   * @var \Drupal\migrate_drupal\Plugin\MigrateCckFieldInterface[]
   */
  protected $cckPluginCache;

  /**
   * The CCK plugin manager.
   *
   * @var \Drupal\migrate_drupal\Plugin\MigrateCckFieldPluginManagerInterface
   */
  protected $cckPluginManager;

  /**
<<<<<<< HEAD
=======
   * Already-instantiated field plugins, keyed by ID.
   *
   * @var \Drupal\migrate_drupal\Plugin\MigrateFieldInterface[]
   */
  protected $fieldPluginCache;

  /**
   * The field plugin manager.
   *
   * @var \Drupal\migrate_drupal\Plugin\MigrateFieldPluginManagerInterface
   */
  protected $fieldPluginManager;

  /**
   * Whether or not to include translations.
   *
   * @var bool
   */
  protected $includeTranslations;

  /**
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * D7NodeDeriver constructor.
   *
   * @param string $base_plugin_id
   *   The base plugin ID for the plugin ID.
   * @param \Drupal\migrate_drupal\Plugin\MigrateCckFieldPluginManagerInterface $cck_manager
   *   The CCK plugin manager.
<<<<<<< HEAD
   */
  public function __construct($base_plugin_id, MigrateCckFieldPluginManagerInterface $cck_manager) {
    $this->basePluginId = $base_plugin_id;
    $this->cckPluginManager = $cck_manager;
=======
   * @param \Drupal\migrate_drupal\Plugin\MigrateFieldPluginManagerInterface $field_manager
   *   The field plugin manager.
   * @param bool $translations
   *   Whether or not to include translations.
   */
  public function __construct($base_plugin_id, MigrateCckFieldPluginManagerInterface $cck_manager, MigrateFieldPluginManagerInterface $field_manager, $translations) {
    $this->basePluginId = $base_plugin_id;
    $this->cckPluginManager = $cck_manager;
    $this->fieldPluginManager = $field_manager;
    $this->includeTranslations = $translations;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, $base_plugin_id) {
<<<<<<< HEAD
    return new static(
      $base_plugin_id,
      $container->get('plugin.manager.migrate.cckfield')
=======
    // Translations don't make sense unless we have content_translation.
    return new static(
      $base_plugin_id,
      $container->get('plugin.manager.migrate.cckfield'),
      $container->get('plugin.manager.migrate.field'),
      $container->get('module_handler')->moduleExists('content_translation')
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
<<<<<<< HEAD
=======
    if (in_array('translation', $base_plugin_definition['migration_tags']) && !$this->includeTranslations) {
      // Refuse to generate anything.
      return $this->derivatives;
    }

    $node_types = static::getSourcePlugin('d7_node_type');
    try {
      $node_types->checkRequirements();
    }
    catch (RequirementsException $e) {
      // If the d7_node_type requirements failed, that means we do not have a
      // Drupal source database configured - there is nothing to generate.
      return $this->derivatives;
    }

>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $fields = [];
    try {
      $source_plugin = static::getSourcePlugin('d7_field_instance');
      $source_plugin->checkRequirements();

      // Read all field instance definitions in the source database.
      foreach ($source_plugin as $row) {
        if ($row->getSourceProperty('entity_type') == 'node') {
          $fields[$row->getSourceProperty('bundle')][$row->getSourceProperty('field_name')] = $row->getSource();
        }
      }
    }
    catch (RequirementsException $e) {
      // If checkRequirements() failed then the field module did not exist and
      // we do not have any fields. Therefore, $fields will be empty and below
      // we'll create a migration just for the node properties.
    }

    try {
<<<<<<< HEAD
      foreach (static::getSourcePlugin('d7_node_type') as $row) {
=======
      foreach ($node_types as $row) {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        $node_type = $row->getSourceProperty('type');
        $values = $base_plugin_definition;

        $values['label'] = t('@label (@type)', [
          '@label' => $values['label'],
          '@type' => $row->getSourceProperty('name'),
        ]);
        $values['source']['node_type'] = $node_type;
        $values['destination']['default_bundle'] = $node_type;

<<<<<<< HEAD
=======
        // If this migration is based on the d7_node_revision migration or
        // is for translations of nodes, it should explicitly depend on the
        // corresponding d7_node variant.
        if ($base_plugin_definition['id'] == ['d7_node_revision'] || in_array('translation', $base_plugin_definition['migration_tags'])) {
          $values['migration_dependencies']['required'][] = 'd7_node:' . $node_type;
        }

>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        $migration = \Drupal::service('plugin.manager.migration')->createStubMigration($values);
        if (isset($fields[$node_type])) {
          foreach ($fields[$node_type] as $field_name => $info) {
            $field_type = $info['type'];
            try {
<<<<<<< HEAD
              $plugin_id = $this->cckPluginManager->getPluginIdFromFieldType($field_type, ['core' => 7], $migration);
              if (!isset($this->cckPluginCache[$field_type])) {
                $this->cckPluginCache[$field_type] = $this->cckPluginManager->createInstance($plugin_id, ['core' => 7], $migration);
              }
              $this->cckPluginCache[$field_type]
                ->processCckFieldValues($migration, $field_name, $info);
            }
            catch (PluginNotFoundException $ex) {
              $migration->setProcessOfProperty($field_name, $field_name);
=======
              $plugin_id = $this->fieldPluginManager->getPluginIdFromFieldType($field_type, ['core' => 7], $migration);
              if (!isset($this->fieldPluginCache[$field_type])) {
                $this->fieldPluginCache[$field_type] = $this->fieldPluginManager->createInstance($plugin_id, ['core' => 7], $migration);
              }
              $this->fieldPluginCache[$field_type]
                ->processFieldValues($migration, $field_name, $info);
            }
            catch (PluginNotFoundException $ex) {
              try {
                $plugin_id = $this->cckPluginManager->getPluginIdFromFieldType($field_type, ['core' => 7], $migration);
                if (!isset($this->cckPluginCache[$field_type])) {
                  $this->cckPluginCache[$field_type] = $this->cckPluginManager->createInstance($plugin_id, ['core' => 7], $migration);
                }
                $this->cckPluginCache[$field_type]
                  ->processCckFieldValues($migration, $field_name, $info);
              }
              catch (PluginNotFoundException $ex) {
                $migration->setProcessOfProperty($field_name, $field_name);
              }
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
            }
          }
        }
        $this->derivatives[$node_type] = $migration->getPluginDefinition();
      }
    }
    catch (DatabaseExceptionWrapper $e) {
      // Once we begin iterating the source plugin it is possible that the
      // source tables will not exist. This can happen when the
      // MigrationPluginManager gathers up the migration definitions but we do
      // not actually have a Drupal 7 source database.
    }
<<<<<<< HEAD

=======
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    return $this->derivatives;
  }

}
