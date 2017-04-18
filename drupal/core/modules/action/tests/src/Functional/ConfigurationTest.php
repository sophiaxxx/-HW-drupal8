<?php

namespace Drupal\Tests\action\Functional;

use Drupal\Component\Utility\Crypt;
<<<<<<< HEAD
=======
use Drupal\system\Entity\Action;
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
use Drupal\Tests\BrowserTestBase;

/**
 * Tests complex actions configuration by adding, editing, and deleting a
 * complex action.
 *
 * @group action
 */
class ConfigurationTest extends BrowserTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('action');
=======
  public static $modules = ['action'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests configuration of advanced actions through administration interface.
   */
<<<<<<< HEAD
  function testActionConfiguration() {
    // Create a user with permission to view the actions administration pages.
    $user = $this->drupalCreateUser(array('administer actions'));
    $this->drupalLogin($user);

    // Make a POST request to admin/config/system/actions.
    $edit = array();
=======
  public function testActionConfiguration() {
    // Create a user with permission to view the actions administration pages.
    $user = $this->drupalCreateUser(['administer actions']);
    $this->drupalLogin($user);

    // Make a POST request to admin/config/system/actions.
    $edit = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $edit['action'] = Crypt::hashBase64('action_goto_action');
    $this->drupalPostForm('admin/config/system/actions', $edit, t('Create'));
    $this->assertResponse(200);

    // Make a POST request to the individual action configuration page.
<<<<<<< HEAD
    $edit = array();
=======
    $edit = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $action_label = $this->randomMachineName();
    $edit['label'] = $action_label;
    $edit['id'] = strtolower($action_label);
    $edit['url'] = 'admin';
    $this->drupalPostForm('admin/config/system/actions/add/' . Crypt::hashBase64('action_goto_action'), $edit, t('Save'));
    $this->assertResponse(200);

    // Make sure that the new complex action was saved properly.
    $this->assertText(t('The action has been successfully saved.'), "Make sure we get a confirmation that we've successfully saved the complex action.");
    $this->assertText($action_label, "Make sure the action label appears on the configuration page after we've saved the complex action.");

    // Make another POST request to the action edit page.
    $this->clickLink(t('Configure'));
    preg_match('|admin/config/system/actions/configure/(.+)|', $this->getUrl(), $matches);
    $aid = $matches[1];
<<<<<<< HEAD
    $edit = array();
=======
    $edit = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $new_action_label = $this->randomMachineName();
    $edit['label'] = $new_action_label;
    $edit['url'] = 'admin';
    $this->drupalPostForm(NULL, $edit, t('Save'));
    $this->assertResponse(200);

    // Make sure that the action updated properly.
    $this->assertText(t('The action has been successfully saved.'), "Make sure we get a confirmation that we've successfully updated the complex action.");
    $this->assertNoText($action_label, "Make sure the old action label does NOT appear on the configuration page after we've updated the complex action.");
    $this->assertText($new_action_label, "Make sure the action label appears on the configuration page after we've updated the complex action.");

    $this->clickLink(t('Configure'));
    $element = $this->xpath('//input[@type="text" and @value="admin"]');
    $this->assertTrue(!empty($element), 'Make sure the URL appears when re-editing the action.');

    // Make sure that deletions work properly.
    $this->drupalGet('admin/config/system/actions');
    $this->clickLink(t('Delete'));
    $this->assertResponse(200);
<<<<<<< HEAD
    $edit = array();
=======
    $edit = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->drupalPostForm("admin/config/system/actions/configure/$aid/delete", $edit, t('Delete'));
    $this->assertResponse(200);

    // Make sure that the action was actually deleted.
<<<<<<< HEAD
    $this->assertRaw(t('The action %action has been deleted.', array('%action' => $new_action_label)), 'Make sure that we get a delete confirmation message.');
=======
    $this->assertRaw(t('The action %action has been deleted.', ['%action' => $new_action_label]), 'Make sure that we get a delete confirmation message.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->drupalGet('admin/config/system/actions');
    $this->assertResponse(200);
    $this->assertNoText($new_action_label, "Make sure the action label does not appear on the overview page after we've deleted the action.");

<<<<<<< HEAD
    $action = entity_load('action', $aid);
=======
    $action = Action::load($aid);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->assertFalse($action, 'Make sure the action is gone after being deleted.');
  }

}
