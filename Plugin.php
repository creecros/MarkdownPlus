<?php

namespace Kanboard\Plugin\EmojiSupport;

use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\EmojiSupport\Helper\EmojiTextHelper;


class Plugin extends Base

{
	public function initialize()
	{
        //HELPER
        $this->helper->register('text', '\Kanboard\Plugin\EmojiSupport\Helper\EmojiTextHelper');
        
        //CSS
        $this->hook->on('template:layout:css', array('template' => 'plugins/EmojiSupport/Assets/css/emojisupport.css'));
        
        //JS
        $this->hook->on('template:layout:js', array('template' => 'plugins/EmojiSupport/Assets/js/jquery.textcomplete.min.js'));
        $this->hook->on('template:layout:js', array('template' => 'plugins/EmojiSupport/Assets/js/emojisupport.js'));
        
        //CONFIG HOOK
        $this->template->hook->attach('template:config:application', 'emojiSupport:config/config');

	}
	
	public function getPluginName()	
	{ 		 
		return 'EmojiSupport'; 
	}

	public function getPluginAuthor() 
	{ 	 
		return 'Craig Crosby'; 
	}

	public function getPluginVersion() 
	{ 	 
		return '1.0.0'; 
	}

	public function getPluginDescription() 
	{ 
		return 'Emoji Support in Markdown for Kanboard'; 
	}

	public function getPluginHomepage() 
	{ 	 
		return 'https://github.com/creecros/EmojiSupport'; 
	}
}
