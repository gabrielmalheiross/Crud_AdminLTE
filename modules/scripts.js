function openModal(id, titulo, url) { // funcao para abrir o modal

    // Cria-se uma variavel html com código do esqueleto do nosso modal
    // Pega-se os valores recebidos pelo parametro e adiciona ao corpo do html
    let html = ` 
                <div class="modal fade" id="${id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">${titulo}</h5>
                            </div>
                            
                            <div id="${id}_content" class="modal-body">
                                <?xml version="1.0" encoding="utf-8"?>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                <circle cx="50" cy="50" r="32" stroke-width="8" stroke="#fe718d" stroke-dasharray="50.26548245743669 50.26548245743669" fill="none" stroke-linecap="round">
                                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
                                </circle>
                            </div>
                        </div>
                    </div>
                </div>
            `;

    //Adiciona html da modal
    $('#modals').append(html);

    //Abre modal  --Disponível na documentação do boostrap
    var myModal = new bootstrap.Modal(document.getElementById(id));
    myModal.show();

    //Carrega conteudo
    $(`#${id}_content`).load(url, function (response, status, xhr) {
        console.log(response);
    });

    // Evento fechar modal
    $(`#${id}`).on('hidden.bs.modal', function (e) {
        $(`#${id}`).remove();
    });
}