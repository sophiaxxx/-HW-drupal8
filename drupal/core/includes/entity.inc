<?php

/**
 * @file
 * Entity API for handling entities like nodes or users.
 */

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\Entity\EntityFormDisplay;
use Drupal\Core\Entity\Entity\EntityViewDisplay;

/**
 * Clears the entity render cache for all entity types.
 */
function entity_render_cache_clear() {
  $entity_manager = Drupal::entityManager();
  foreach ($entity_manager->getDefinitions() as $entity_type => $info) {
    if ($entity_manager->hasHandler($entity_type, 'view_builder')) {
      $entity_manager->getViewBuilder($entity_type)->resetCache();
    }
  }
}

/**
 * Returns the entity bundle info.
 *
 * @param string|null $entity_type
 *   The entity type whose bundle info should be returned, or NULL for all
 *   bundles info. Defaults to NULL.
 *
 * @return array
 *   The bundle info for a specific entity type, or all entity types.
 *
 * @deprecated in Drupal 8.x-dev and will be removed before Drupal 9.0.0. Use
 *   \Drupal\Core\Entity\EntityTypeBundleInfoInterface::getBundleInfo() for a
 *   single bundle, or
 *   \Drupal\Core\Entity\EntityTypeBundleInfoInterface::getAllBundleInfo() for
 *   all bundles.
 *
 * @see \Drupal\Core\Entity\EntityTypeBundleInfoInterface::getBundleInfo()
 * @see \Drupal\Core\Entity\EntityTypeBundleInfoInterface::getAllBundleInfo()
 */
function entity_get_bundles($entity_type = NULL) {
  if (isset($entity_type)) {
    return \Drupal::entityManager()->getBundleInfo($entity_type);
  }
  else {
    return \Drupal::entityManager()->getAllBundleInfo();
  }
}

/**
 * Loads an entity from the database.
 *
 * @param string $entity_type
 *   The entity type to load, e.g. node or user.
 * @param mixed $id
 *   The id of the entity to load.
 * @param bool $reset
 *   Whether to reset the internal cache for the requested entity type.
 *
 * @return \Drupal\Core\Entity\EntityInterface|null
 *   The entity object, or NULL if there is no entity with the given ID.
 *
 * @deprecated in Drupal 8.0.x, will be removed before Drupal 9.0.0. Use
 *   The method overriding Entity::load() for the entity type, e.g.
 *   \Drupal\node\Entity\Node::load() if the entity type is known. If the
 *   entity type is variable, use the entity manager service to load the entity
 *   from the entity storage:
 * @code
 * \Drupal::entityTypeManager()->getStorage($entity_type)->load($id);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityInterface::load()
 * @see \Drupal\Core\Entity\EntityTypeManagerInterface::getStorage()
 * @see \Drupal\Core\Entity\EntityStorageInterface::load()
 * @see \Drupal\Core\Entity\Sql\SqlContentEntityStorage
 * @see \Drupal\Core\Entity\Query\QueryInterface
 */
function entity_load($entity_type, $id, $reset = FALSE) {
  $controller = \Drupal::entityManager()->getStorage($entity_type);
  if ($reset) {
    $controller->resetCache([$id]);
  }
  return $controller->load($id);
}

/**
 * Loads an entity from the database.
 *
 * @param string $entity_type
 *   The entity type to load, e.g. node or user.
 * @param int $revision_id
 *   The id of the entity to load.
 *
 * @return \Drupal\Core\Entity\EntityInterface|null
 *   The entity object, or NULL if there is no entity with the given revision
 *   id.
 *
 * @deprecated as of Drupal 8.0.x, will be removed before Drupal 9.0.0. Use
 *   the entity storage's loadRevision() method to load a specific entity
 *   revision:
 * @code
 * \Drupal::entityTypeManager()
 *   ->getStorage($entity_type)
 *   ->loadRevision($revision_id);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityTypeManagerInterface::getStorage()
 * @see \Drupal\Core\Entity\EntityStorageInterface::loadRevision()
 * @see \Drupal\Core\Entity\Sql\SqlContentEntityStorage
 */
function entity_revision_load($entity_type, $revision_id) {
  return \Drupal::entityManager()
    ->getStorage($entity_type)
    ->loadRevision($revision_id);
}

/**
 * Deletes an entity revision.
 *
 * @param string $entity_type
 *   The entity type to load, e.g. node or user.
 * @param $revision_id
 *   The revision ID to delete.
 *
 * @deprecated as of Drupal 8.0.x, will be removed before Drupal 9.0.0. Use
 *   the entity storage's deleteRevision() method to delete a specific entity
 *   revision:
 * @code
 * \Drupal::entityTypeManager()
 *   ->getStorage($entity_type)
 *   ->deleteRevision($revision_id);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityTypeManagerInterface::getStorage()
 * @see \Drupal\Core\Entity\EntityStorageInterface::deleteRevision()
 */
function entity_revision_delete($entity_type, $revision_id) {
  \Drupal::entityManager()
    ->getStorage($entity_type)
    ->deleteRevision($revision_id);
}

/**
 * Loads multiple entities from the database.
 *
 * This function should be used whenever you need to load more than one entity
 * from the database. The entities are loaded into memory and will not require
 * database access if loaded again during the same page request.
 *
 * The actual loading is done through a class that has to implement the
 * \Drupal\Core\Entity\EntityStorageInterface interface. By default,
 * \Drupal\Core\Entity\Sql\SqlContentEntityStorage is used for content entities
 * and Drupal\Core\Config\Entity\ConfigEntityStorage for config entities. Entity
 * types can specify that a different class should be used by setting the
 * "handlers['storage']" key in the entity plugin annotation. These classes
 * can either implement the \Drupal\Core\Entity\EntityStorageInterface
 * interface, or, most commonly, extend the
 * \Drupal\Core\Entity\Sql\SqlContentEntityStorage class. See
 * \Drupal\node\Entity\Node and \Drupal\node\NodeStorage for an example.
 *
 * @param string $entity_type
 *   The entity type to load, e.g. node or user.
 * @param array $ids
 *   (optional) An array of entity IDs. If omitted, all entities are loaded.
 * @param bool $reset
 *   Whether to reset the internal cache for the requested entity type.
 *
 * @return array
 *   An array of entity objects indexed by their IDs.
 *
 * @deprecated in Drupal 8.0.x, will be removed before Drupal 9.0.0. Use
 *   The method overriding Entity::loadMultiple() for the entity type, e.g.
 *   \Drupal\node\Entity\Node::loadMultiple() if the entity type is known. If
 *   the entity type is variable, use the entity manager service to load the
 *   entity from the entity storage:
 * @code
 * \Drupal::entityTypeManager()->getStorage($entity_type)->loadMultiple($id);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityInterface::loadMultiple()
 * @see \Drupal\Core\Entity\EntityTypeManagerInterface::getStorage()
 * @see \Drupal\Core\Entity\EntityStorageInterface::loadMultiple()
 * @see \Drupal\Core\Entity\Sql\SqlContentEntityStorage
 * @see \Drupal\Core\Entity\Query\QueryInterface
 */
function entity_load_multiple($entity_type, array $ids = NULL, $reset = FALSE) {
  $controller = \Drupal::entityManager()->getStorage($entity_type);
  if ($reset) {
    $controller->resetCache($ids);
  }
  return $controller->loadMultiple($ids);
}

/**
 * Load entities by their property values.
 *
 * @param string $entity_type
 *   The entity type to load, e.g. node or user.
 * @param array $values
 *   An associative array where the keys are the property names and the
 *   values are the values those properties must have.
 *
 * @return array
 *   An array of entity objects indexed by their IDs. Returns an empty array if
 *   no matching entities are found.
 *
 * @deprecated as of Drupal 8.0.x, will be removed before Drupal 9.0.0. Use
 *   the entity storage's loadByProperties() method to load an entity by their
 *   property values:
 * @code
 * \Drupal::entityTypeManager()
 *   ->getStorage($entity_type)
 *   ->loadByProperties($values);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityTypeManagerInterface::getStorage()
 * @see \Drupal\Core\Entity\EntityStorageInterface::loadByProperties()
 */
function entity_load_multiple_by_properties($entity_type, array $values) {
  return \Drupal::entityManager()
    ->getStorage($entity_type)
    ->loadByProperties($values);
}

/**
 * Loads the unchanged, i.e. not modified, entity from the database.
 *
 * Unlike entity_load() this function ensures the entity is directly loaded from
 * the database, thus bypassing any static cache. In particular, this function
 * is useful to determine changes by comparing the entity being saved to the
 * stored entity.
 *
 * @param $entity_type
 *   The entity type to load, e.g. node or user.
 * @param $id
 *   The ID of the entity to load.
 *
 * @return \Drupal\Core\Entity\EntityInterface|null
 *   The unchanged entity, or FALSE if the entity cannot be loaded.
 *
 * @deprecated as of Drupal 8.0.x, will be removed before Drupal 9.0.0. Use
 *   the entity storage's loadUnchanged() method to load an unchanged entity:
 * @code
 * \Drupal::entityTypeManager()->getStorage($entity_type)->loadUnchanged($id);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityTypeManagerInterface::getStorage()
 * @see \Drupal\Core\Entity\EntityStorageInterface::loadUnchanged()
 */
function entity_load_unchanged($entity_type, $id) {
  return \Drupal::entityManager()
    ->getStorage($entity_type)
    ->loadUnchanged($id);
}

/**
 * Deletes multiple entities permanently.
 *
 * @param string $entity_type
 *   The type of the entity.
 * @param array $ids
 *   An array of entity IDs of the entities to delete.
 *
 * @deprecated as of Drupal 8.0.x, will be removed before Drupal 9.0.0. Use
 *   the entity storage's delete() method to delete multiple entities:
 * @code
 * $storage_handler = \Drupal::entityTypeManager()->getStorage($entity_type);
 * $entities = $storage_handler->loadMultiple($ids);
 * $storage_handler->delete($entities);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityTypeManagerInterface::getStorage()
 * @see \Drupal\Core\Entity\EntityStorageInterface::loadMultiple()
 * @see \Drupal\Core\Entity\EntityStorageInterface::delete()
 */
function entity_delete_multiple($entity_type, array $ids) {
  $controller = \Drupal::entityManager()->getStorage($entity_type);
  $entities = $controller->loadMultiple($ids);
  $controller->delete($entities);
}

/**
 * Constructs a new entity object, without permanently saving it.
 *
 * @param string $entity_type
 *   The type of the entity.
 * @param array $values
 *   (optional) An array of values to set, keyed by property name. If the
 *   entity type has bundles, the bundle key has to be specified.
 *
 * @return \Drupal\Core\Entity\EntityInterface
 *   A new entity object.
 *
 * @deprecated in Drupal 8.0.x, will be removed before Drupal 9.0.0. Use
 *   The method overriding Entity::create() for the entity type, e.g.
 *   \Drupal\node\Entity\Node::create() if the entity type is known. If the
 *   entity type is variable, use the entity storage's create() method to
 *   construct a new entity:
 * @code
 * \Drupal::entityTypeManager()->getStorage($entity_type)->create($values);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityTypeManagerInterface::getStorage()
 * @see \Drupal\Core\Entity\EntityStorageInterface::create()
 */
function entity_create($entity_type, array $values = []) {
  return \Drupal::entityManager()
    ->getStorage($entity_type)
    ->create($values);
}

/**
 * Returns the label of an entity.
 *
 * @param \Drupal\Core\Entity\EntityInterface $entity
 *   The entity for which to generate the label.
 * @param $langcode
 *   (optional) The language code of the language that should be used for
 *   getting the label. If set to NULL, the entity's default language is
 *   used.
 *
 * @return string|null
 *   The label of the entity, or NULL if there is no label defined.
 *
 * @deprecated as of Drupal 8.0.x, will be removed before Drupal 9.0.0. Use
 *   the entity's label() method to get the label of the entity:
 * @code
 * $entity->label($langcode);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityInterface::label()
 */
function entity_page_label(EntityInterface $entity, $langcode = NULL) {
  return $entity->label($langcode);
}

/**
 * Returns the render array for an entity.
 *
 * @param \Drupal\Core\Entity\EntityInterface $entity
 *   The entity to be rendered.
 * @param string $view_mode
 *   The view mode that should be used to display the entity.
 * @param string $langcode
 *   (optional) For which language the entity should be rendered, defaults to
 *   the current content language.
 * @param bool $reset
 *   (optional) Whether to reset the render cache for the requested entity.
 *   Defaults to FALSE.
 *
 * @return array
 *   A render array for the entity.
 *
 * @deprecated as of Drupal 8.0.x, will be removed before Drupal 9.0.0.
 *   Use the entity view builder's view() method for creating a render array:
 * @code
 * $view_builder = \Drupal::entityTypeManager()
 *   ->getViewBuilder($entity->getEntityTypeId());
 * return $view_builder->view($entity, $view_mode, $langcode);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityTypeManagerInterface::getViewBuilder()
 * @see \Drupal\Core\Entity\EntityViewBuilderInterface::view()
 */
function entity_view(EntityInterface $entity, $view_mode, $langcode = NULL, $reset = FALSE) {
  $render_controller = \Drupal::entityManager()->getViewBuilder($entity->getEntityTypeId());
  if ($reset) {
    $render_controller->resetCache([$entity]);
  }
  return $render_controller->view($entity, $view_mode, $langcode);
}

/**
 * Returns the render array for the provided entities.
 *
 * @param \Drupal\Core\Entity\EntityInterface[] $entities
 *   The entities to be rendered, must be of the same type.
 * @param string $view_mode
 *   The view mode that should be used to display the entity.
 * @param string $langcode
 *   (optional) For which language the entity should be rendered, defaults to
 *   the current content language.
 * @param bool $reset
 *   (optional) Whether to reset the render cache for the requested entities.
 *   Defaults to FALSE.
 *
 * @return array
 *   A render array for the entities, indexed by the same keys as the
 *   entities array passed in $entities.
 *
 * @deprecated as of Drupal 8.0.x, will be removed before Drupal 9.0.0.
 *   Use the entity view builder's viewMultiple() method for creating a render
 *   array for the provided entities:
 * @code
 * $view_builder = \Drupal::entityTypeManager()
 *   ->getViewBuilder($entity->getEntityTypeId());
 * return $view_builder->viewMultiple($entities, $view_mode, $langcode);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityTypeManagerInterface::getViewBuilder()
 * @see \Drupal\Core\Entity\EntityViewBuilderInterface::viewMultiple()
 */
function entity_view_multiple(array $entities, $view_mode, $langcode = NULL, $reset = FALSE) {
  $render_controller = \Drupal::entityManager()->getViewBuilder(reset($entities)->getEntityTypeId());
  if ($reset) {
    $render_controller->resetCache($entities);
  }
  return $render_controller->viewMultiple($entities, $view_mode, $langcode);
}

/**
 * Returns the entity view display associated with a bundle and view mode.
 *
 * Use this function when assigning suggested display options for a component
 * in a given view mode. Note that they will only be actually used at render
 * time if the view mode itself is configured to use dedicated display settings
 * for the bundle; if not, the 'default' display is used instead.
 *
 * The function reads the entity view display from the current configuration, or
 * returns a ready-to-use empty one if configuration entry exists yet for this
 * bundle and view mode. This streamlines manipulation of display objects by
 * always returning a consistent object that reflects the current state of the
 * configuration.
 *
 * Example usage:
 * - Set the 'body' field to be displayed and the 'field_image' field to be
 *   hidden on article nodes in the 'default' display.
 * @code
 * entity_get_display('node', 'article', 'default')
 *   ->setComponent('body', array(
 *     'type' => 'text_summary_or_trimmed',
 *     'settings' => array('trim_length' => '200')
 *     'weight' => 1,
 *   ))
 *   ->removeComponent('field_image')
 *   ->save();
 * @endcode
 *
 * @param string $entity_type
 *   The entity type.
 * @param string $bundle
 *   The bundle.
 * @param string $view_mode
 *   The view mode, or 'default' to retrieve the 'default' display object for
 *   this bundle.
 *
 * @return \Drupal\Core\Entity\Display\EntityViewDisplayInterface
 *   The entity view display associated with the view mode.
 *
 * @deprecated as of Drupal 8.0.x, will be removed before Drupal 9.0.0.
 *   If the display is available in configuration use:
 *   @code
 *   \Drupal::entityTypeManager()
 *     ->getStorage('entity_view_display')
 *     ->load($entity_type . '.' . $bundle . '.' . $view_mode);
 *   @endcode
 *   When the display is not available in configuration, you can create a new
 *   EntityViewDisplay object using:
 *   @code
 *   $values = array(
 *     'targetEntityType' => $entity_type,
 *     'bundle' => $bundle,
 *     'mode' => $view_mode,
 *     'status' => TRUE,
<<<<<<< HEAD
 *   ));
=======
 *   );
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
 *   \Drupal::entityTypeManager()
 *     ->getStorage('entity_view_display')
 *     ->create($values);
 *   @endcode
 *
 * @see \Drupal\Core\Entity\EntityStorageInterface::create()
 * @see \Drupal\Core\Entity\EntityStorageInterface::load()
 */
function entity_get_display($entity_type, $bundle, $view_mode) {
  // Try loading the display from configuration.
  $display = EntityViewDisplay::load($entity_type . '.' . $bundle . '.' . $view_mode);

  // If not found, create a fresh display object. We do not preemptively create
  // new entity_view_display configuration entries for each existing entity type
  // and bundle whenever a new view mode becomes available. Instead,
  // configuration entries are only created when a display object is explicitly
  // configured and saved.
  if (!$display) {
    $display = EntityViewDisplay::create([
      'targetEntityType' => $entity_type,
      'bundle' => $bundle,
      'mode' => $view_mode,
      'status' => TRUE,
    ]);
  }

  return $display;
}

/**
 * Returns the entity form display associated with a bundle and form mode.
 *
 * The function reads the entity form display object from the current
 * configuration, or returns a ready-to-use empty one if no configuration entry
 * exists yet for this bundle and form mode. This streamlines manipulation of
 * entity form displays by always returning a consistent object that reflects
 * the current state of the configuration.
 *
 * Example usage:
 * - Set the 'body' field to be displayed with the 'text_textarea_with_summary'
 *   widget and the 'field_image' field to be hidden on article nodes in the
 *  'default' form mode.
 * @code
 * entity_get_form_display('node', 'article', 'default')
 *   ->setComponent('body', array(
 *     'type' => 'text_textarea_with_summary',
 *     'weight' => 1,
 *   ))
 *   ->setComponent('field_image', array(
 *     'region' => 'hidden',
 *   ))
 *   ->save();
 * @endcode
 *
 * @param string $entity_type
 *   The entity type.
 * @param string $bundle
 *   The bundle.
 * @param string $form_mode
 *   The form mode.
 *
 * @return \Drupal\Core\Entity\Display\EntityFormDisplayInterface
 *   The entity form display associated with the given form mode.
 *
 * @deprecated as of Drupal 8.0.x, will be removed before Drupal 9.0.0.
 *   If the entity form display is available in configuration use:
 * @code
 *   \Drupal::entityTypeManager()
 *     ->getStorage('entity_form_display')
 *     ->load($entity_type . '.' . $bundle . '.' . $form_mode);
 * @endcode
 *   When the entity form display is not available in configuration, you can
 *   create a new EntityFormDisplay object using:
 * @code
 * $values = array(
 *  'targetEntityType' => $entity_type,
 *  'bundle' => $bundle,
 *  'mode' => $form_mode,
 *  'status' => TRUE,
<<<<<<< HEAD
 * ));
=======
 * );
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
 * \Drupal::entityTypeManager()
 *   ->getStorage('entity_form_display')
 *   ->create($values);
 * @endcode
 *
 * @see \Drupal\Core\Entity\EntityStorageInterface::create()
 * @see \Drupal\Core\Entity\EntityStorageInterface::load()
 */
function entity_get_form_display($entity_type, $bundle, $form_mode) {
  // Try loading the entity from configuration.
  $entity_form_display = EntityFormDisplay::load($entity_type . '.' . $bundle . '.' . $form_mode);

  // If not found, create a fresh entity object. We do not preemptively create
  // new entity form display configuration entries for each existing entity type
  // and bundle whenever a new form mode becomes available. Instead,
  // configuration entries are only created when an entity form display is
  // explicitly configured and saved.
  if (!$entity_form_display) {
    $entity_form_display = EntityFormDisplay::create([
      'targetEntityType' => $entity_type,
      'bundle' => $bundle,
      'mode' => $form_mode,
      'status' => TRUE,
    ]);
  }

  return $entity_form_display;
}
