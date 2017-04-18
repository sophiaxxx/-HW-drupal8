<?php

namespace Drupal\migrate_drupal\Annotation;

@trigger_error('MigrateCckField is deprecated in Drupal 8.3.x and will be
removed before Drupal 9.0.x. Use \Drupal\migrate_drupal\Annotation\MigrateField
instead.', E_USER_DEPRECATED);

/**
 * Deprecated: Defines a cckfield plugin annotation object.
 *
<<<<<<< HEAD
 * cckfield plugins are variously responsible for handling the migration of
 * CCK fields from Drupal 6 to Drupal 8, and Field API fields from Drupal 7
 * to Drupal 8. They are allowed to alter CCK-related migrations when migrations
 * are being generated, and can compute destination field types for individual
 * fields during the actual migration process.
=======
 * @deprecated in Drupal 8.3.x, to be removed before Drupal 9.0.x. Use
 * \Drupal\migrate_drupal\Annotation\MigrateField instead.
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
 *
 * Plugin Namespace: Plugin\migrate\cckfield
 *
 * @Annotation
 */
<<<<<<< HEAD
class MigrateCckField extends Plugin {

  /**
   * @inheritdoc
   */
  public function __construct($values) {
    parent::__construct($values);
    // Provide default value for core property, in case it's missing.
    if (empty($this->definition['core'])) {
      $this->definition['core'] = [6];
    }
  }

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * Map of D6 and D7 field types to D8 field type plugin IDs.
   *
   * @var string[]
   */
  public $type_map = [];
=======
class MigrateCckField extends MigrateField {
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * The Drupal core version(s) this plugin applies to.
   *
   * @var int[]
   */
  public $core = [];

}
