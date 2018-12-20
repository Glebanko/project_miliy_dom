<?=\zainiafzan\widget\Dropzone::widget([
    'options' => [
        'addRemoveLinks'    => true,
        'url'               => 'update?id='.$class,
    ],
    'clientEvents' => [
        'complete' => "function(file,dataUrl){
                 var value=document.getElementById('image-name').getAttribute('value');
                 if(value==undefined){
                    var name=file.name
                 }else{ var name = file.name} 
                 document.getElementById('image-name').setAttribute('value',name)}",
        'removedfile' => "function(file){
                var value = document.getElementById('image-name').value;
                string=',%, '+file.name
                if(value.indexOf(string)!=-1){
                    newvalue = value.replace(string,'');
    
                }else if(value.indexOf(file.name)!=-1){
                    newvalue = value.replace(file.name,'');
                }else{
                    newvalue = value
                }
                document.getElementById('page-image').value = newvalue;
                }",
        'success'=>'function(file){console.log(file)}',
        'sending' => "function(file, xhr, formData){formData.append('".Yii::$app->request->csrfParam."','".Yii::$app->request->getCsrfToken() ."')}"
    ]
])?>