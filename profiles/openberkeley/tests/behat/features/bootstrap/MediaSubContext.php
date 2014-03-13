<?php
/**
 * @file
 * Provide Behat step-definitions for WYSIWYG editor.
 *
 * @todo This should move to the WYSIWYG feature folder eventually
 * Also, add a cleanup function to delete files uploaded into WYSIWYG fields
 */

use Drupal\DrupalExtension\Context\DrupalSubContextInterface;
use Behat\Behat\Context\BehatContext;

class MediaSubContext extends BehatContext implements DrupalSubContextInterface {
  /**
   * Initializes context.
   */
  public function __construct(array $parameters = array()) {
  }

  public static function getAlias() {
    return 'media';
  }

  /**
   * Get the session from the parent context.
   */
  protected function getSession() {
    return $this->getMainContext()->getSession();
  }

  /**
   * @Given /^I click the fake "([^"]*)" button$/
   */
  public function iClickTheFakeButton($text) {
    //Media style selector "buttons" are A tags with no href, so not findable by normal steps.
    //@todo: what if more than one link with the text?
    $driver = $this->getSession()->getDriver();
    $fakebutton = $driver->find("//a[contains(text(),$text)]");
    $fakebutton[0]->click();
  }
}
