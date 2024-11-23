

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <base href="{{ url('/') }}">
    <meta charset="UTF-8">
    <title>Lucia Flores - Floricultura</title>
    <meta name="Description" content="Floricultura em Nova Friburgo - RJ. Encomende ainda hoje, seu presente para a pessoa especial.">
    <meta name="Robots" content="no-index, no-follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="author" href="https://plus.google.com/posts">
    <link rel="publisher" href="https://plus.google.com/">
    <link rel="canonical" href="https://www.luciaflores.com.br/">
    <link rel="shortcut icon" href="https://www.luciaflores.com.br/public/uploads/repositorio/fav.ico">

    <meta itemprop="name" content="Floricultura - Lucia Flores">
    <meta itemprop="description" content="Floricultura em Nova Friburgo - RJ. Encomende ainda hoje, seu presente para a pessoa especial.">
    <meta itemprop="image" content="https://www.luciaflores.com.br/public/uploads/paginas/pagina-home-20190515153152.jpg">
    <meta itemprop="url" content="https://www.luciaflores.com.br/home/">

    <meta property="og:type" content="article">
    <meta property="og:title" content="Floricultura - Lucia Flores">
    <meta property="og:description" content="Floricultura em Nova Friburgo - RJ. Encomende ainda hoje, seu presente para a pessoa especial.">
    <meta property="og:image" content="https://www.luciaflores.com.br/public/uploads/repositorio/pagina-home.jpg">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:url" content="https://www.luciaflores.com.br/">
    <meta property="og:site_name" content="Floricultura - Lucia Flores">
    <meta property="og:locale" content="pt_BR">

    @if (env('APP_ENV') === 'local')
        <link rel="stylesheet" href="/assets/css/style.css">
    @else
        <link rel="stylesheet" href="/assets/css/min-style.css">
    @endif    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <main>
        <section class="container">
            <div class="d-lg-flex half">
                <div class="bg order-1 order-md-2" style="background-image: url('assets/images/bg_01.jpg');"></div>
                <div class="contents order-2 order-md-1">

                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                        <div class="col-md-7">
                            <h3><strong>Cadastro Usuario</strong></h3>
                            <form action="" method="post" autocomplete="off">
                                @csrf
                                <div class="form-group first">
                                    <label for="name">Nome</label>
                                    <input type="text" class="form-control" placeholder="Nome" name="name" id="name">
                                </div>
                                <div class="form-group first">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Seu-email@email.com" name="email" id="email">
                                </div>
                                <div class="form-group last mb-3">
                                    <label for="password">Senha</label>
                                    <input type="password" class="form-control" placeholder="Digite sua Senha" name="password">
                                </div>
                                <div class="form-group last mb-3">
                                    <label for="confirme_pass">Confirmação de Senha</label>
                                    <input type="confirme_password" class="form-control" placeholder="Confirme sua Senha" name="confirme_password">
                                </div>

                                <input type="submit" value="Entrar" class="btn btn-block btn-primary">

                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </section>
    </main>
</body>
</html>