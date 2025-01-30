
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
              <input type="text" class="form-control" name="customer" id="validationCliente" value="" required>
              <div class="invalid-feedback">
                Por favor, insira o nome do cliente!
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationTel" class="form-label">Telefone:</label>
              <input type="text" class="form-control"name="tel" id="validationTel" value="" required>
              <div class="invalid-feedback">
                Por favor, insira o telefone do cliente!
              </div>
            </div>
            <div class="col-md-12">
              <label for="product" class="form-label">Produto:</label>
              <input type="text" class="form-control"name="product" id="product" value="" required>
              <div class="invalid-feedback">
                Por favor, insira o produto!
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationReceiver" class="form-label">Destinatário:</label>
              <input type="text" class="form-control" name="receiver" id="validationReceiver" value="" required>
              <div class="invalid-feedback">
                Por favor, insira o destinatário!
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationReceiver" class="form-label">Telefone do Destinatário:</label>
              <input type="text" class="form-control" name="tel_receiver" id="validationReceiver" value="" required>
              <div class="invalid-feedback">
                Por favor, insira o telefone do destinatário!
              </div>
            </div>
            <div class="col-md-6">
              <label for="validationTelReceiver" class="form-label">Endereço</label>
              <input type="text" class="form-control" name="address" id="validationTelReceiver" required>
              <div class="invalid-feedback">
                Por favor, insira o telefone do destinatário!
              </div>
            </div>
            <div class="col-md-6">
              <label for="address_complement" class="form-label">Complemento</label>
              <input type="text" class="form-control" name="address_complement" id="address_complement">
            </div>
            <div class="col-md-12">
              <label for="message" class="form-label">Mensagem</label>
              <textarea class="form-control" name="message" id="message"></textarea>
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