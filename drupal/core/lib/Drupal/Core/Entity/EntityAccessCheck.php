<?php

namespace Drupal\Core\Entity;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;

/**
 * Provides a generic access checker for entities.
 */
class EntityAccessCheck implements AccessInterface {

  /**
   * Checks access to the entity operation on the given route.
   *
<<<<<<< HEAD
   * The value of the '_entity_access' key must be in the pattern
   * 'entity_slug_name.operation.' For example, this will check a node for
   * 'update' access:
=======
   * The route's '_entity_access' requirement must follow the pattern
   * 'entity_stub_name.operation', where available operations are:
   * 'view', 'update', 'create', and 'delete'.
   *
   * For example, this route configuration invokes a permissions check for
   * 'update' access to entities of type 'node':
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * @code
   * pattern: '/foo/{node}/bar'
   * requirements:
   *   _entity_access: 'node.update'
   * @endcode
<<<<<<< HEAD
   * And this will check a dynamic entity type:
=======
   * And this will check 'delete' access to a dynamic entity type:
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   * @code
   * example.route:
   *   path: foo/{entity_type}/{example}
   *   requirements:
<<<<<<< HEAD
   *     _entity_access: example.update
=======
   *     _entity_access: example.delete
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   *   options:
   *     parameters:
   *       example:
   *         type: entity:{entity_type}
   * @endcode
<<<<<<< HEAD
   * @see \Drupal\Core\ParamConverter\EntityConverter
   *
   * Available operations are 'view', 'update', 'create', and 'delete'.
=======
   * The route match parameter corresponding to the stub name is checked to
   * see if it is entity-like i.e. implements EntityInterface.
   *
   * @see \Drupal\Core\ParamConverter\EntityConverter
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
   *
   * @param \Symfony\Component\Routing\Route $route
   *   The route to check against.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The parametrized route
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The currently logged in account.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access(Route $route, RouteMatchInterface $route_match, AccountInterface $account) {
    // Split the entity type and the operation.
    $requirement = $route->getRequirement('_entity_access');
    list($entity_type, $operation) = explode('.', $requirement);
    // If $entity_type parameter is a valid entity, call its own access check.
    $parameters = $route_match->getParameters();
    if ($parameters->has($entity_type)) {
      $entity = $parameters->get($entity_type);
      if ($entity instanceof EntityInterface) {
        return $entity->access($operation, $account, TRUE);
      }
    }
    // No opinion, so other access checks should decide if access should be
    // allowed or not.
    return AccessResult::neutral();
  }

}
