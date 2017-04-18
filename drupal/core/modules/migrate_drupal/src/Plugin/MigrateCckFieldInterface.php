<?php

namespace Drupal\migrate_drupal\Plugin;

<<<<<<< HEAD
use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\migrate\Row;
=======
@trigger_error('MigrateCckFieldInterface is deprecated in Drupal 8.3.x and will
be removed before Drupal 9.0.x. Use \Drupal\migrate_drupal\Annotation\MigrateField
instead.', E_USER_DEPRECATED);

use Drupal\migrate\Plugin\MigrationInterface;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

/**
 * Provides an interface for all CCK field type plugins.
 *
 * @deprecated in Drupal 8.3.x, to be removed before Drupal 9.0.x. Use
 *   \Drupal\migrate_drupal\Annotation\MigrateField instead.
 */
<<<<<<< HEAD
interface MigrateCckFieldInterface extends PluginInspectionInterface {

  /**
   * Apply any custom processing to the field migration.
   *
   * @param \Drupal\migrate\Plugin\MigrationInterface $migration
   *   The migration entity.
   */
  public function processField(MigrationInterface $migration);

  /**
   * Apply any custom processing to the field instance migration.
   *
   * @param \Drupal\migrate\Plugin\MigrationInterface $migration
   *   The migration entity.
   */
  public function processFieldInstance(MigrationInterface $migration);

  /**
   * Apply any custom processing to the field widget migration.
   *
   * @param \Drupal\migrate\Plugin\MigrationInterface $migration
   *   The migration entity.
   */
  public function processFieldWidget(MigrationInterface $migration);

  /**
   * Apply any custom processing to the field formatter migration.
   *
   * @param \Drupal\migrate\Plugin\MigrationInterface $migration
   *   The migration entity.
   */
  public function processFieldFormatter(MigrationInterface $migration);

  /**
   * Get a map between D6 formatters and D8 formatters for this field type.
   *
   * This is used by static::processFieldFormatter() in the base class.
   *
   * @return array
   *   The keys are D6 formatters and the values are D8 formatters.
   */
  public function getFieldFormatterMap();

  /**
   * Get a map between D6 and D8 widgets for this field type.
   *
   * @return array
   *   The keys are D6 field widget types and the values D8 widgets.
   */
  public function getFieldWidgetMap();
=======
interface MigrateCckFieldInterface extends MigrateFieldInterface {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Apply any custom processing to the cck bundle migrations.
   *
   * @param \Drupal\migrate\Plugin\MigrationInterface $migration
   *   The migration entity.
   * @param string $field_name
   *   The field name we're processing the value for.
   * @param array $data
   *   The array of field data from CckFieldValues::fieldData().
   */
  public function processCckFieldValues(MigrationInterface $migration, $field_name, $data);

}
