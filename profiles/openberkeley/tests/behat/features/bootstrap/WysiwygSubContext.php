<?php
/**
 * @file
 * Provide Behat step-definitions for WYSIWYG editor.
 *
 * @todo This should move to the WYSIWYG feature folder eventually
 */

use Drupal\DrupalExtension\Context\DrupalSubContextInterface;
use Behat\Behat\Context\BehatContext;

class WysiwygSubContext extends BehatContext implements DrupalSubContextInterface {
  /**
   * Initializes context.
   */
  public function __construct(array $parameters = array()) {
  }

  public static function getAlias() {
    return 'wysiwyg';
  }

  /**
   * Get the session from the parent context.
   */
  protected function getSession() {
    return $this->getMainContext()->getSession();
  }

  /**
   * @Given /^I click in the WYSIWYG editor$/
   */
  public function iClickInTheWysiwygEditor($editorFrame='edit-body-und-0-value_ifr') {
    /*
     * @todo : This does not actually work when using Selenium with Firefox
     * Needs a different approach
     * PhantomJS can interact with the WYSIWYG programmatically,
     * but it crashes on selecting an image style in the Media browser
     */
    $this->getSession()->switchToIFrame($editorFrame);
    $driver = $this->getSession()->getDriver();
    $editor = $driver->find("//body[@id='tinymce']");
    $editor[0]->click();
    $this->getSession()->switchToIFrame();
  }

  /**
   * @Given /^I select the text in the WYSIWYG editor$/
   */
  public function iSelectTheTextInTheEditor($editorFrame='edit-body-und-0-value_ifr', $editorType='tinymce') {
    /*
     * @todo : 
     * Figure out how to run non-headless;
     * Allow for more than one WYSIWYG field on a page;
     * Allow for only a subset of the text to be selected;
     * Allow for different WYSYWYG editor types;
     * Parameterize;
     * Test results with more buttons than just Bold and Italic!
     */

    //verify presence of field
    $driver = $this->getSession()->getDriver();
    $editor = $driver->find("//iframe[@id='$editorFrame']");

    if (empty($editor)) {
      throw new \Exception(sprintf('The editor "%s" was not found on the page %s', $editorFrame, $this->getSession()->getCurrentUrl()));
    }

    $selector = "document.getElementById('$editorFrame').contentDocument.getElementById('$editorType')";

    //create and inject javascript
    $javascript  = "selection = window.getSelection();";
    $javascript .= "range = document.createRange();";
    $javascript .= "range.selectNodeContents($selector);";
    $javascript .= "selection.removeAllRanges();";
    $javascript .= "selection.addRange(range);";

    $this->getSession()->executeScript($javascript);
  }

  /**
   * @When /^I click the "([^"]*)" button in the WYSIWYG editor$/
   */
  public function iClickTheButtonInTheWysiwygEditor($action) {

    /*
     * @todo : Check for different WYSYWYG editor types;
     * Allow for more than one WYSIWYG field per page;
     * Test with more buttons 
     */

    //use selenium webdriver function
    $driver = $this->getSession()->getDriver();

    //expand wysiwyg toolbar
    $expand = $driver->find("//a[contains(@title, 'toolbars')]");
    $expand[0]->click();

    //click action button
    $button = $driver->find("//a[starts-with(@title, '$action')]");
    $button[0]->click();
    $driver->wait(1000,true);
  }

}
