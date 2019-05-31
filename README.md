[![Latest release](https://img.shields.io/github/release/creecros/EmojiSupport.svg)](https://github.com/creecros/EmojiSupport/releases)
![GitHub license](https://img.shields.io/github/license/Naereen/StrapDown.js.svg)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://github.com/creecros/EmojiSupport/graphs/contributors)
![Open Source Love](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)
![Downloads](https://img.shields.io/github/downloads/creecros/EmojiSupport/total.svg)

**:star: If you use it, you should star it on Github!**
*It's the least you can do for all the work put into it!*

# EmojiSupport

## Adds EmojiOne Shortcode and Unicode conversions to Markdown in Kanboard


_Converts :shortname: and Unicode to EmojiOne newschool emojis, or..._
_Converts :shortname: to unicode for oldschool emojis, so long as it passes through the markdown helper._

![image](https://user-images.githubusercontent.com/26339368/58675441-5a61db00-8322-11e9-9ea8-e6b5ffc31299.png)

**or**

![image](https://user-images.githubusercontent.com/26339368/58675471-7796a980-8322-11e9-8363-4ce64090df96.png)

:shortname: autocomplete included, will probably pop up on all textareas...

![image](https://user-images.githubusercontent.com/26339368/58675249-66996880-8321-11e9-9f57-6acebb45d3f5.png)

_Toggle for oldschool vs newschool emojis is located in `Settings > Application settings`_

![image](https://user-images.githubusercontent.com/26339368/58675183-289c4480-8321-11e9-86ed-2b58028b7127.png)

# Install

## Automatically

1.) If your Kanboard installation is configured to install from the app, simply find it in the plugins directory and choose install.

2.) Restart your server 


## Manually

1.) Download the latest versions supplied zip file, it should be named `EmojiSupport-x.xx.x.zip`
  - I advise not to install from source or master

![image](https://user-images.githubusercontent.com/26339368/58675566-eaa02000-8322-11e9-9466-85bcff17f320.png)

2.) Unzip to the plugins folder.
  - your folder structure should look like the following:
```
plugins
└── EmojiSupport            <= Plugin name
    ├── Assets    
    ├── Helper  
    ├── Template
    ├── vendor
    ├── LICENSE
    ├── Plugin.php   
    ├── README.md
    ├── composer.json
    └── composer.lock
```

3.) Restart your server
