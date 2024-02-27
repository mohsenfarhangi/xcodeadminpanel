<?php

namespace App\Http\Core\Theme;

use App\Http\Core\Adapters\Theme;

class Menu {
    // Menu config
    protected $items;

    // Current page path
    protected $path;

    // Default menu tag
    protected $parentTag = 'div';

    // Default menu item tag
    protected $itemTag = 'div';

    // Default icon visibility
    protected $displayIcons = true;

    // Hide root level icons
    protected $hideRootLevelIcons = false;

    // Menu registered callbacks
    protected $callbacks = array();

    // Default item link class
    protected $itemLinkClass = '';

    // Default icon type in menu config
    protected $iconType = 'svg';

    /**
     * protected Methods.
     *
     */
    protected function _generateItem($item, $level = 0) {
        $classes = array('menu-item');
        $attributes = array();

        // Overcome recursive infinite loop
        if ( $level > 10000 ) {
            return;
        }

        // Handle menu item visiblity with callback function
        if (isset($item['hide'])) {
            if (is_callable($item['hide'])) {
                $hide = call_user_func($item['hide'], $this, $item);
            } else {
                $hide = $item['hide'];
            }

            if ($hide === true) {
                return;
            }
        }

        if (isset($item['can'])) {
            if (is_array($item['can'])) {
                $can_count = 0;
                foreach ($item['can'] as $can) {
                    if ($this->_canUser($can))
                        $can_count++;
                }

                if ($can_count === 0) return;
            }
            else {
                if (!($this->_canUser($item['can'])))
                    return;
            }
        }

        if ( isset($item['sub']) && ($this->_matchParentItemByPath($item) === true)) {
            $classes[] = 'here show';
        }

        if ( isset($item['attributes']) && isset($item['attributes']['item']) ) {
            $attributes = $item['attributes']['item'];
        } elseif ( isset($item['attributes']) && isset($item['attributes']['link']) === false ) {
            $attributes = $item['attributes'];
        }

        if ( isset($item['classes']) && isset($item['classes']['item']) ) {
            $classes[] = $item['classes']['item'];
        }

        echo '<' . $this->itemTag . ' ' . Util::getHtmlAttributes($attributes) . Util::getHtmlClass($classes) . '>';

        if ( isset($item['custom']) ) {
            $this->_generateItemCustom($item);
        }

        if ( isset($item['content']) ) {
            $this->_generateItemContent($item);
        }

        if ( isset($item['title']) || isset($item['breadcrumb-title']) ) {
            $this->_generateItemLink($item);
        }

        if ( isset($item['heading']) ) {
            $this->_generateItemHeading($item);
        }

        if ( isset($item['sub']) ) {
            $this->_generateItemSub($item['sub'], $level++);
        }

        echo '</' . $this->itemTag . '>';
    }

    protected function _generateItemLink($item) {
        $classes = array('menu-link');
        $attributes = array();
        $tag = 'a';
        // Construct li ks attributes
        if ( isset($item['path']) ) {
            // Assign the page URL
            $attributes['href'] = Theme::getPageUrl($item['path']);

            // Handle open in new tab mode
            if (isset($item['new-tab']) && $item['new-tab'] === true) {
                $attributes['target'] = 'blank';
            }

            // Add special attribute for links to pro pages
            if (Theme::isFreeVersion() === true && Theme::isProPage($item['path']) === true) {
                $attributes['data-kt-page'] = 'pro';
            }
        } else {
            $tag = 'span';
        }

        if ( isset($item['attributes']) && isset($item['attributes']['link']) ) {
            $attributes = array_merge($attributes, $item['attributes']['link']);
        }

        if ( $this->_matchItemByPath($item) === true ) {
            $classes[] = 'active';
        }

        if (!empty($this->itemLinkClass)) {
            $classes[] = $this->itemLinkClass;
        }

        if ( isset($item['classes']) && isset($item['classes']['link']) ) {
            $classes[] = $item['classes']['link'];
        }

        echo '<' . $tag . Util::getHtmlClass($classes) .  Util::getHtmlAttributes($attributes) . '>';

        if ($this->displayIcons !== false) {
            $this->_generateItemLinkIcon($item);
        }

        $this->_generateItemLinkBullet($item);

        if ( isset($item['title']) ) {
            $this->_generateItemLinkTitle($item);
        }

        $this->_generateItemLinkBadge($item);

        if ( isset($item['sub']) && @$item['arrow'] !== false ) {
            $this->_generateItemLinkArrow($item);
        }

        echo '</' . $tag . '>';
    }

    protected function _generateItemLinkTitle($item) {
        $classes = array('menu-title');

        $item['title'] = __($item['title']);

        if ( isset($item['classes']) && isset($item['classes']['title']) ) {
            $classes[] = $item['classes']['title'];
        }

        if (!is_string($item['title']) && is_callable($item['title'])) {
            $item['title'] = call_user_func($item['title'], $item);
        }

        echo '<span ' . Util::getHtmlClass($classes) . '>';

        if ( isset($this->callbacks['title']) && is_callable($this->callbacks['title']) ) {
            echo call_user_func($this->callbacks['title'], $item, $item['title']);
        } else {
            echo $item['title'];
            // Append exclusive badge
            if (isset($item['path']) && Theme::isExclusivePage($item['path']) === true) {
                echo '<span class="badge badge-exclusive badge-light-success fw-bold fs-9 px-2 py-1 ms-1">Exclusive</span>';
            }

            // Append pro badge
            if (Theme::isFreeVersion()) {
                if ((isset($item['path']) && Theme::isProPage($item['path']) === true) || (isset($item['pro']) && $item['pro'] === true)) {
                    echo '<span class="badge badge-pro badge-light-danger fw-bold fs-9 px-2 py-1 ms-1">Pro</span>';
                }
            }
        }

        echo '</span>';
    }

    protected function _generateItemLinkIcon($item) {
        $classes = array('menu-icon');

        if ( isset($item['classes']) && isset($item['classes']['icon']) ) {
            $classes[] = $item['classes']['icon'];
        }

        if ( isset($item['icon']) ) {
            echo '<span ' . Util::getHtmlClass($classes) . '>';

            if (is_array($item['icon'])) {
                echo $item['icon'][$this->iconType];
            } else {
                echo $item['icon'];
            }

            echo '</span>';
        }
    }

    protected function _generateItemLinkBullet($item) {
        if (isset($item['icon']) === true && $this->displayIcons !== false) {
            return;
        }

        $classes = array('menu-bullet');

        if ( isset($item['classes']) && isset($item['classes']['bullet']) ) {
            $classes[] = $item['classes']['bullet'];
        }

        if ( isset($item['bullet']) ) {
            echo '<span ' . Util::getHtmlClass($classes) . '>';

            if ( isset($item['bullet'])) {
                echo $item['bullet'];
            }

            echo '</span>';
        }
    }

    protected function _generateItemLinkBadge($item) {
        $classes = array('menu-badge');

        if ( isset($item['classes']) && isset($item['classes']['badge']) ) {
            $classes[] = $item['classes']['badge'];
        }

        if ( isset($item['badge']) ) {
            echo '<span ' . Util::getHtmlClass($classes) . '>';
            echo $item['badge'];
            echo '</span>';
        }
    }

    protected function _generateItemLinkArrow($item) {
        $classes = array('menu-arrow');

        if ( isset($item['classes']['arrow']) ) {
            $classes[] = $item['classes']['arrow'];
        }

        echo '<span ' . Util::getHtmlClass($classes) . '>';
        echo '</span>';
    }

    protected function _generateItemSub($sub, $level) {
        $classes = array('menu-sub');

        if ( isset($sub['class']) ) {
            $classes[] = $sub['class'];
        }

        echo '<' . $this->parentTag . ' ' . Util::getHtmlClass($classes) . '>';

        if (isset($sub['view'])) {
            Theme::getView($sub['view']);
        } else {
            foreach ($sub['items'] as $item) {
                $this->_generateItem($item, $level++);
            }
        }

        echo '</' . $this->parentTag . '>';
    }

    protected function _generateItemHeading($item) {
        $classes = array('menu-content');

        if ( isset($item['heading']) ) {
            if ( isset($this->callbacks['heading']) && is_callable($this->callbacks['heading']) ) {
                echo call_user_func($this->callbacks['heading'], $item['heading']);
            } else {
                echo '<h3 ' . Util::getHtmlClass($classes) . '>';
                echo $item['heading'];
                echo '</h3>';
            }
        }
    }

    protected function _generateItemContent($item) {
        $classes = array('menu-content');

        if ( isset($item['classes']) && isset($item['classes']['content']) ) {
            $classes[] = $item['classes']['content'];
        }

        if ( isset($item['content']) ) {
            echo '<div ' . Util::getHtmlClass($classes) . '>';
            echo __($item['content']);
            echo '</div>';
        }
    }

    protected function _generateItemCustom($item) {
        if ( isset($item['custom']) ) {
            echo $item['custom'];
        }
    }

    protected function _matchParentItemByPath($item, $level = 0) {
        if ( $level > 1000 ) {
            return false;
        }

        if ( $this->_matchItemByPath($item) === true ) {
            return true;
        } else {
            if ( isset($item['sub']) && isset($item['sub']['items']) ) {
                foreach ( $item['sub']['items'] as $currentItem) {
                    if ( $this->_matchParentItemByPath($currentItem, $level++) === true) {
                        return true;
                    }
                }
            }

            return false;
        }
    }

    protected function _matchItemByPath($item) {
        if ( isset($item['path']) && ($this->path === $item['path'] || $this->path === $item['path'] . '/index') ) {
            return true;
        } else {
            return false;
        }
    }

    protected function _buildBreadcrumb($items, &$breadcrumb, $options, $level = 0) {
        if ( $level > 10000 ) {
            return false;
        }

        foreach ( $items as $item ) {
            $title = '';

            if (isset($item['breadcrumb-title'])) {
                $item['breadcrumb-title'] = __($item['breadcrumb-title']);
                $title = $item['breadcrumb-title'];
            } else if (isset($item['title'])) {
                $item['title'] = __($item['title']);
                if (!is_string($item['title']) && is_callable($item['title'])) {
                    $title = call_user_func($item['title'], $item);
                } else {
                    $title = $item['title'];
                }
            } else if (isset($item['heading'])) {
                $item['heading'] = __($item['heading']);
                $title = $item['heading'];
            }

            if ( isset($item['path']) && ($item['path'] === $this->path || $item['path'] . '/index' === $this->path)) {
                if (@$options['skip-active'] !== true) {
                    $breadcrumb[] = array(
                        'title' => $title,
                        'path' => isset($item['path']) ? $item['path'] : '',
                        'active' => true
                    );
                }

                return true;

            } else if ( isset($item['sub']) && isset($item['sub']['items']) ) {
                if ( $this->_buildBreadcrumb($item['sub']['items'], $breadcrumb, $options, $level++) === true) {
                    $breadcrumb[] = array(
                        'title' => $title,
                        'path' => isset($item['path']) ? $item['path'] : ( isset($item['alt-path']) ? $item['alt-path'] : ''),
                        'active' => false
                    );

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Public Methods.
     *
     */
    public function __construct($items, $path = '') {
        $this->items = $items;
        $this->path = $path;

        return $this;
    }

    /**
     * options: array('includeHomeLink' => boolean, 'homeLink' => array(), 'skipCurrentPage' => boolean)
     *
     */
    public function getBreadcrumb($options = array()) {
        $breadcrumb = array();

        //$includeHomeLink = true, $homeLink = null

        $this->_buildBreadcrumb($this->items, $breadcrumb, $options);

        $breadcrumb = array_reverse($breadcrumb, true);

        if ( !empty($breadcrumb)) {
            if ( isset($options['home']) ) {
                array_unshift($breadcrumb, $options['home']);
            } else {
                array_unshift($breadcrumb, array(
                    'title' => 'home',
                    'path' => route('dashboard'),
                    'active' => false
                ));
            }
        }

        return $breadcrumb;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function displayIcons($flag) {
        $this->displayIcons = $flag;
    }

    public function hideRootLevelIcons($flag) {
        $this->hideRootLevelIcons = $flag;
    }

    public function setItemTag($tagName) {
        $this->itemTag = $tagName;
    }

    public function setIconType($type) {
        $this->iconType = $type;
    }

    public function setItemLinkClass($class) {
        $this->itemLinkClass = $class;
    }

    public function addCallback($target, $callback) {
        if ( !is_string($callback) && is_callable($callback) ) {
            $this->callbacks[$target] = $callback;
        }
    }

    public function build() {
        foreach ($this->items as $item) {
            $this->_generateItem($item);
        }
    }

    protected function _canUser($role) {
        return auth()->user()->can($role);
    }
}
