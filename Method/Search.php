<?php
namespace GDO\ApiHub\Method;

use GDO\ApiHub\MethodAPI;
use GDO\Core\GDO_ArgError;
use GDO\Core\GDT;
use GDO\Core\GDT_String;
use GDO\Form\GDT_AntiCSRF;
use GDO\Form\GDT_Form;
use GDO\Form\GDT_Submit;
use GDO\Net\HTTP;

final class Search extends MethodAPI
{

    public function isCLI(): bool
    {
        return true;
    }

    public function getCLITrigger(): string
    {
        return 'api.search';
    }

    protected function createForm(GDT_Form $form): void
    {
        $form->addFields(
            GDT_String::make('query')->notNull(),
            GDT_AntiCSRF::make(),
        );
        $form->actions()->addField(GDT_Submit::make());
    }

    /**
     * @throws GDO_ArgError
     */
    public function getQuery(): string
    {
        return $this->gdoParameterVar('query');
    }

    /**
     * @throws GDO_ArgError
     */
    public function formValidated(GDT_Form $form): GDT
    {
        $headers = $this->getAPIHeaders();
        $url = $this->getURL($this->getQuery());
        $res = HTTP::getFromURL($url, false, false, $headers);
        $res = @json_decode($res, true);
        if ($res)
        {
            print_r($res);
        }
        return $this->error('err_apihub');
    }

    protected function getAPIName(): string
    {
        // TODO: Implement getAPIName() method.
    }

    private function getURL(string $query): string
    {
        return sprintf('"https://google-web-search1.p.rapidapi.com/?query=%s&limit=5&related_keywords=false', urlencode($query));
    }
}
