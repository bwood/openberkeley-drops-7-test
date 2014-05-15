Feature: Subcontext is activated
In order to test aspects of my custom code
As a developer
I need to know if my subcontext is activated
 
  @disabled
  Scenario: User can get to backdoor
    Given I am on the homepage
      And the subcontext is active
    Then I should get a "200" HTTP response