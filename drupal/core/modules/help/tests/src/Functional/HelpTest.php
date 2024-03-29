<?php

namespace Drupal\Tests\help\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Verify help display and user access to help based on permissions.
 *
 * @group help
 */
class HelpTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * The help_test module implements hook_help() but does not provide a module
   * overview page. The help_page_test module has a page section plugin that
   * returns no links.
   *
   * @var array.
   */
<<<<<<< HEAD
  public static $modules = array('help_test', 'help_page_test');
=======
  public static $modules = ['help_test', 'help_page_test'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Use the Standard profile to test help implementations of many core modules.
   */
  protected $profile = 'standard';

  /**
   * The admin user that will be created.
   */
  protected $adminUser;

  /**
   * The anonymous user that will be created.
   */
  protected $anyUser;

  protected function setUp() {
    parent::setUp();

    // Create users.
<<<<<<< HEAD
    $this->adminUser = $this->drupalCreateUser(array('access administration pages', 'view the administration theme', 'administer permissions'));
    $this->anyUser = $this->drupalCreateUser(array());
=======
    $this->adminUser = $this->drupalCreateUser(['access administration pages', 'view the administration theme', 'administer permissions']);
    $this->anyUser = $this->drupalCreateUser([]);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
  }

  /**
   * Logs in users, tests help pages.
   */
  public function testHelp() {
    // Log in the root user to ensure as many admin links appear as possible on
    // the module overview pages.
    $this->drupalLogin($this->rootUser);
    $this->verifyHelp();

    // Log in the regular user.
    $this->drupalLogin($this->anyUser);
    $this->verifyHelp(403);

    // Verify that introductory help text exists, goes for 100% module coverage.
    $this->drupalLogin($this->adminUser);
    $this->drupalGet('admin/help');
<<<<<<< HEAD
    $this->assertRaw(t('For more information, refer to the help listed on this page or to the <a href=":docs">online documentation</a> and <a href=":support">support</a> pages at <a href=":drupal">drupal.org</a>.', array(':docs' => 'https://www.drupal.org/documentation', ':support' => 'https://www.drupal.org/support', ':drupal' => 'https://www.drupal.org')));
=======
    $this->assertRaw(t('For more information, refer to the help listed on this page or to the <a href=":docs">online documentation</a> and <a href=":support">support</a> pages at <a href=":drupal">drupal.org</a>.', [':docs' => 'https://www.drupal.org/documentation', ':support' => 'https://www.drupal.org/support', ':drupal' => 'https://www.drupal.org']));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Verify that hook_help() section title and description appear.
    $this->assertRaw('<h2>' . t('Module overviews') . '</h2>');
    $this->assertRaw('<p>' . t('Module overviews are provided by modules. Overviews available for your installed modules:'), '</p>');

    // Verify that an empty section is handled correctly.
    $this->assertRaw('<h2>' . t('Empty section') . '</h2>');
    $this->assertRaw('<p>' . t('This description should appear.'), '</p>');
    $this->assertText(t('There is currently nothing in this section.'));

    // Make sure links are properly added for modules implementing hook_help().
    foreach ($this->getModuleList() as $module => $name) {
<<<<<<< HEAD
      $this->assertLink($name, 0, format_string('Link properly added to @name (admin/help/@module)', array('@module' => $module, '@name' => $name)));
=======
      $this->assertLink($name, 0, format_string('Link properly added to @name (admin/help/@module)', ['@module' => $module, '@name' => $name]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    }

    // Ensure that module which does not provide an module overview page is
    // handled correctly.
    $this->clickLink(\Drupal::moduleHandler()->getName('help_test'));
<<<<<<< HEAD
    $this->assertRaw(t('No help is available for module %module.', array('%module' => \Drupal::moduleHandler()->getName('help_test'))));
=======
    $this->assertRaw(t('No help is available for module %module.', ['%module' => \Drupal::moduleHandler()->getName('help_test')]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Verify that the order of topics is alphabetical by displayed module
    // name, by checking the order of some modules, including some that would
    // have a different order if it was done by machine name instead.
    $this->drupalGet('admin/help');
    $page_text = $this->getTextContent();
    $start = strpos($page_text, 'Module overviews');
    $pos = $start;
    $list = ['Block', 'Color', 'Custom Block', 'History', 'Text Editor'];
    foreach ($list as $name) {
      $this->assertLink($name);
      $new_pos = strpos($page_text, $name, $start);
      $this->assertTrue($new_pos > $pos, 'Order of ' . $name . ' is correct on page');
      $pos = $new_pos;
    }
  }

  /**
   * Verifies the logged in user has access to the various help pages.
   *
   * @param int $response
   *   (optional) An HTTP response code. Defaults to 200.
   */
  protected function verifyHelp($response = 200) {
    $this->drupalGet('admin/index');
    $this->assertResponse($response);
    if ($response == 200) {
      $this->assertText('This page shows you all available administration tasks for each module.');
    }
    else {
      $this->assertNoText('This page shows you all available administration tasks for each module.');
    }

    foreach ($this->getModuleList() as $module => $name) {
      // View module help page.
      $this->drupalGet('admin/help/' . $module);
      $this->assertResponse($response);
      if ($response == 200) {
<<<<<<< HEAD
        $this->assertTitle($name . ' | Drupal', format_string('%module title was displayed', array('%module' => $module)));
        $this->assertEquals($name, $this->cssSelect('h1.page-title')[0]->getText(), "$module heading was displayed");
        $admin_tasks = system_get_module_admin_tasks($module, system_get_info('module', $module));
        if (!empty($admin_tasks)) {
          $this->assertText(t('@module administration pages', array('@module' => $name)));
=======
        $this->assertTitle($name . ' | Drupal', format_string('%module title was displayed', ['%module' => $module]));
        $this->assertEquals($name, $this->cssSelect('h1.page-title')[0]->getText(), "$module heading was displayed");
        $admin_tasks = system_get_module_admin_tasks($module, system_get_info('module', $module));
        if (!empty($admin_tasks)) {
          $this->assertText(t('@module administration pages', ['@module' => $name]));
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
        }
        foreach ($admin_tasks as $task) {
          $this->assertLink($task['title']);
          // Ensure there are no double escaped '&' or '<' characters.
          $this->assertNoEscaped('&amp;', 'The help text does not have double escaped &amp;.');
          $this->assertNoEscaped('&lt;', 'The help text does not have double escaped &lt;.');
          // Ensure there are no escaped '<' characters.
          $this->assertNoEscaped('<', 'The help text does not have single escaped &lt;.');
        }
        // Ensure there are no double escaped '&' or '<' characters.
        $this->assertNoEscaped('&amp;');
        $this->assertNoEscaped('&lt;');
        // Ensure there are no escaped '<' characters.
        $this->assertNoEscaped('<');
      }
    }
  }

  /**
   * Gets the list of enabled modules that implement hook_help().
   *
   * @return array
   *   A list of enabled modules.
   */
  protected function getModuleList() {
<<<<<<< HEAD
    $modules = array();
=======
    $modules = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $module_data = system_rebuild_module_data();
    foreach (\Drupal::moduleHandler()->getImplementations('help') as $module) {
      $modules[$module] = $module_data[$module]->info['name'];
    }
    return $modules;
  }

}
