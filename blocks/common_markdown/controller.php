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
    protected $btInterfaceHeight = "465";
    protected $btTable = "btCommonMarkdown";
    protected $btWrapperClass = 'ccm-ui';
    protected $btDefaultSet = "basic";
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;

    protected $content;

    public function getBlockTypeName()
    {
        return t("Markdown");
    }

    public function getBlockTypeDescription()
    {
        $p = Package::getByHandle('common_markdown');

        return $p->getPackageDescription();
    }

    public function view()
    {
        $this->content = LinkAbstractor::translateFrom($this->content);

        $this->set('content', $this->convertToHtml($this->content));
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

        // Enable HTML
        $config = ['safe' => false];

        // Create the converter
        $converter = new CommonMarkConverter($config, $environment);

        return $converter->convertToHtml($markdown);
    }
}
