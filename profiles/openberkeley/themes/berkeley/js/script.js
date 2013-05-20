/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

//Note: Drupal 7 includes jQuery 1.4.4 and jQuery UI 1.8.7.
//As of jQuery 1.7, the .on() method (http://api.jquery.com/on/) is preferred for event handling but not available in 1.4.4.

//If later version of jQuery is required, consider http://drupal.org/project/jquery_update or http://drupal.org/project/jqmulti

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {

  Drupal.behaviors.berkeley = {
    attach : function(context, settings) {

      //Temporary JS alert for IE8 and older during development
      /*
      if ($.browser.msie && parseInt($.browser.version) < 9){
        alert('Site under development. To view working site, please use IE9 or later, or a non-IE browser.');
      } */

      // Mobile magic - Adapted from Open Academy (http://chapterthree.com/openacademy/)
      $('#search-mobile-controller').click(function() {
        $(this).toggleClass('active');
        $('#search-mobile').toggleClass('mobile-show-search');
      });

      $('#menu-mobile-controller').click(function() {
        $(this).toggleClass('active');
        $('#main-menu-mobile').toggleClass('mobile-show-menu');
      });

      //Fix tab border glitch when using ajax on form
      $("#edit-berkeley-header-image").change(function() {
        $('ul.primary li').css('border-style','none');
      });

      //Quick Links click event handler
      $('#quick-links').click(function(event) {
        $('#quick-links-container').toggle(400, function() {
          $('#quick-links').toggleClass('hover');
        });
        event.preventDefault(); // Don't follow the link
        event.stopPropagation(); // Stop propagation

        //There are three scenarios where the Quick Links container may be closed...

        //Scenario 1: Toggle - Unbind html click event when closed by toggling
        $('html').unbind('click');

        //Scenario 2: Close Button - Event handler and unbind html click event once closed
        $('#quick-links-close').click(function() {
          $('#quick-links-container').hide(400);
          $('#quick-links').removeClass('hover');
          $('html').unbind('click'); //Unbind html click event once closed
        });

        //Scenario 3: Set up event listener so that clicking outside container will close
        $('html').click(function() {
          $('#quick-links-container').hide(400);
          $('#quick-links').removeClass('hover');
          $(this).unbind('click'); //Unbind click event once closed
        });

        // Stop propagation when clicking on container; otherwise will bubble up and close
        $('#quick-links-container').click(function(event){
          event.stopPropagation();
        });

      });

      /* Use these classes for custom collapse/expand functionality */
      $('.jquery-body').hide();
      $('.jquery-collapse').hide();
      $('.jquery-expand').show();

      $('.jquery-title').click(function(){
         if($(this).next().is(':visible')){
          $(this).next().hide('fast');
         }else{
          $(this).next().show('fast');
         }
      });

      $('.jquery-collapse').click(function(){
         $('.jquery-body').hide();
         $('.jquery-collapse').hide();
         $('.jquery-expand').show();
      });

      $('.jquery-expand').click(function(){
         $('.jquery-body').show();
         $('.jquery-expand').hide();
         $('.jquery-collapse').show();
      });

      /* Add new code here */

    }
  };

})(jQuery, Drupal, this, this.document);
