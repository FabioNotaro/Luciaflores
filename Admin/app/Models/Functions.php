<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Functions extends Model {

    // public static function getConfigs(){
    //     $res        = [];
    //     $allConfigs = Cache::remember('configs', 1800, function(){
    //         return Configuracoes::where('session', 1)->get();
    //     });
    //     if($allConfigs):
    //         foreach($allConfigs as $ddConfig):
    //             $res[$ddConfig->prefixo][$ddConfig->chave] = $ddConfig->valor;
    //         endforeach;
    //     endif;
    //     return $res;
    // }

    public static function searchString($string, $search){
        return (strpos($string, $search) !== false) ? true : false;
    }

    public static function namescape($string){
        $string = mb_strtolower($string);
        $string = str_replace('-', '_', $string);
        $string = explode('_', $string);
        $string = array_map('ucfirst', $string);
        $string = implode('', $string);
        return $string;
    }

    public static function replaceController($string, $dados){

        $controller = [];

        switch($string):
            default:
                $controller['usuario']    = 'equipe';
                $controller['publicacao'] = 'blog';
                $controller['area']       = 'areas-atuacao';
            break;
        endswitch;

        return isset($controller[$string]) ? $controller[$string] : $string;
    }

    public static function getController($string, $replace = false, $dados = false, $grupo = ''){
        $grupo  = self::namescape($grupo);
        $string = str_replace(['.xml', '.html', '.php', '.txt'], '', $string);
        $string = $replace ? self::replaceController($string, $dados) : $string;
        $string = self::namescape($string);
        $string = !empty($grupo) ? "{$grupo}\\{$string}" : $string;
        $string = "App\\Http\\Controllers\\{$string}";
        return $string;
    }

    public static function linksAlt($string){
        $res[] = $string;
        $res[] = substr($string, -1) == '/' ? substr_replace($string, '', -1) : "{$string}/";
        $res[] = trim(str_replace(['--', '---'], '-', $string), " \-");
        return $res;
    }

    public static function validarCpf($string){
        $cpf = preg_replace('/[^0-9]/is', '', $string);
        if(strlen($cpf) != 11):
            return false;
        endif;
        if(preg_match('/(\d)\1{10}/', $cpf)):
            return false;
        endif;
        for($t = 9; $t < 11; $t++):
            for($d = 0, $c = 0; $c < $t; $c++):
                $d += $cpf[$c] * (($t + 1) - $c);
            endfor;
            $d = ((10 * $d) % 11) % 10;
            if($cpf[$c] != $d):
                return false;
            endif;
        endfor;
        return true;
    }

    public static function ip(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])):
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else:
            $ip = $_SERVER['REMOTE_ADDR'];
        endif;
        return $ip;
    }

    public static function mask($mask, $string){
        $string = str_replace(' ', '', $string);
        $return = '';
        $k      = 0;
        for($i = 0; $i <= strlen($mask)-1; $i++):
            if($mask[$i] == '#'):
                if(isset($string[$k])):
                    $return .= $string[$k++];
                endif;
            else:
                if(isset($mask[$i])):
                    $return .= $mask[$i];
                endif;
            endif;
        endfor;
        return $return;
    }

    public static function limitString($string, $length, $limiter = '...'){
        return mb_strlen($string) > $length ? mb_substr($string, 0, $length).$limiter : $string;
    }

    public static function limpaNumero($numero, $permitir = '', $replace = '') {
        return preg_replace("/[^0-9{$permitir}]/", $replace, $numero);
    }

    public static function formataNome($string, $tipo = '') {
        $exception = ['do', 'dos', 'da', 'das', 'de', 'e', 'na', 'no', 'em', 'a', 'o', 'os', 'as', 'ao'];
        $uppercase = ['(OAB/RS'];
        $array     = explode(' ', mb_strtolower($string));
        $out       = '';
        foreach($array as $item):
            $out .= (in_array(mb_strtoupper($item), $uppercase) ? mb_strtoupper($item) : (in_array($item, $exception) ? $item : ucfirst($item))).' ';
        endforeach;
        $out = trim($out);
        switch($tipo):
            case 'sobrenome':
                $nome = explode(' ', $out);
                $out  = count($nome) > 1 ? current($nome).' '.end($nome) : current($nome);
            break;
            case 'primeiro':
                $nome = explode(' ', $out);
                $out  = current($nome);
            break;
            case 'primeiro-negrito':
                $nome  = explode(' ', $out);
                $count = 1;
                foreach($nome as $chave => $valor):
                    $nome[$chave] = $count == 1 ? "<b>{$valor}</b>" : $valor;
                    $count++;
                endforeach;
                $out = implode(' ', $nome);
            break;
        endswitch;
        return $out;
    }

    public static function buscaArray($arrBusca, $string){
        if(is_array($arrBusca)):
            foreach($arrBusca as $busca):
                if(preg_match("/{$busca}/", $string)):
                    return true;
                endif;
            endforeach;
        endif;
        return false;
    }

    public static function numeroWhatsapp($extenso = false){
        $configs    = self::getConfigs();
        $numero     = $configs['geral']['whatsapp-organico'];
        $origem     = Session::get('origem');
        $gclid      = Session::get('parametros.gclid');
        $utm_medium = Session::get('parametros.utm_medium');

        if(!empty($gclid)):
            $numero = $configs['geral']['whatsapp-impulsionado'];
        elseif((self::buscaArray(['google', 'facebook', 'instagram', 'youtube', 'linkedin', 'yahoo', 'bing'], $origem) || $utm_medium == 'email')):
            $numero = $configs['geral']['whatsapp-impulsionado'];
        endif;

        return $extenso ? $numero : self::limpaNumero($numero);
    }

    public static function getExtensao($string){
        $arr = explode('.', $string);
        $ext = end($arr);
        return $ext;
    }

    public static function formataData($data, $hora = false){
        $res   = '';
        $data  = strtotime($data);
        $hoje  = strtotime(date('Y-m-d'));
        $ontem = strtotime(date('Y-m-d').' -1 day');
        if($data == $hoje):
            $res = 'Hoje';
        elseif($data == $ontem):
            $res = 'Ontem';
        else:
            $res = date('d/m/Y', $data);
        endif;
        if($hora):
            $res .= ' às '.date('H:i', $data);
        endif;
        return $res;
    }

    public static function tempoLeitura($string){
        $count = str_word_count(strip_tags($string));
        $min   = floor($count / 200);
        return $min <= 1 ? '1 minuto' : "{$min} minutos";
    }

    public static function objectToArray($object){
        return json_decode(json_encode($object), true);
    }

    public static function fotoUsuario($usuario, $perfil = false){
        $foto = $perfil ? (!empty($usuario->foto_perfil) ? $usuario->foto_perfil : $usuario->foto) : $usuario->foto;
        return !empty($foto) ? (config('app.uploads_crm_url').'usuarios/'.$foto) : url('assets/images/icons/user.svg');
    }

    public static function calculaIdade($data){
        $arrData = preg_match("/-/", $data) ? explode('-', $data) : array_reverse(explode('/', $data));
        $dia = $arrData[2];
        $mes = $arrData[1];
        $ano = $arrData[0];
        $diaHoje = date('d');
        $mesHoje = date('m');
        $anoHoje = date('Y');
        return ($mesHoje >= $mes && $diaHoje >= $dia) ? $anoHoje - $ano : (($anoHoje - $ano) - 1);
    }

    public static function formataValor($valor, $decimais = 2, $ignorarErro = true){
        if($ignorarErro && !is_numeric($valor)):
            $valor = 0;
        endif;
        return number_format($valor, $decimais, ',', '.');
    }

    public static function trataCampoValor($valor){
        return str_replace(['.', ','], ['', '.'], $valor);
    }

    public static function youTubeCode($url){
        if(filter_var($url, FILTER_VALIDATE_URL)):
            $url = explode('watch?v=', $url);
            $url = explode('&', $url[1]);
            $url = $url[0];
        endif;
        return $url;
    }

    public static function replaceBlog($conteudo, $shortcode = ''){
        $conteudo = str_replace('src="../../../public/uploads/', 'src="'.config('app.uploads_url'), $conteudo);
        $conteudo = str_replace("src='../../../public/uploads/", "src='".config('app.uploads_url'), $conteudo);
        $conteudo = str_replace('href="../../../public/uploads/', 'href="'.config('app.uploads_url'), $conteudo);
        $conteudo = str_replace("href='../../../public/uploads/", "href='".config('app.uploads_url'), $conteudo);
        $conteudo = str_replace('href="../../public/uploads/', 'href="'.config('app.uploads_url'), $conteudo);
        $conteudo = str_replace("href='../../public/uploads/", "href='".config('app.uploads_url'), $conteudo);
        if(!empty($shortcode)):
            $conteudo = str_replace('{shortcode}', $shortcode, $conteudo);
        endif;
        return $conteudo;
    }

    public static function enviarApi($url, $method, $fields = [], $dominio = ''){

        $res      = [];
        if(!$dominio):
            $url = filter_var($url, FILTER_VALIDATE_URL) ? $url : config('app.crm_url')."/{$url}";
        else:
            $url = filter_var($url, FILTER_VALIDATE_URL) ? $url : $dominio."/{$url}";
        endif;
        $client   = new \GuzzleHttp\Client();
        $response = $client->request($method, $url, ['form_params' => $fields]);

        $res['headers']    = $response->getHeaders();
        $res['statusCode'] = $response->getStatusCode();
        $res['body']       = $response->getBody();

        return $res;
    }

    public static function estadoUF($nome){

        $arrEstadosUF = array(
            'AC'=>'Acre',
            'AL'=>'Alagoas',
            'AP'=>'Amapá',
            'AM'=>'Amazonas',
            'BA'=>'Bahia',
            'CE'=>'Ceará',
            'DF'=>'Distrito Federal',
            'ES'=>'Espírito Santo',
            'GO'=>'Goiás',
            'MA'=>'Maranhão',
            'MT'=>'Mato Grosso',
            'MS'=>'Mato Grosso do Sul',
            'MG'=>'Minas Gerais',
            'PA'=>'Pará',
            'PB'=>'Paraíba',
            'PR'=>'Paraná',
            'PE'=>'Pernambuco',
            'PI'=>'Piauí',
            'RJ'=>'Rio de Janeiro',
            'RN'=>'Rio Grande do Norte',
            'RS'=>'Rio Grande do Sul',
            'RO'=>'Rondônia',
            'RR'=>'Roraima',
            'SC'=>'Santa Catarina',
            'SP'=>'São Paulo',
            'SE'=>'Sergipe',
            'TO'=>'Tocantins'
        );

        return array_search($nome, $arrEstadosUF);
    }

    public static function getPathAnterior(){
        $url = str_replace(url('/'), '', url()->previous());
        $arr = explode('?', $url);
        return substr(current($arr), 1);
    }

    public static function valida_cpf($cpf) {

        $cpf = preg_replace("/[^0-9]/", "", $cpf);

        if (strlen($cpf) < 11) {
            if (self::valida_cpf(str_pad($cpf, 11, "0", STR_PAD_LEFT))) {
                return true;
            } elseif (self::valida_cpf(str_pad($cpf, 11, "0", STR_PAD_RIGHT))) {
                return true;
            } else {
                return false;
            }
        }

        if (!is_numeric($cpf))
            return false;

        else {

            if (($cpf == '11111111111') || ($cpf == '22222222222') ||
                    ($cpf == '33333333333') || ($cpf == '44444444444') ||
                    ($cpf == '55555555555') || ($cpf == '66666666666') ||
                    ($cpf == '77777777777') || ($cpf == '88888888888') ||
                    ($cpf == '99999999999') || ($cpf == '00000000000')) {

                return false;
            } else {

                $dv_informado = substr($cpf, 9, 2);

                for ($i = 0; $i <= 8; $i++) {

                    $digito[$i] = substr($cpf, $i, 1);
                }

                $posicao = 10;

                $soma = 0;

                for ($i = 0; $i <= 8; $i++) {

                    $soma = $soma + $digito[$i] * $posicao;

                    $posicao = $posicao - 1;
                }

                $digito[9] = $soma % 11;

                if ($digito[9] < 2)
                    $digito[9] = 0;
                else
                    $digito[9] = 11 - $digito[9];

                $posicao = 11;

                $soma = 0;

                for ($i = 0; $i <= 9; $i++) {

                    $soma = $soma + $digito[$i] * $posicao;

                    $posicao = $posicao - 1;
                }

                $digito[10] = $soma % 11;

                if ($digito[10] < 2)
                    $digito[10] = 0;
                else
                    $digito[10] = 11 - $digito[10];

                $dv = $digito[9] * 10 + $digito[10];

                if ($dv != $dv_informado)
                    return false;
            }
        }

        return true;
    }

    public static function valida_cnpj($cnpj) {

        $RecebeCNPJ = str_pad($cnpj,14,"0",STR_PAD_LEFT);

        $s = "";

        for ($x = 1; $x <= strlen($RecebeCNPJ); $x = $x + 1) {

            $ch = substr($RecebeCNPJ, $x - 1, 1);

            if (ord($ch) >= 48 && ord($ch) <= 57)
                $s = $s . $ch;
        }

        $RecebeCNPJ = $s;

        if (strlen($RecebeCNPJ) != 14)
            return false;

        else {

            if ($RecebeCNPJ == "00000000000000")
                return false;

            else {

                $Numero[1] = intval(substr($RecebeCNPJ, 1 - 1, 1));

                $Numero[2] = intval(substr($RecebeCNPJ, 2 - 1, 1));

                $Numero[3] = intval(substr($RecebeCNPJ, 3 - 1, 1));

                $Numero[4] = intval(substr($RecebeCNPJ, 4 - 1, 1));

                $Numero[5] = intval(substr($RecebeCNPJ, 5 - 1, 1));

                $Numero[6] = intval(substr($RecebeCNPJ, 6 - 1, 1));

                $Numero[7] = intval(substr($RecebeCNPJ, 7 - 1, 1));

                $Numero[8] = intval(substr($RecebeCNPJ, 8 - 1, 1));

                $Numero[9] = intval(substr($RecebeCNPJ, 9 - 1, 1));

                $Numero[10] = intval(substr($RecebeCNPJ, 10 - 1, 1));

                $Numero[11] = intval(substr($RecebeCNPJ, 11 - 1, 1));

                $Numero[12] = intval(substr($RecebeCNPJ, 12 - 1, 1));

                $Numero[13] = intval(substr($RecebeCNPJ, 13 - 1, 1));

                $Numero[14] = intval(substr($RecebeCNPJ, 14 - 1, 1));

                $soma = $Numero[1] * 5 + $Numero[2] * 4 + $Numero[3] * 3 + $Numero[4] * 2 + $Numero[5] * 9 + $Numero[6] * 8 + $Numero[7] * 7 + $Numero[8] * 6 + $Numero[9] * 5 + $Numero[10] * 4 + $Numero[11] * 3 + $Numero[12] * 2;

                $soma = $soma - (11 * (intval($soma / 11)));

                if ($soma == 0 || $soma == 1)
                    $resultado1 = 0;
                else
                    $resultado1 = 11 - $soma;

                if ($resultado1 == $Numero[13]) {

                    $soma = $Numero[1] * 6 + $Numero[2] * 5 + $Numero[3] * 4 + $Numero[4] * 3 + $Numero[5] * 2 + $Numero[6] * 9 + $Numero[7] * 8 + $Numero[8] * 7 + $Numero[9] * 6 + $Numero[10] * 5 + $Numero[11] * 4 + $Numero[12] * 3 + $Numero[13] * 2;

                    $soma = $soma - (11 * (intval($soma / 11)));

                    if ($soma == 0 || $soma == 1)
                        $resultado2 = 0;
                    else
                        $resultado2 = 11 - $soma;

                    if ($resultado2 != $Numero[14])
                        return false;
                } else
                    return false;
            }
        }

        return true;
    }


    public static function divide_e_valida($valor,$divide_por){

        if($divide_por>0){
            return $valor/$divide_por;
        }else{
            return 0;
        }

    }

    public static function linkPagseguro($codigo){
        return "https://pag.ae/{$codigo}";
    }

    public static function montarEndereco($ddUnidade){
        $res       = [];
        $arrCampos = ['endereco', 'numero', 'complemento', 'bairro', 'cep'];
        if($arrCampos):
            foreach($arrCampos as $campo):
                $valor = $ddUnidade->$campo;
                if(!empty($valor)):
                    $res[] = $valor;
                endif;
            endforeach;
        endif;
        return implode(', ', $res);
    }
}
