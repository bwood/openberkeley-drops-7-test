<?php
/**
 * Berkeley Theme - page.tpl.php
 */
?>

<div id="topwrapper"></div>

<div id="page">

  <header id="header" role="banner">

  <!-- menu-and-search-mobile  -->
  <?php if ($site_name || $main_menu || $search_box): ?>

    <?php if ($site_name): ?>
          <div id="site-name-mobile" class="clearfix">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a>
          </div>
      <?php endif; ?>

    <div id="menu-and-search-mobile">


      <?php if ($search_box): ?>
        <div id="search-mobile-controller"><?php print t('Search'); ?></div>
        <div id="search-mobile"><?php print $search_box; ?></div>
      <?php endif; ?>

      <?php if ($main_menu): ?>
        <div id="menu-mobile-controller"><div id="menu-mobile-controller-inner"><?php print t('Menu'); ?></div></div>
        <div id="main-menu-mobile" class="menu">
          <div id="primary-wrapper" class="clearfix">
            <?php print theme('links', array('links' => $main_menu, 'attributes' => array('id' => 'primary', 'class' => array('links', 'clearfix', 'main-menu')))); ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
  <?php endif; ?> <!-- end menu-and-search-mobile -->

  <div id="berkeley">
    <?php print $berkeley; ?>
  </div>

  <div id="divider">
    <?php print $divider; ?>
  </div>

  <?php if ($logo): ?>
    <div id="logowrapper">
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
    </div>
  <?php endif; ?>

  <?php if ($site_name && $site_slogan): ?>
    <hgroup id="name-and-slogan" class="clearfix with-slogan">

      <!-- site slogan is being used for parent organization (optional) -->
      <h2 id="site-slogan"><?php print $site_slogan; ?></h2>

      <h1 id="site-name" class="with-slogan">
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
      </h1>

    </hgroup>

  <?php elseif ($site_name || $site_slogan): ?>
    <hgroup id="name-and-slogan" class="clearfix no-slogan">

      <!-- site slogan is being used for parent organization (optional) -->
      <?php if ($site_slogan): ?>
        <h2 id="site-slogan"><?php print $site_slogan; ?></h2>
      <?php endif; ?>

      <?php if ($site_name): ?>
        <h1 id="site-name" class="no-slogan">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
        </h1>
      <?php endif; ?>

    </hgroup>

  <?php endif; ?><!-- /#name-and-slogan -->

    <?php if ($secondary_menu): ?>
    <nav id="secondary-menu" role="navigation">
      <?php print theme('links__system_secondary_menu', array(
        'links' => $secondary_menu,
        'attributes' => array(
          'class' => array('links', 'inline', 'clearfix'),
        ),
        'heading' => array(
          'text' => $secondary_menu_heading,
          'level' => 'h2',
          'class' => array('element-invisible'),
        ),
      )); ?>
    </nav>
  <?php endif; ?>

  <?php if (theme_get_setting('include_quick_links')): ?>

    <?php
      // Render the Quick Links region to see if there's anything in it.
      $quick_links  = render($page['quick_links']);
    ?>

    <?php if ($quick_links): ?>
      <div id="quick-links-widget">
        <?php if (theme_get_setting('quicklinks_link')): ?>
          <?php print $quicklinks_link; ?>
        <?php else: ?>
          <a href="#" id="quick-links">Quick Links</a>
        <?php endif; ?>
        <div id="quick-links-container">
          <div class="quick-links-inner clearfix">
            <?php print $quick_links; ?>
            <a id="quick-links-close" href="#"></a>
          </div>
        </div>
      </div> <!-- /#quick-links -->
    <?php endif; ?>
  <?php endif; ?>

  <?php if ($search_box): ?>
    <div id="search" class="clearfix">
      <?php print $search_box; ?>
    </div>
  <?php endif; ?>

  </header>   <!-- /#header -->

  <div id="main">

    <div id="content" class="column" role="main">
      <?php print render($page['highlighted']); ?>
      <?php print $breadcrumb; ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div><!-- /#content -->

    <div id="navigation">

      <?php if (theme_get_setting('main_menu_nice_menus') && module_exists('nice_menus')): ?>
      <nav id="main-menu" role="navigation">
        <?php
          print theme('nice_menus_main_menu', array(
            'direction' => 'down',
            'depth' => theme_get_setting('nice_menus_depth'),
          )); ?>
      </nav>

      <?php elseif ($main_menu): ?>
        <nav id="main-menu" role="navigation">
          <?php
          print theme('links__system_main_menu', array(
            'links' => $main_menu,
            'attributes' => array(
              'class' => array('links', 'inline', 'clearfix'),
            ),
            'heading' => array(
              'text' => t('Main menu'),
              'level' => 'h2',
              'class' => array('element-invisible'),
            ),
          )); ?>
        </nav>
      <?php endif; ?>

    </div><!-- /#navigation -->

    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second): ?>
      <aside class="sidebars">
        <?php print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      </aside><!-- /.sidebars -->
    <?php endif; ?>

    <?php if (theme_get_setting('sharing_addthis') && $addthis): ?>
      <div id="add-this">
        <?php print $addthis; ?>
      </div>
    <?php endif; ?><!-- /#addthis -->

  </div><!-- /#main -->

  </div><!-- /#page -->

  <div id="bottomwrapper">
    <?php if ($page['footer_first'] || $page['footer_second'] || $page['footer_third'] || $page['footer_fourth'] || $page['footer'] || $include_social): ?>
    <div id="footerwrapper" class="clearfix">

      <?php if ($page['footer_first'] || $page['footer_second'] || $page['footer_third'] || $page['footer_fourth']): ?>
        <div id="footer-menus" class="clearfix">
          <?php if ($page['footer_first']): ?>
          <div class="footer-first"><?php print render($page['footer_first']); ?></div>
          <?php endif; ?>
          <?php if ($page['footer_second']): ?>
          <div class="footer-next"><?php print render($page['footer_second']); ?></div>
          <?php endif; ?>
          <?php if ($page['footer_third']): ?>
          <div class="footer-next"><?php print render($page['footer_third']); ?></div>
          <?php endif; ?>
          <?php if ($page['footer_fourth']): ?>
          <div class="footer-next"><?php print render($page['footer_fourth']); ?></div>
          <?php endif; ?>
        </div>
      <?php endif; ?><!-- /.footer-menus -->

    <?php if ($page['footer'] || $include_social) : ?>
      <div id="footer-social" class="clearfix">
        <?php print render($page['footer']); ?>

        <?php if ($include_social && $social_links): ?>
          <div id="social-links">
            <h3 class="follow-us"><?php print t('Follow us on:'); ?></h3>
            <div class="social-link-icons">
              <?php print $social_links; ?>
            </div>
          </div>
        <?php endif; ?>

      </div>

    <?php endif; ?><!-- /#footer-social -->

    </div>
    <?php endif; ?><!-- /#footer-wrapper -->

    <div id="seal-copyright" class="clearfix">
      <div id="ucbseal">
        <?php print $ucbseal; ?>
      </div>

      <div id="copyright">
        <?php print $copyright; ?>
      </div>

      <?php if ($secondary_menu): ?>
        <div id="secondary-menu-mobile" class="menu">
          <div id="secondary-wrapper" class="clearfix">
            <?php print theme('links', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary', 'class' => array('links', 'clearfix', 'secondary-menu')))); ?>
          </div>
        </div>
      <?php endif; ?>

    </div>

  </div>



<?php print render($page['bottom']); ?>
