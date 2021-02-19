<?php

namespace Concrete\Package\CommonMarkdown\Block\CommonMarkdown;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Editor\LinkAbstractor;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Package;

class Controller extends BlockController
{
    protected $btInterfaceWidth = "600";
    protected $btInterfaceHeight = "490";
    protected $btTable = "btCommonMarkdown";
    protected $btWrapperClass = 'ccm-ui';
    protected $btDefaultSet = "basic";
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;

    protected $content;

    public function getBlockTypeName()
    {
        return t('Markdown');
    }

    public function getBlockTypeDescription()
    {
        return t('Markdown editor that supports the CommonMark spec.');
    }

    public function view()
    {
        $this->content = LinkAbstractor::translateFrom($this->content);

        $this->set('content', $this->convertToHtml($this->content));
    }

    public function save($args)
    {
        $args['inlineHTML'] = isset($args['inlineHTML']) ? $args['inlineHTML'] : 0;

        parent::save($args);
    }

    /**
     * Convert Markdown to HTML.
     *
     * @param string $markdown
     *
     * @return string
     */
    protected function convertToHtml($markdown)
    {
        // Obtain a pre-configured Environment with all the CommonMark parsers/renderers ready-to-go
        $environment = Environment::createCommonMarkEnvironment();

        $config = ['safe' => (boolean) !$this->inlineHTML];

        // Create the converter
        $converter = new CommonMarkConverter($config, $environment);

        return $converter->convertToHtml($markdown);
    }
}
