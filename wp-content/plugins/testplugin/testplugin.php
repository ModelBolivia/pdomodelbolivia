<?php
/*
Plugin Name: Test Plugin
Plugin URI: http://modelbolivia.github.io/administracion/
Description: Este es un plugin de Prueba de Base de Datos 
Version: 0.0.1
*/


//requires
require_once dirname(__FILE__) . '/clases/codigocorto.class.php';


function Activar(){
    global $wpdb;

    $sql ="CREATE TABLE IF NOT EXISTS {$wpdb->prefix}encuestas(
        `EncuestaId` INT NULL AUTO_INCREMENT,
         `Nombre` VARCHAR(45)  NULL,
         `ShortCode` VARCHAR(45)  NULL,
         PRIMARY KEY (`EncuestaId`));";

    $wpdb->query($sql);    

    $sql2="CREATE TABLE IF NOT EXISTS {$wpdb->prefix}encuestas_detalle(
        `DetalleId` INT NULL AUTO_INCREMENT , 
        `EncuestaId` INT NOT NULL , 
        `Pregunta` VARCHAR(150) NOT NULL , 
         `Tipo` VARCHAR(45) NOT NULL , 
        PRIMARY KEY (`DetalleId`));";
     $wpdb->query($sql2); 

    $sql3="CREATE TABLE IF NOT EXISTS {$wpdb->prefix}encuestas_respuesta(
        `RespuestaId` INT NULL AUTO_INCREMENT , 
        `DetalleId` INT NOT NULL , 
        `Codigo` VARCHAR(50) NOT NULL , 
        `Respuesta` VARCHAR(50) NOT NULL ,
         PRIMARY KEY (`RespuestaId`));";
    $wpdb->query($sql3);
    

}

function Desactivar(){

} 


register_activation_hook(__FILE__,"Activar");
register_deactivation_hook(__FILE__,"Desactivar");

add_action("admin_menu","CrearMenu");

function CrearMenu(){
    add_menu_page(
        "Super Encuestas Titulo",//Titulo de la Pagina
        "Super Encuestas Menu",//Titulo del Menu 
        "manage_options",//Permisos de Usuario o Capability
        plugin_dir_path(__FILE__)."admin/lista_encuestas.php",//slug del menu 
        null,//Funcion del Contenido
        plugin_dir_url(__FILE__),"admin/img/file_new_14810.png",
        "0"
    );



}

function MostarContenido(){
    echo "<h1>Contenido de la Pagina</h1>";
}



//encolar bootstrap
function EncolarBootstrapJS($hook){
    //echo "<script>console.log('$hook') </script>";
    if($hook !="testplugin/admin/lista_encuestas.php"){
        return;
    }   

    wp_enqueue_script('bootstrapJs' ,plugins_url('admin/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));


}
add_action('admin_enqueue_scripts', 'EncolarBootstrapJS');


function EncolarBootstrapCSS($hook){
    
    if($hook !="testplugin/admin/lista_encuestas.php"){
        return;
    }

    wp_enqueue_style('bootstrapCSS' ,plugins_url('admin/bootstrap/css/bootstrap.min.css',__FILE__));


}
add_action('admin_enqueue_scripts', 'EncolarBootstrapCSS');


//Encolar js propio

function EncolarJS($hook){
    
    if($hook !="testplugin/admin/lista_encuestas.php"){
        return;
    }

    wp_enqueue_script('JsExterno' ,plugins_url('admin/js/lista_encuestas.js',__FILE__),array('jquery'));
    wp_localize_script('JsExterno','SolicitudesAjax',[
        'url' => admin_url('admin-ajax.php'),
        'seguridad' => wp_create_nonce('seg')
    ]);   
    }
    add_action('admin_enqueue_scripts', 'EncolarJS');


 //ajax

function EliminarEncuesta(){
    $nonce = $_POST['nonce'];
    if(!wp_verify_nonce($nonce, 'seg')){
        die('no tiene permisos para ejecutar ese ajax');
    }

    $id = $_POST['id'];
    global $wpdb;
    $tabla = "{$wpdb->prefix}encuestas";
    $tabla2 = "{$wpdb->prefix}encuenstas_detalle";
    $wpdb->delete($tabla,array('EncuestaId' =>$id));
    $wpdb->delete($tabla2,array('EncuestaId' =>$id));
     return true;
}

add_action('wp_ajax_peticioneliminar','EliminarEncuesta');


///shortcode

function imprimirshortcode($atts){
    $_short = new codigocorto;
    //obtener el id por parametro
    $id= $atts['id'];
    //Programar las acciones del boton
    if(isset($_POST['btnguardar'])){
        $listadePreguntas = $_short->ObtenerEncuestaDetalle($id);
        $codigo = uniqid();
        foreach ($listadePreguntas as $key => $value) {
           $idpregunta = $value['DetalleId'];
           if(isset($_POST[$idpregunta])){
               $valortxt = $_POST[$idpregunta];
               $datos = [
                   'DetalleId' => $idpregunta,
                   'Codigo' => $codigo,
                   'Respuesta' => $valortxt
               ];
               $_short->GuardarDetalle($datos);
           }
        }
        return " Encuesta enviada exitosamente";
    }
    //Imprimir el formulario
    $html = $_short->Armador($id);
    return $html;
}


add_shortcode("ENC","imprimirshortcode");



