<?php

namespace Kanboard\Plugin\EmojiSupport;

use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\EmojiSupport\Helper\EmojiTextHelper;


class Plugin extends Base

{
	public function initialize()
	{
        //Helpers
        $this->helper->register('text', '\Kanboard\Plugin\EmojiSupport\Helper\EmojiTextHelper');
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
