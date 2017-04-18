<?php

namespace Drupal\update_script_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller routines for update_script_test routes.
 */
class UpdateScriptTestController extends ControllerBase {

  /**
   * Outputs a link to the database updates URL.
   */
  public function databaseUpdatesMenuItem(Request $request) {
    // @todo Simplify with https://www.drupal.org/node/2548095
    $base_url = str_replace('/update.php', '', $request->getBaseUrl());
    $url = (new Url('system.db_update'))->setOption('base_url', $base_url);
<<<<<<< HEAD
    $build['main'] = array(
=======
    $build['main'] = [
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
      '#type' => 'link',
      '#title' => $this->t('Run database updates'),
      '#url' => $url,
      '#access' => $url->access($this->currentUser()),
<<<<<<< HEAD
    );
=======
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    return $build;
  }

}
