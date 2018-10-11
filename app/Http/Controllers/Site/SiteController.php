<?php

namespace App\Http\Controllers\Site;

require '../vendor/' . 'autoload.php';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    protected $KEY;


    public function getCaptcha($CHAVE_DE_ACESSO)
    {
        include 'vars.php';
        $URL1 = 'http://danfe.br.com/api/nfe/captcha.json?apikey=' . $API_KEY;
        $data = file_get_contents($URL1);
        $json = json_decode($data);
        $this->KEY = $json->key;
        $URL2 = 'http://danfe.br.com/api/nfe/imagem.json?apikey=' . $API_KEY . '&key=' . $this->KEY;
        $data2 = file_get_contents($URL2);
        $json2 = json_decode($data2);
        $CAPTCHA_URL = $json2->captcha;
        
        // $this->console_log($data);
        // $this->console_log($json);
        // $this->console_log($data2);
        // $this->console_log($json2);
        // $this->console_log($CAPTCHA_URL);
        return $CAPTCHA_URL;

    }

    public function index()
    {
        include 'vars.php';

        $CAPTCHA_URL = $this->getCaptcha($chaveAcesso);
        $chave = $this->KEY;
        //dd($myvar);
        return view('site.home.index', compact('texto1', 'CAPTCHA_URL', 'chave'));
    }

    public function form(Request $request)
    {
        include 'vars.php';
        //dd($request->all());
        $this->getNFe($request->captcha, $chaveAcesso, $request->key);
        
    }

    public function getNFe($CAPTCHA, $CHAVE_DE_ACESSO, $KEY)
    {
        include 'vars.php';
        $URL3 = 'http://danfe.br.com/api/nfe/nfe_captcha.json?apikey=' . $API_KEY . '&key=' . $KEY . '&chave=' . $CHAVE_DE_ACESSO . '&captcha=' . $CAPTCHA;
        
        $this->console_log($URL3);
        $this->console_log($CAPTCHA);
        $this->console_log($KEY);
        $data3 = file_get_contents($URL3);
        $json = json_decode($data3);
        $this->console_log($json);
        $arq_xml = $json->xml;
        $xml_string = file_get_contents($arq_xml);
        $this->console_log($arq_xml);

        
        $xml = simplexml_load_file($arq_xml);
        $this->console_log(getType($xml));
        $this->console_log($xml);
        //$temp = $xml->NFe->infNFe->total->ICMSTot->vBC; // recupera o valor da nota
        //$this->console_log((string) $temp);
        //print_r((string) $temp); //obtem o valor da nota em string
    }

    public function console_log($data)
    {
        echo '<script>';
        echo 'console.log(' . json_encode($data) . ')';
        echo '</script>';
    }

}
