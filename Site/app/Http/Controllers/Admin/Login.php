<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Login extends Controller {

    protected $redirectTo = 'admin/dashboard';

    public function index(Request $request){

        $loggedUser = Auth::guard('admin')->check();
        if($loggedUser){
            redirect('admin/dashboard')->send();
        }

        $args = [];
        $args['title'] = 'Lucia Flores - Floricultura';
        $args['msg'] = false;

        return view('admin', ['pagina' => 'login', 'args' => $args]);

    }

    public function autenticar(Request $request){

        $request->validate([
            'email'    => ['required'],
            'password' => ['required'],
        ]);

        $credentials = $request->only(['email', 'password']);

        $auth = Auth::guard('admin')->attempt($credentials);

        if($auth):

            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');

        endif;

        return back()->withErrors([
            'error' => 'Login/Senha inválidos.'
        ]);

    }

    public function logout(){

        Auth::guard('admin')->logout();
        return redirect()->route('login');

    }

    // public function recuperarSenha(Request $request){

    //     $args = [];
    //     $args['title'] = 'Lucia Flores - Recuperação de Senha';

    //     if($request->reset):

    //         $email     = $request->reset['email'];
    //         $ddUsuario = User::where('email', $email)->first();

    //         if(!$ddUsuario):

    //             return back()->withErrors([
    //                 'error' => 'Email não cadastrado.'
    //             ]);

    //         else:

    //             $usuario   = User::find($ddUsuario['id']);
    //             $time      = date('Y-m-d H:i:s');
    //             $token     = hash('sha256', $time);
    //             $usuario->token_recuperacao = $token;
    //             $usuario->dt_token = $time;
    //             $usuario->save();

    //             if($usuario->save()):

    //                 $view      = "recuperar_senha";
    //                 $variables = [
    //                     'titulo_email' => 'Recuperação de Senha',
    //                     'subtitulo_email' => 'Ação necessária para acessar sua conta.',
    //                     'token' => $token
    //                 ];
    //                 $address   = [$ddUsuario['email']];
    //                 $subject   = "Recuperar Senha.";

    //                 Email::enviaEmail($view, $variables, $address, $subject);

    //                 redirect('user/mensagem-recuperar')->send(); //Tela com aviso de envio de email

    //             endif;

    //         endif;

    //     endif;

    //     return view('diagnostico_login', ['pagina' => 'lost_pass', 'args' => $args]);

    // }

    public function novaSenha(Request $request){

        $token = $request->token;
        $idUsuario = $request->idUsuario;

        if($idUsuario):

            $validarDados = $request->validate([
                'novaSenha'     => 'required',
                'confirmaSenha' => 'required'
            ]);

            $cliente      = User::find($request->idUsuario);
            $res['token'] = $cliente->token_recuperacao;

            if($validarDados):

                $senha         = $request->input('novaSenha', '');
                $confirmaSenha = $request->input('confirmaSenha', '');
                $validaSenha   =  preg_match('/[a-z]/', $senha) && preg_match('/[A-Z]/', $senha) && preg_match('/[0-9]/', $senha)  && strlen($senha) >= 8;

                if($validaSenha):

                    if($senha == $confirmaSenha):

                        $novaSenha      = Hash::make($senha);
                        $cliente->senha = $novaSenha;

                        if($cliente->save()):

                            $arrNome   = explode(' ', $cliente->nome);
                            $view      = "atualizacao_dados";
                            $variables = [
                                'nome' => $arrNome[0],
                                'titulo_email' => 'Atualização de dados',
                                'subtitulo_email' => 'Seus dados foram atualizados com sucesso!'
                            ];
                            $address   = [$cliente->email];
                            $subject   = "Atualização de dados.";

                            Email::enviaEmail($view, $variables, $address, $subject);

                            $args = [];
                            $args['msg'] = 'Nova Senha salva com sucesso!';
                            $args['title'] = 'Escritório de Advocacia - Modulo Diagnostico';

                            return view('diagnostico_login', ['pagina' => 'login', 'args' => $args]);

                        else:

                            $res['error'] = true;
                            $res['alert'] = 'Ocorreu um erro ao salvar sua nova senha!';

                        endif;

                    else:

                        $res['error'] = true;
                        $res['alert'] = 'A confirmação de senha não confere!';

                    endif;

                else:

                    $res['error'] = true;
                    $res['alert'] = 'A senha deve possuir no mínimo 8 caracteres, e entre estes deve haver pelo menos uma letra maiúscula, uma minúscula e um algarismo.!';

                endif;

                if($res['error']):

                    return back()->withErrors([
                        'error' => $res['alert']
                    ]);

                endif;

            endif;

        elseif($token):

            $ddUsuario = User::where('token_recuperacao', $token)->first();

            if($ddUsuario):

                $expira = strtotime($ddUsuario['dt_token']." + 30 minute");
                $expira = date('Y-m-d H:i:s', $expira);
                $agora  = date('Y-m-d H:i:s');

                if(strtotime($expira) > strtotime($agora)):

                    $args = [];

                    $args['title']      = 'Escritório de Advocacia - STN - Recuperação de senha';
                    $args['id_usuario'] = $ddUsuario['id'];

                    return view('diagnostico_login', ['pagina' => 'reset_pass', 'args' => $args]);

                endif;

            endif;

        endif;

        redirect('diagnostico/login')->send();

    }

    // public function mensagemRecuperar(){

    //     $args = [];

    //     $args['title'] = 'Escritório de Advocacia - STN - Mensagem de Recuperação de Senha';

    //     return view('diagnostico_login', ['pagina' => 'mensagem_recuperar', 'args' => $args]);

    // }

}
