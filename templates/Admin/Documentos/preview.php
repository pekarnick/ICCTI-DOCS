<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Documento $documento
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="documentos view content">
            <div class="text">
                <strong>Vista previa</strong>
                <blockquote>
                    <iframe src="https://docs.google.com/gview?url=https://iccti.chaco.gob.ar/regs/fontech/files/documentos/<?= $documento->file; ?>&embedded=true" style="width:100%; height:90vh;" frameborder="0"></iframe>
                </blockquote>
            </div>
        </div>
    </div>
</div>
