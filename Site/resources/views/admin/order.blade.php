
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Pedidos</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home">
            <a href="admin/">
              <i class="icon-home"></i>
            </a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a class="link-disabled" href="#">Pedidos</a>
          </li>
        </ul>
        <div title="Novo Pedido" class="add-button" data-bs-toggle="modal" data-bs-target="#modalPedido">
            <i class="fas fa-plus-circle"></i>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-producao">
            <div class="card-header">
              <h4 class="card-title">Produção</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Nº Pedido</th>
                      <th>Nome</th>
                      <th>Produto</th>
                      <th>Destinatario</th>
                      <th>Valor</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nº Pedido</th>
                      <th>Nome</th>
                      <th>Produto</th>
                      <th>Destinatario</th>
                      <th>Valor</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($orders as $order) 
                    <tr>
                        <td>{{ $order['order_number'] }}</td>
                        <td>{{ $order['name'] }}</td>
                        <td>{{ $order['product'] }}</td>
                        <td>{{ $order['receiver'] }}</td>
                        <td>{{ $order['value'] }}</td>
                        <td>{{ $order['status'] }}</td>
                        <td>xxx</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-entregue">
            <div class="card-header">
              <h4 class="card-title">Entregues</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Nº Pedido</th>
                      <th>Nome</th>
                      <th>Produto</th>
                      <th>Destinatario</th>
                      <th>Valor</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nº Pedido</th>
                      <th>Nome</th>
                      <th>Produto</th>
                      <th>Destinatario</th>
                      <th>Valor</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($orders as $order) 
                    <tr>
                        <td>{{ $order['order_number'] }}</td>
                        <td>{{ $order['name'] }}</td>
                        <td>{{ $order['product'] }}</td>
                        <td>{{ $order['receiver'] }}</td>
                        <td>{{ $order['value'] }}</td>
                        <td>{{ $order['status'] }}</td>
                        <td>xxx</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('admin.components.modal-pedido')