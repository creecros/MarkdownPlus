<?php

namespace Kanboard\Plugin\MarkdownPlus;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base

{
    public function initialize()
    {
        //HELPER
        $this->helper->register('text', '\Kanboard\Plugin\MarkdownPlus\Helper\MarkdownPlusHelper');

        //CSS
        $this->hook->on('template:layout:css', array('template' => 'plugins/MarkdownPlus/Assets/css/markdownplus.css'));

        //JS
        $this->hook->on('template:layout:js', array('template' => 'plugins/MarkdownPlus/Assets/js/jquery.textcomplete.min.js'));
        $this->hook->on('template:layout:js', array('template' => 'plugins/MarkdownPlus/Assets/js/markdownplus.js'));

        //CONFIG HOOK
        $this->template->hook->attach('template:config:application', 'markdownPlus:config/config');

        //checkbox handling
        $this->hook->on('template:layout:js', array('template' => 'plugins/MarkdownPlus/Assets/js/checkbox.js'));
        $this->route->addRoute('MarkdownPlus/Checkbox', 'CheckboxController', 'toggle', 'MarkdownPlus');
    }

    public function getPluginName()
    {
        return 'MarkdownPlus';
    }

    public function getPluginAuthor()
    {
        return 'Craig Crosby & Tomas Dittmann';
    }

    public function getPluginVersion()
    {
        return '1.1.4';
    }

    public function getPluginDescription()
    {
        return 'Improved Markdown, with check boxes, emoji shortcode, inline html, etc...';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/creecros/MarkdownPlus';
    }
}
