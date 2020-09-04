<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<br>
<div class="row">
    <div class="col-lg-4 mb-4">
    </div>
    <div class="col-lg-4 mb-4">
        <form action="<?php echo server_url('?page=ControllerFolhaPagamento&option=save'); ?>" enctype="multipart/form-data" method="post">
            <div class="card h-100">
                <h4 class="card-header text-primary">Registrar Folha de Pagamento</h4>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-primary">Competência:</label><br>
                        <div class="input-group input-group-lg date" id="dpMonths" data-date="102/2020" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
                            <div class="input-group-append">
                                <span class="input-group-text add-on"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input class="form-control" id="competencia"  name="fopa_competencia" placeholder="00/0000" type="tel" value="<?php echo date("m/Y"); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-primary">Contra Cheque:</label><br>
                        <input accept=".pdf" class="form-control" name="fopa_arquivo" type="file" placeholder="Selecione o arquivo..." required>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar com grupos de botões">
                        <div class="input-group">
                            <button class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Salvar</span>
                            </button>
                        </div>
                        <div class="input-group">
                            <a  class="btn btn-danger btn-icon-split" href="<?php echo server_url('?page=ControllerFolhaPagamento&option=listar'); ?>">
                                <span class="icon text-white-50">
                                    <i class="fas fa-window-close"></i>
                                </span>
                                <span class="text">Cancelar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>       
        </form>
    </div>
    <div class="col-lg-4 mb-4">
    </div>
</div>
<br>
