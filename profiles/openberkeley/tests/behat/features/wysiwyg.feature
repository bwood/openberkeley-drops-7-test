Feature: Use rich text editor
  In order to format the content of my pages
  As a site builder
  I need to be able to use a WYSIWYG editor

  Background:
    Given I am logged in as a user with the "builder" role
      And Panopoly magic live previews are disabled
    When I visit "/node/add/panopoly-page"
      And I fill in the following:
        | Title                | Testing WYSIWYG |
        | body[und][0][format] | plain_text      |
        | body[und][0][value]  | Testing body    |
      And I select "panopoly_wysiwyg_text" from "body[und][0][format]"
      And I press "Save"
    Then I should see "Testing WYSIWYG" in the "Page title" region
      And I should see the link "Edit" in the "Tabs" region

  @api @javascript @headless
  Scenario: Make some text bold
    Given I click "Edit" in the "Tabs" region  
    When I "Italic" the text "Testing body" in the "body" field WYSIWYG editor
      And I press "Save"
      And I wait 1 seconds
      And I reload the page
    Then I should see "Testing body" in the "em" element 