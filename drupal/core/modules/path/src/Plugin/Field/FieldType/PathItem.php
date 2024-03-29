<?php

namespace Drupal\path\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'path' entity field type.
 *
 * @FieldType(
 *   id = "path",
 *   label = @Translation("Path"),
 *   description = @Translation("An entity field containing a path alias and related data."),
 *   no_ui = TRUE,
 *   default_widget = "path",
 *   list_class = "\Drupal\path\Plugin\Field\FieldType\PathFieldItemList"
 * )
 */
class PathItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['alias'] = DataDefinition::create('string')
      ->setLabel(t('Path alias'));
    $properties['pid'] = DataDefinition::create('integer')
      ->setLabel(t('Path id'));
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function preSave() {
    $this->alias = trim($this->alias);
  }

  /**
   * {@inheritdoc}
   */
  public function postSave($update) {
    if (!$update) {
      if ($this->alias) {
        $entity = $this->getEntity();
        if ($path = \Drupal::service('path.alias_storage')->save('/' . $entity->urlInfo()->getInternalPath(), $this->alias, $this->getLangcode())) {
          $this->pid = $path['pid'];
        }
      }
    }
    else {
      // Delete old alias if user erased it.
      if ($this->pid && !$this->alias) {
        \Drupal::service('path.alias_storage')->delete(['pid' => $this->pid]);
      }
      // Only save a non-empty alias.
      elseif ($this->alias) {
        $entity = $this->getEntity();
        \Drupal::service('path.alias_storage')->save('/' . $entity->urlInfo()->getInternalPath(), $this->alias, $this->getLangcode(), $this->pid);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $random = new Random();
    $values['alias'] = str_replace(' ', '-', strtolower($random->sentences(3)));
    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public static function mainPropertyName() {
    return 'alias';
  }

  /**
   * {@inheritdoc}
   */
  public static function mainPropertyName() {
    return 'alias';
  }

}
