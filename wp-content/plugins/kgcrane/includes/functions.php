<?php
if( !function_exists('dd') ){
    function dd($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die();
    }
}

if( !function_exists('echobr') ){
    function echobr($key,$value){
        echo '<br>'.$key.' : '.$value;
    }
}

if( !function_exists('pr') ){
    function pr($data){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}

if( !function_exists('kg_redirect') ){
    function kg_redirect($url){
        echo("<script>location.href = '".$url."'</script>");
    }
}

if( !function_exists('kg_selected') ){
    function kg_selected($condition){
        echo $condition ? 'selected' : '';
    }
}

if( !function_exists('kg_checked') ){
    function kg_checked($condition){
        echo $condition ? 'checked' : '';
    }
}

if( !function_exists('kg_virgul_get_template') ){
    function kg_virgul_get_template($file,$data = []){
        if( count($data) ){
            extract($data);
        }
        include_once NOKTALI_PATH.'/templates/'.$file.'.php';
    }
}