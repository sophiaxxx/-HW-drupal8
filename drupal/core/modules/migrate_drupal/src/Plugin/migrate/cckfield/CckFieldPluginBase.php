<?php

namespace Drupal\migrate_drupal\Plugin\migrate\cckfield;

<<<<<<< HEAD
use Drupal\Core\Plugin\PluginBase;
use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\migrate\Row;
use Drupal\migrate_drupal\Plugin\MigrateCckFieldInterface;
=======
@trigger_error('CckFieldPluginBase is deprecated in Drupal 8.3.x and will be
be removed before Drupal 9.0.x. Use \Drupal\migrate_drupal\Plugin\migrate\field\FieldPluginBase
instead.', E_USER_DEPRECATED);

use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\migrate_drupal\Plugin\migrate\field\FieldPluginBase;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

/**
 * The base class for all field plugins.
 *
<<<<<<< HEAD
 * @see \Drupal\migrate\Plugin\MigratePluginManager
 * @see \Drupal\migrate_drupal\Annotation\MigrateCckField
 * @see \Drupal\migrate_drupal\Plugin\MigrateCckFieldInterface
 * @see plugin_api
 *
 * @ingroup migration
 */
abstract class CckFieldPluginBase extends PluginBase implements MigrateCckFieldInterface {

  /**
   * {@inheritdoc}
   */
  public function processField(MigrationInterface $migration) {
    $process[0]['map'][$this->pluginId][$this->pluginId] = $this->pluginId;
    $migration->mergeProcessOfProperty('type', $process);
  }

  /**
   * {@inheritdoc}
   */
  public function processFieldInstance(MigrationInterface $migration) {
    // Nothing to do by default with field instances.
  }

  /**
   * {@inheritdoc}
   */
  public function processFieldWidget(MigrationInterface $migration) {
    $process = [];
    foreach ($this->getFieldWidgetMap() as $source_widget => $destination_widget) {
      $process['type']['map'][$source_widget] = $destination_widget;
    }
    $migration->mergeProcessOfProperty('options/type', $process);
  }
=======
 * @deprecated in Drupal 8.3.x, to be removed before Drupal 9.0.x. Use
 * \Drupal\migrate_drupal\Plugin\migrate\field\FieldPluginBase instead.
 *
 * @ingroup migration
 */
abstract class CckFieldPluginBase extends FieldPluginBase {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Apply any custom processing to the field bundle migrations.
   *
   * @param \Drupal\migrate\Plugin\MigrationInterface $migration
   *   The migration entity.
   * @param string $field_name
   *   The field name we're processing the value for.
   * @param array $data
   *   The array of field data from FieldValues::fieldData().
   */
  public function processFieldValues(MigrationInterface $migration, $field_name, $data) {
    // Provide a bridge to the old method declared on the interface and now an
    // abstract method in this class.
    return $this->processCckFieldValues($migration, $field_name, $data);
  }

  /**
   * Apply any custom processing to the field bundle migrations.
   *
   * @param \Drupal\migrate\Plugin\MigrationInterface $migration
   *   The migration entity.
   * @param string $field_name
   *   The field name we're processing the value for.
   * @param array $data
   *   The array of field data from FieldValues::fieldData().
   */
  abstract public function processCckFieldValues(MigrationInterface $migration, $field_name, $data);

}
