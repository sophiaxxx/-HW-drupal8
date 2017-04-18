<?php

/**
 * @file
 * Post update functions for Responsive Image.
 */

use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\Core\Entity\Entity\EntityViewDisplay;

/**
<<<<<<< HEAD
 * @addtogroup updates-8.1.x
 * @{
 */

/**
=======
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
 * Make responsive image formatters dependent on responsive image styles.
 */
function responsive_image_post_update_recreate_dependencies() {
  $displays = EntityViewDisplay::loadMultiple();
  array_walk($displays, function(EntityViewDisplayInterface $entity_view_display) {
    $old_dependencies = $entity_view_display->getDependencies();
    $new_dependencies = $entity_view_display->calculateDependencies()->getDependencies();
    if ($old_dependencies !== $new_dependencies) {
      $entity_view_display->save();
    }
  });
}
<<<<<<< HEAD

/**
 * @} End of "addtogroup updates-8.1.x".
 */
=======
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
