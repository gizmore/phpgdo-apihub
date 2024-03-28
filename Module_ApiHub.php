<?php
namespace GDO\ApiHub;

use GDO\Core\GDO_Module;
use GDO\Core\GDT_Secret;

final class Module_ApiHub extends GDO_Module
{

    public function getDependencies(): array
    {
        return [
            'Net',
        ];
    }

    public function getConfig(): array
    {
        return [
            GDT_Secret::make('apihub_apikey')
        ];
    }

    public function cfgApiKey(): ?string
    {
        return $this->getConfigVar('apihub_apikey');
    }

    public function onInstall(): void
    {
        $path = $this->filePath('secret.php');
        if ($secret = @include $path)
        {
            $this->saveConfigVar('apihub_apikey', $secret['api_key']);
        }
    }

}
