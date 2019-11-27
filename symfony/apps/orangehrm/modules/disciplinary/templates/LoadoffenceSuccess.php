<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



$li=$sf_data->getRaw('List');
echo json_encode(array("List"=>$li));
?>
