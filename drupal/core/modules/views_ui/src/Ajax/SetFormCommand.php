<?php

namespace Drupal\views_ui\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Provides an AJAX command for setting a form submit URL in modal forms.
 *
 * This command is implemented in Drupal.AjaxCommands.prototype.viewsSetForm.
 */
class SetFormCommand implements CommandInterface {

  /**
   * The URL of the form.
   *
   * @var string
   */
  protected $url;

  /**
   * Constructs a SetFormCommand object.
   *
   * @param string $url
   *   The URL of the form.
   */
  public function __construct($url) {
    $this->url = $url;
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
<<<<<<< HEAD
    return array(
      'command' => 'viewsSetForm',
      'url' => $this->url,
    );
=======
    return [
      'command' => 'viewsSetForm',
      'url' => $this->url,
    ];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

}
