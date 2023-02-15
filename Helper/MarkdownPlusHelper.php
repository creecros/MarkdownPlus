<?php

namespace Kanboard\Plugin\MarkdownPlus\Helper;

require __DIR__.'/../vendor/autoload.php';

require __DIR__.'/../vendor/joypixels/emoji-toolkit/lib/php/autoload.php';

use Kanboard\Plugin\MarkdownPlus\Helper\CoreMarkdown;
use Kanboard\Core\Base;
use JoyPixels\Client;
use JoyPixels\RuleSet;
use ParsedownCheckbox;
use ParsedownExtra;


/**
 * Text Helpers
 *
 * @package helper
 * @author  Frederic Guillot
 * @additions Craig Crosby
 */
class MarkdownPlusHelper extends Base
{
    /**
     * HTML escaping
     *
     * @param  string   $value    Value to escape
     * @return string
     */
    public function e($value)
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8', false);
    }

    /**
     * Join with HTML escaping
     *
     * @param  $glue
     * @param  array $list
     * @return string
     */
    public function implode($glue, array $list)
    {
        array_walk($list, function (&$value) { $value = htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8', false); });
        return implode($glue, $list);
    }

    /**
     * Markdown transformation
     *
     * @param  string    $text
     * @param  boolean   $isPublicLink
     * @return string
     */
    public function markdown($text, $isPublicLink = false)
    {
        $emoji = new Client(new Ruleset());
        $parsecheckbox = new CoreMarkdown($this->container, $isPublicLink);
        //$parsecheckbox->setMarkupEscaped(MARKDOWN_ESCAPE_HTML);
        if ($this->configModel->get('unicode_shortcode', '2') == 1) 
            return $emoji->shortnameToUnicode($parsecheckbox->text($text));
        else
            return $emoji->toImage($parsecheckbox->text($text));
    }

    /**
     * Escape Markdown text that need to be stored in HTML attribute
     *
     * @access public
     * @param  string $text
     * @return mixed
     */
    public function markdownAttribute($text)
    {
        return htmlentities($this->markdown($text) ?? '', ENT_QUOTES, 'UTF-8');
    }

    /**
     * Format a file size
     *
     * @param  integer  $size        Size in bytes
     * @param  integer  $precision   Precision
     * @return string
     */
    public function bytes($size, $precision = 2)
    {
        if ($size == 0) {
            return 0;
        }

        $base = log($size) / log(1024);
        $suffixes = array('', 'k', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision).$suffixes[(int)floor($base)];
    }

    /**
     * Get the number of bytes from PHP size
     *
     * @param  integer  $val        PHP size (example: 2M)
     * @return integer
     */
    public function phpToBytes($val)
    {
        $size = (int) substr($val, 0, -1);
        $last = strtolower(substr($val, -1));

        switch ($last) {
            case 'g':
                $size *= 1024;
            case 'm':
                $size *= 1024;
            case 'k':
                $size *= 1024;
        }

        return $size;
    }

    /**
     * Return true if needle is contained in the haystack
     *
     * @param  string   $haystack   Haystack
     * @param  string   $needle     Needle
     * @return boolean
     */
    public function contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }

    /**
     * Return a value from a dictionary
     *
     * @param  mixed   $id              Key
     * @param  array   $listing         Dictionary
     * @param  string  $default_value   Value displayed when the key doesn't exists
     * @return string
     */
    public function in($id, array $listing, $default_value = '?')
    {
        if (isset($listing[$id])) {
            return $this->helper->text->e($listing[$id]);
        }

        return $default_value;
    }
}