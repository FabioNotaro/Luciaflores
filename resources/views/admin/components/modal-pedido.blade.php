
  <!-- Modal Novo Pedido-->
  <div class="modal fade" id="modalPedido" tabindex="-1" aria-labelledby="modalPedido" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Novo Pedido</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3 needs-validation" novalidate method="POST" action="{{ url('admin/order') }}">
            @csrf
            <div class="col-md-6">
              <label for="validationCliente" class="form-label">Cliente:</label>
              <input type="text" class="form-control" name="customer" placeholder="Digite o nome do Cliente!" id="validationCliente" required>
              <div class="invalid-feedback">
                Por favor, insira o nome do cliente!
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationTel" class="form-label">Telefone:</label>
              <input type="text" class="form-control" name="customer_tel" id="validationTel" placeholder="Digite o telefone do Cliente!" required>
              <div class="invalid-feedback">
                Por favor, insira o telefone do cliente!
              </div>
            </div>
            <div class="col-md-8">
              <label for="produto" class="form-label">Produto:</label>
              <input type="text" class="form-control"name="product" id="produto" placeholder="Digite o Produto!" required>
              <div class="invalid-feedback">
                Por favor, insira o produto e seus detalhes!
              </div>
            </div>
            <div class="col-md-4">
              <label for="valor" class="form-label">Valor:</label>
              <input type="number" class="form-control"name="value" id="valor" placeholder="Digite o valor do produto!" required>
              <div class="invalid-feedback">
                Por favor, insira o valor do produto!
              </div>
            </div>
            <div class="col-md-6">
              <label for="tipoPag" class="form-label">Forma de Pagamento:</label>
              <select class="form-select" id="tipoPag" name="payment_type" required>
                <option selected disabled value="">Selecione a forma de pagamento...</option>
                <option value="1">Dinheiro</option>
                <option value="2">Pix</option>
                <option value="3">Cartão Débito</option>
                <option value="4">Cartão Crédito</option>
                <option value="5">Link de Pagamento</option>
              </select>
              <div class="invalid-feedback">
                Por favor, selecione a forma de pagamento.
              </div>
            </div>
            <div class="col-md-6">
              <label for="statusPag" class="form-label">Status do Pagamento:</label>
              <select class="form-select" id="statusPag" name="payment_status" required>
                <option selected disabled value="">Selecione a forma de pagamento...</option>
                <option value="1">Aguardando Pagamento</option>
                <option value="2">Pagamento Confirmado</option>
              </select>
              <div class="invalid-feedback">
                Por favor, selecione o status de pagamento.
              </div>
            </div>
            <div class="col-md-6">
              <label for="dataEntrega" class="form-label">Data do Pedido:</label>
              <input type="date" class="form-control" name="dt_order" id="dataEntrega" required>
              <div class="invalid-feedback">
                Por favor, insira a Data do Pedido!
              </div>
            </div>
            <div class="col-md-6">
              <label for="horarioEntrega" class="form-label">Horario do Pedido:</label>
              <input type="time" class="form-control" name="time_order" id="horarioEntrega" required>
              <div class="invalid-feedback">
                Por favor, insira o Horário do Pedido!
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input order-delivery" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Pedido para entrega
                </label>
              </div>
            </div>
            <div class="content-delivery">      
              <div class="row">   
                <div class="col-md-6">
                  <label for="validationReceiver" class="form-label">Destinatário:</label>
                  <input type="text" class="form-control" name="receiver" id="validationReceiver" placeholder="Digite o destinatário de entrega!">
                  <div class="invalid-feedback">
                    Por favor, insira o destinatário!
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationTelReceiver" class="form-label">Telefone do Destinatário:</label>
                  <input type="text" class="form-control" name="tel_receiver" id="validationTelReceiver" placeholder="Digite o telefone do destinatário!">
                  <div class="invalid-feedback">
                    Por favor, insira o telefone do destinatário!
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationAddress" class="form-label">Endereço</label>
                  <input type="text" class="form-control" name="address" id="validationAddress" placeholder="Digite o endereço do destinatário!">
                  <div class="invalid-feedback">
                    Por favor, insira o endereço do destinatário!
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationAddressComp" class="form-label">Complemento</label>
                  <input type="text" class="form-control" name="address_complement" id="validationAddressComp" placeholder="Digite o complemento do endereço!">
                </div>
                <div class="col-md-12">
                  <label for="mensagem" class="form-label">Mensagem</label>
                  <textarea class="form-control" name="message" id="mensagem"></textarea>
                </div>
              </div>

            </div>
            <div class="col-12">
              <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
          </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>