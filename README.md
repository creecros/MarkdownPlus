## Checkout our latest project
[![](https://raw.githubusercontent.com/docpht/docpht/master/public/assets/img/logo.png)](https://github.com/docpht/docpht)

- With [DocPHT](https://github.com/docpht/docpht) you can take notes and quickly document anything and without the use of any database.
-----------
[![Latest release](https://img.shields.io/github/release/creecros/MarkdownPlus.svg)](https://github.com/creecros/MarkdownPlus/releases)
![GitHub license](https://img.shields.io/github/license/Naereen/StrapDown.js.svg)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://github.com/creecros/MarkdownPlus/graphs/contributors)
![Open Source Love](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)
![Downloads](https://img.shields.io/github/downloads/creecros/MarkdownPlus/total.svg)

**:star: If you use it, you should star it on Github!**
*It's the least you can do for all the work put into it!*

# MarkdownPlus

**Plugin Author:** _[creecros](https://github.com/creecros)_

## Adds EmojiOne Shortcode and Unicode conversions to Markdown in Kanboard

- _Converts :shortname: and Unicode to EmojiOne newschool emojis, or..._

- _Converts :shortname: to unicode for oldschool emojis, so long as it passes through the markdown helper._

![image](https://user-images.githubusercontent.com/26339368/58675441-5a61db00-8322-11e9-9ea8-e6b5ffc31299.png)

**or**

![image](https://user-images.githubusercontent.com/26339368/58675471-7796a980-8322-11e9-8363-4ce64090df96.png)

- _:shortname: autocomplete included, will probably pop up on all textareas...**(may not work on older version of kanboard)**_

![image](https://user-images.githubusercontent.com/26339368/58675249-66996880-8321-11e9-9f57-6acebb45d3f5.png)

- _Toggle for oldschool vs newschool emojis is located in `Settings > Application settings`_

![image](https://user-images.githubusercontent.com/26339368/58675183-289c4480-8321-11e9-86ed-2b58028b7127.png)

## Adds Check box conversion Markdown in Kanboard

_from_ 

![image](https://user-images.githubusercontent.com/26339368/58710361-21f5e780-838a-11e9-8c3f-ff6f9b3c8dae.png)

_to_

![image](https://user-images.githubusercontent.com/26339368/58710411-4356d380-838a-11e9-8288-1c89686810b3.png)

## Inline HTML conversion in Markdown in Kanboard

_from_

![image](https://user-images.githubusercontent.com/26339368/58710512-78632600-838a-11e9-8c47-da05f639f162.png)

_to_

![image](https://user-images.githubusercontent.com/26339368/58710544-887b0580-838a-11e9-8c06-a449cbfc82a3.png)

## Other Markdown Extra support (no guarantees)

https://michelf.ca/projects/php-markdown/extra/

# Install

**Kanboard versions tested down to 1.0.43, :shortcode: autocomplete will not function on older version.**

## Automatically

1.) If your Kanboard installation is configured to install from the app, simply find it in the plugins directory and choose install.

2.) Restart your server 


## Manually

1.) Download the latest versions supplied zip file, it should be named `MarkdownPlus-x.xx.x.zip`
  - I advise not to install from source or master

![image](https://user-images.githubusercontent.com/26339368/58711319-45ba2d00-838c-11e9-9d07-71a526ba5b74.png)

2.) Unzip to the plugins folder.
  - your folder structure should look like the following:
```
plugins
└── MarkdownPlus            <= Plugin name
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
