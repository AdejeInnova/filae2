<?php
echo $this->Form->input('Nombre');
echo $this->Form->input('Razón Social');
echo $this->Form->input('Tipo de Documento', ['options' => $idcards]);
echo $this->Form->input('CIF');
echo $this->Form->input('Descripción');
echo $this->Form->input('company_id');
echo $this->Form->input('address_id', ['options' => $addresses, 'empty' => true]);
echo $this->Form->input('communications._ids', ['options' => $communications]);
echo $this->Form->input('networks._ids', ['options' => $networks]);
?>