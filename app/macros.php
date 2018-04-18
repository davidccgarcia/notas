<?php
Form::macro('delete',function($url, $button_label='Delete',$form_parameters = array(),$button_options=array()){

    if(empty($form_parameters)){
        $form_parameters = array(
            'method'=>'DELETE',
            'class' =>'delete-form',
            'url'   =>$url
            );
    }else{
        $form_parameters['url'] = $url;
        $form_parameters['method'] = 'DELETE';
    };

    return Form::open($form_parameters)
            . Form::submit($button_label, $button_options)
            . Form::close();
});


