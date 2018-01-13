<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$layout = $app->input->getCmd('layout', '');
$task = $app->input->getCmd('task', '');
$itemid = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if ($task === 'edit' || $layout === 'form') {
    $fullWidth = 1;
} else {
    $fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add template js
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'font-awesome-4.7.0/css/font-awesome.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'animate.css-master/animate.css', array('version' => 'auto', 'relative' => true));

// Use of Google Font
if ($this->params->get('googleFont')) {
    JHtml::_('stylesheet', '//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
    $this->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}


// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));

// Check for a custom js file
JHtml::_('script', 'user.js', array('version' => 'auto', 'relative' => true));

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
$position7ModuleCount = $this->countModules('position-7');
$position8ModuleCount = $this->countModules('position-8');

if ($position7ModuleCount && $position8ModuleCount) {
    $span = 'span6';
} elseif ($position7ModuleCount && !$position8ModuleCount) {
    $span = 'span9';
} elseif (!$position7ModuleCount && $position8ModuleCount) {
    $span = 'span9';
} else {
    $span = 'span12';
}

// Logo file or site title param
if ($this->params->get('logoFile')) {
    $logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
} elseif ($this->params->get('sitetitle')) {
    $logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
} else {
    $logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <jdoc:include type="head"/>
    <script type="text/javascript">
        $(document).ready(function(){
            $("label").click(function(){
                $("#logo").addClass("hide");
            });
        });
        function switchspoiler(id) {
            if(id == 1){
                if (document.getElementById("shopMenu").style.display == "none") {
                    document.getElementById("shopMenu").style.display = "";

                }
                else {
                    document.getElementById("shopMenu").style.display = "none";

                }
            }
            if(id == 2){
                if (document.getElementById("galerieMenu").style.display == "none") {
                    document.getElementById("galerieMenu").style.display = "";
                }
                else {
                    document.getElementById("galerieMenu").style.display = "none";
                }
            }
            if(id == 3){
                if (document.getElementById("logo").style.display == "none") {
                    document.getElementById("logo").style.display = "";
                }
                else {
                    document.getElementById("logo").style.display = "none";
                }
            }

        }
    </script>
</head>
<body class="site <?php echo $option
    . ' view-' . $view
    . ($layout ? ' layout-' . $layout : ' no-layout')
    . ($task ? ' task-' . $task : ' no-task')
    . ($itemid ? ' itemid-' . $itemid : '')
    . ($params->get('fluidContainer') ? ' fluid' : '');
echo($this->direction === 'rtl' ? ' rtl' : '');
?>">
<!-- Body -->
<div class="body" id="top">
    <div class="container<?php echo($params->get('fluidContainer') ? '-fluid' : ''); ?>">
        <?php if ($this->countModules('top')) : ?>
            <!--            Header -- Menu   -->
            <header>
                <div id="menu" class="animated fadeIn">
                    <label for="open-menu" class="open-menu-label"  >  <li class="fa fa-bars" aria-hidden="true" ></li></label>
                    <input type="checkbox" id="open-menu" onclick="switchspoiler(3)">
                    <nav class="navigation" role="navigation">
                        <ul>
                            <li>
                                <jdoc:include type="modules" name="top" style="none"/>
                            </li>
                        </ul>
                    </nav>
                    <div id="icons">
                        <ul>
                            <li class="fa fa-shopping-cart" aria-hidden="true"></li>
                            <li class="warenkorbMenu"><jdoc:include type="modules" name="position-3" style="xhtml"/></li>
                            <a href="https://facebook.com/Golschmiede-Nordstern-1681590748570879"><li class="fa fa-facebook" aria-hidden="true"></li></a>
                            <a href="https://www.instagram.com/goldschmiede_nordstern/"><li class="fa fa-instagram" aria-hidden="true"></li></a>

                        </ul>
                    </div>
                </div>
                <img id="headerImage" src="images/logo.jpg" alt="Armreif" / >
                <img id="logo" class="logo animated fadeIn" src="templates/goldschmied/images/logo.png" alt="Armreif" />
                <div class="container"><a class="toShopButton " href="index.php?Itemid=238">Online Shop</a>
                </div>
            </header>
        <?php endif; ?>
        <jdoc:include type="modules" name="banner" style="xhtml"/>
        <div class="row-fluid">
            <?php if ($position8ModuleCount) : ?>
                <!-- Begin Sidebar -->
                <div id="sidebar" class="span3">
                    <div class="sidebar-nav">
                        <jdoc:include type="modules" name="position-8" style="xhtml"/>
                    </div>
                </div>
                <!-- End Sidebar -->
            <?php endif; ?>
            <main id="content" role="main" class="<?php echo $span; ?>">
                <!-- Begin Content -->
<!--                <jdoc:include type="modules" name="position-3" style="xhtml"/>-->
                <jdoc:include type="message"/>
                <jdoc:include type="component"/>
                <div class="clearfix"></div>
                <jdoc:include type="modules" name="position-2" style="none"/>
                <!-- End Content -->
            </main>
            <?php if ($position7ModuleCount) : ?>
                <div id="aside" class="span3">
                    <!-- Begin Right Sidebar -->
                    <jdoc:include type="modules" name="position-7" style="well"/>
                    <!-- End Right Sidebar -->
                </div>
            <?php endif; ?>
        </div>
        <a href="#0" class="cd-top"><i class="fa fa-angle-up" aria-hidden="true"></i>
        </a>
    </div>
</div>
<!-- Footer -->
<footer class="footer" role="contentinfo">
    <div class="container<?php echo($params->get('fluidContainer') ? '-fluid' : ''); ?>">
        <hr/>
        <jdoc:include type="modules" name="footer" style="none"/>
            &copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
    </div>
</footer>
<jdoc:include type="modules" name="debug" style="none"/>
</body>
</html>

