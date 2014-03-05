<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Event\StepEvent,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Drupal\DrupalExtension\Context\DrupalContext;
use Drupal\Component\Utility\Random;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends DrupalContext
{
  /**
   * Initializes context.
   * Every scenario gets it's own context object.
   *
   * @param array $parameters context parameters (set them up through behat.yml)
   */
  private $params = array();

  public function __construct(array $parameters) {
    // Initialize your context here
    $this->useContext('panels', new PanelsSubContext());
    // $this->useContext('calnet', new CalnetSubContext());
    $this->params = $parameters;
  }
  
  public function login() {
    // Check if logged in.
    if ($this->loggedIn()) {
      $this->logout();
    }
    $loginPath = $this->params['calnet'] ? '/user/admin_login' : '/user';

    if (!$this->user) {
      throw new \Exception('Tried to login without a user.');
    }

    $this->getSession()->visit($this->locatePath($loginPath));
    $element = $this->getSession()->getPage();
    $element->fillField($this->getDrupalText('username_field'), $this->user->name);
    $element->fillField($this->getDrupalText('password_field'), $this->user->pass);
    $submit = $element->findButton($this->getDrupalText('log_in'));
    if (empty($submit)) {
      throw new \Exception(sprintf("No submit button at %s", $this->getSession()->getCurrentUrl()));
    }

    // Log in.
    $submit->click();

    if (!$this->loggedIn()) {
      throw new \Exception(sprintf("Failed to log in as user '%s' with role '%s'", $this->user->name, $this->user->role));
    }
  }

//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//

  /**
   * @Given /^I "([^"]*)" the text "([^"]*)" in the "([^"]*)" field WYSIWYG editor$/
   */
  public function iHighlightTheTextInTheEditor($action, $text, $element, $frame=true) {
    //set up editor, text, and buttons
    $editorFrame = $this->params['wysiwyg_iframe'] ? $this->params['wysiwyg_iframe'] : 'edit-fieldname-und-0-value_ifr';
    $editorType = $this->params['editor'] ? $this->params['editor'] : 'tinymce';
    $editorId = preg_replace('/fieldname/', $element, $editorFrame);
    $selector = "document.getElementById('$editorId').contentDocument.getElementById('$editorType')";

    //inject javascript
    $javascript  = "selection = window.getSelection();";
    $javascript .= "range = document.createRange();";
    $javascript .= "range.selectNodeContents($selector);";
    $javascript .= "selection.removeAllRanges();";
    $javascript .= "selection.addRange(range);";

    $this->getSession()->executeScript($javascript);

    //click button using selenium webdriver function
    $driver = $this->getSession()->getDriver();
    $button = $driver->find("//a[starts-with(@title, '$action')]");
    $button[0]->click();
    $driver->wait(1000,true);
  }

    /**
* @Given /^I resize the window to "(\d+)" by "(\d+)"$/
*/
  public function iResizeWindow($width, $height) {
      $this->getSession()->resizeWindow((int) $width, (int) $height);
  }

  /**
   * @AfterStep @javascript
   *
   * After every step in a @javascript scenario, we want to wait for AJAX
   * loading to finish.
   */
  public function afterStep(StepEvent $event) {
    if ($event->getResult() === 0) {
      $this->iWaitForAJAX();
    }
  }

  /**
   * @Given /^Panopoly magic live previews are disabled$/
   *
   * Disable live previews via Panopoly Magic.
   */
  public function disablePanopolyMagicLivePreview() {
    $this->getDriver('drush')->vset('panopoly_magic_live_preview 0 --yes');
  }

  /**
   * @Given /^Panopoly magic live previews are automatic$/
   *
   * Enable live previews via Panopoly Magic.
   */
  public function enableAutomaticPanopolyMagicLivePreview() {
    $this->getDriver('drush')->vset('panopoly_magic_live_preview 1 --yes');
  }

  /**
   * @Given /^Panopoly magic live previews are manual$/
   *
   * Enable live previews via Panopoly Magic.
   */
  public function enableManualPanopolyMagicLivePreview() {
    $this->getDriver('drush')->vset('panopoly_magic_live_preview 2 --yes');
  }

  /**
   * @Given /^(?:|I )wait(?:| for) (\d+) seconds?$/
   *
   * Wait for the given number of seconds. ONLY USE FOR DEBUGGING!
   */
  public function iWaitForSeconds($arg1) {
    sleep($arg1);
  }

  /**
   * @Given /^(?:|I )wait for AJAX loading to finish$/
   *
   * Wait for the jQuery AJAX loading to finish. ONLY USE FOR DEBUGGING!
   */
  public function iWaitForAJAX() {
    $this->getSession()->wait(5000, 'jQuery.active === 0');
  }

  /**
   * Override MinkContext::fixStepArgument().
   *
   * Make it possible to use [random].
   * If you want to use the previous random value [random:1].
   */
  protected function fixStepArgument($argument) {
    $argument = str_replace('\\"', '"', $argument);

    // Token replace the argument.
    static $random = array();
    for ($start = 0; ($start = strpos($argument, '[', $start)) !== FALSE; ) {
      $end = strpos($argument, ']', $start);
      if ($end === FALSE) {
        break;
      }
      $name = substr($argument, $start + 1, $end - $start - 1);
      if ($name == 'random') {
        $this->vars[$name] = Random::name(8);
        $random[] = $this->vars[$name];
      }
      // In order to test previous random values stored in the form,
      // suppport random:n, where n is the number or random's ago
      // to use, i.e., random:1 is the previous random value.
      elseif (substr($name, 0, 7) == 'random:') {
        $num = substr($name, 7);
        if (is_numeric($num) && $num <= count($random)) {
          $this->vars[$name] = $random[count($random) - $num];
        }
      }
      if (isset($this->vars[$name])) {
        $argument = substr_replace($argument, $this->vars[$name], $start, $end - $start + 1);
        $start += strlen($this->vars[$name]);
      }
      else {
        $start = $end + 1;
      }
    }

    return $argument;
  }
}
