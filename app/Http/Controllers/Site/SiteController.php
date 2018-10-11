<?php

namespace App\Http\Controllers\Site;

require '../vendor/' . 'autoload.php';

use App\Http\Controllers\Controller;

//use App\Http\Controllers\Site\Vars;

class SiteController extends Controller
{

    public function getNFe($CHAVE_DE_ACESSO)
    {
        include 'vars.php';
        $URL1 = 'http://danfe.br.com/api/nfe/captcha.json?apikey=' . $API_KEY;
        $data = file_get_contents($URL1);
        $json = json_decode($data);
        $KEY = $json->key;

        $URL2 = 'http://danfe.br.com/api/nfe/imagem.json?apikey=' . $API_KEY . '&key=' . $KEY;
        $data2 = file_get_contents($URL2);
        $json2 = json_decode($data2);
        $CAPTCHA_URL = $json2->captcha;
        $this->console_log($data);
        $this->console_log($json);
        $this->console_log($data2);
        $this->console_log($json2);
        $this->console_log($CAPTCHA_URL);

        $prompt_msg = 'Captcha:';
        $CAPTCHA = $this->prompt($prompt_msg);

        
        $URL3 = 'http://danfe.br.com/api/nfe/nfe_captcha.json?apikey=' . $API_KEY . '&key=' . $KEY . '&chave=' . $CHAVE_DE_ACESSO . '&captcha=' . $CAPTCHA;
        $this->console_log($URL3);
        $this->console_log($CAPTCHA);
        //$data3 = file_get_contents($URL3);
        //$this->console_log($data3);

        return $CAPTCHA_URL;

    }

    public function index()
    {
        include 'vars.php';

        $CAPTCHA_URL = $this->getNFe($chaveVilacinha);  

        //dd($myvar);
        return view('site.home.index', compact('texto1', 'CAPTCHA_URL'));
    }

    public function prompt($prompt_msg)
    {
        echo ("<script type='text/javascript'> var answer = prompt('" . $prompt_msg . "'); </script>");

        $answer = "<script type='text/javascript'> document.write(answer); </script>";
        return ($answer);
    }

    public function console_log($data)
    {
        echo '<script>';
        echo 'console.log(' . json_encode($data) . ')';
        echo '</script>';
    }

}
