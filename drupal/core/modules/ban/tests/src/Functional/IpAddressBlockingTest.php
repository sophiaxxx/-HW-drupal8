<?php

namespace Drupal\Tests\ban\Functional;

use Drupal\Tests\BrowserTestBase;
use Drupal\Core\Database\Database;
use Drupal\ban\BanIpManager;

/**
 * Tests IP address banning.
 *
 * @group ban
 */
class IpAddressBlockingTest extends BrowserTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
<<<<<<< HEAD
  public static $modules = array('ban');
=======
  public static $modules = ['ban'];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

  /**
   * Tests various user input to confirm correct validation and saving of data.
   */
<<<<<<< HEAD
  function testIPAddressValidation() {
    // Create user.
    $admin_user = $this->drupalCreateUser(array('ban IP addresses'));
=======
  public function testIPAddressValidation() {
    // Create user.
    $admin_user = $this->drupalCreateUser(['ban IP addresses']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $this->drupalLogin($admin_user);
    $this->drupalGet('admin/config/people/ban');

    // Ban a valid IP address.
<<<<<<< HEAD
    $edit = array();
    $edit['ip'] = '1.2.3.3';
    $this->drupalPostForm('admin/config/people/ban', $edit, t('Add'));
    $ip = db_query("SELECT iid from {ban_ip} WHERE ip = :ip", array(':ip' => $edit['ip']))->fetchField();
    $this->assertTrue($ip, 'IP address found in database.');
    $this->assertRaw(t('The IP address %ip has been banned.', array('%ip' => $edit['ip'])), 'IP address was banned.');

    // Try to block an IP address that's already blocked.
    $edit = array();
=======
    $edit = [];
    $edit['ip'] = '1.2.3.3';
    $this->drupalPostForm('admin/config/people/ban', $edit, t('Add'));
    $ip = db_query("SELECT iid from {ban_ip} WHERE ip = :ip", [':ip' => $edit['ip']])->fetchField();
    $this->assertTrue($ip, 'IP address found in database.');
    $this->assertRaw(t('The IP address %ip has been banned.', ['%ip' => $edit['ip']]), 'IP address was banned.');

    // Try to block an IP address that's already blocked.
    $edit = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $edit['ip'] = '1.2.3.3';
    $this->drupalPostForm('admin/config/people/ban', $edit, t('Add'));
    $this->assertText(t('This IP address is already banned.'));

    // Try to block a reserved IP address.
<<<<<<< HEAD
    $edit = array();
=======
    $edit = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $edit['ip'] = '255.255.255.255';
    $this->drupalPostForm('admin/config/people/ban', $edit, t('Add'));
    $this->assertText(t('Enter a valid IP address.'));

    // Try to block a reserved IP address.
<<<<<<< HEAD
    $edit = array();
=======
    $edit = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $edit['ip'] = 'test.example.com';
    $this->drupalPostForm('admin/config/people/ban', $edit, t('Add'));
    $this->assertText(t('Enter a valid IP address.'));

    // Submit an empty form.
<<<<<<< HEAD
    $edit = array();
=======
    $edit = [];
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $edit['ip'] = '';
    $this->drupalPostForm('admin/config/people/ban', $edit, t('Add'));
    $this->assertText(t('Enter a valid IP address.'));

    // Pass an IP address as a URL parameter and submit it.
    $submit_ip = '1.2.3.4';
<<<<<<< HEAD
    $this->drupalPostForm('admin/config/people/ban/' . $submit_ip, array(), t('Add'));
    $ip = db_query("SELECT iid from {ban_ip} WHERE ip = :ip", array(':ip' => $submit_ip))->fetchField();
    $this->assertTrue($ip, 'IP address found in database');
    $this->assertRaw(t('The IP address %ip has been banned.', array('%ip' => $submit_ip)), 'IP address was banned.');
=======
    $this->drupalPostForm('admin/config/people/ban/' . $submit_ip, [], t('Add'));
    $ip = db_query("SELECT iid from {ban_ip} WHERE ip = :ip", [':ip' => $submit_ip])->fetchField();
    $this->assertTrue($ip, 'IP address found in database');
    $this->assertRaw(t('The IP address %ip has been banned.', ['%ip' => $submit_ip]), 'IP address was banned.');
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7

    // Submit your own IP address. This fails, although it works when testing
    // manually.
    // TODO: On some systems this test fails due to a bug/inconsistency in cURL.
    // $edit = array();
    // $edit['ip'] = \Drupal::request()->getClientIP();
    // $this->drupalPostForm('admin/config/people/ban', $edit, t('Save'));
    // $this->assertText(t('You may not ban your own IP address.'));

    // Test duplicate ip address are not present in the 'blocked_ips' table.
    // when they are entered programmatically.
    $connection = Database::getConnection();
    $banIp = new BanIpManager($connection);
    $ip = '1.0.0.0';
    $banIp->banIp($ip);
    $banIp->banIp($ip);
    $banIp->banIp($ip);
    $query = db_select('ban_ip', 'bip');
<<<<<<< HEAD
    $query->fields('bip', array('iid'));
=======
    $query->fields('bip', ['iid']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query->condition('bip.ip', $ip);
    $ip_count = $query->execute()->fetchAll();
    $this->assertEqual(1, count($ip_count));
    $ip = '';
    $banIp->banIp($ip);
    $banIp->banIp($ip);
    $query = db_select('ban_ip', 'bip');
<<<<<<< HEAD
    $query->fields('bip', array('iid'));
=======
    $query->fields('bip', ['iid']);
>>>>>>> d6512431464720e04874fbc8bad89f7506bcfeb7
    $query->condition('bip.ip', $ip);
    $ip_count = $query->execute()->fetchAll();
    $this->assertEqual(1, count($ip_count));
  }

}
