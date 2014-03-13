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

  @api @headless
  Scenario: Format text in the editor
    When I click "Edit" in the "Tabs" region
      And I select the text in the WYSIWYG editor
      And I click the "Italic" button in the WYSIWYG editor
      And I press "Save"
      And I wait 1 seconds
    Then I should see "Testing body" in the "em" element in the "Boxton body" region

  @api @javascript
  Scenario: Add an image with format and alt text
    Given I click "Edit" in the "Tabs" region
      And I click in the WYSIWYG editor
    When I click the "Add media" button in the WYSIWYG editor
      And I switch to the frame "mediaBrowser"
      And I attach the file "panopoly.png" to "files[upload]"
      And I press "Next"
      And I press "Next"
    Then I should see a "#edit-submit" element
    When I wait 2 seconds
      And I press "Save"
      And I switch to the frame "mediaStyleSelector"
      And I select "Width 100" from "format"
      And I fill in "edit-field-file-image-alt-text-und-0-value" with "Sample alt text"
      And I click the fake "Submit" button
      And I switch out of all frames
      And I press "Save"
      And I wait 1 seconds
    Then I should see the "img" element in the "Boxton body" region
    
