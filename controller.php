<?php 
namespace Concrete\Package\CommonMarkdown;

use BlockType;
use Package;

class Controller extends Package
{
    protected $pkgHandle = 'common_markdown';
    protected $appVersionRequired = '5.7.5';
    protected $pkgVersion = '1.0.1';

    public function getPackageName()
    {
        return t("Common Markdown");
    }

    public function getPackageDescription()
    {
        return t("Markdown editor that supports the CommonMark spec.");
    }

    public function on_start()
    {
        require $this->getPackagePath() . '/vendor/autoload.php';
    }

    public function install()
    {
        if (version_compare(PHP_VERSION, '5.4', '<')) {
            throw new Exception(t("You need PHP 5.4 or higher to run this add-on."));
        }

        $pkg = parent::install();

        $this->installBlockTypes($pkg);
    }

    public function installBlockTypes($pkg)
    {
        if (!BlockType::getByHandle("common_markdown")) {
            BlockType::installBlockType('common_markdown', $pkg);
        }
    }
}
