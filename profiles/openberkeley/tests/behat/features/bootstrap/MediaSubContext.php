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

    $javascript  = <<<EOT
    var aTags = document.getElementsByTagName("a");
    var searchText = "$text";
    var found;
    for (var i = 0; i < aTags.length; i++) {
      if (aTags[i].textContent == searchText) {
      found = aTags[i];
      break;
      }
    }
    found.click();
EOT;
    $this->getSession()->executeScript($javascript);
  }
}
