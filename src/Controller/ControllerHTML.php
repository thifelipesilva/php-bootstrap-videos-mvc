<?php

namespace APP\Sk8play\Controller;

use Psr\Http\Server\RequestHandlerInterface;

abstract class ControllerHTML implements RequestHandlerInterface
{
    //constante privada
    private const TEMPLATE_PATH = __DIR__ . '/../../views/';

    //retorna o conteudo html
    protected function renderTemplate(string $templateName, array $context = []): string //$context sera o array de videos
    {
        
        extract($context);//Retorna o número de variáveis importadas com sucesso para o template

        ob_start(); //inicializando o output buffer

        //pelo fato de template_path nao ser uma constante global e sim da classe usamos o self -- semelhante ao bind(this) do js
        require_once self::TEMPLATE_PATH . $templateName . '.php';

        //$html= ob_get_contents();//conteudo do buffer
        //ob_clean();//limpa o buffer

        return $html = ob_get_clean(); //mostra o conteudo do buffer e limpa em seguida
    }
}