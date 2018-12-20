/*$('table td > *').each(function()
{
    this.innerText = this.innerText.replace(/([^\s\r\n]{5})(?=[^\s\r\n]{5,})/g, '$1\u00AD');
});*/
jQuery(document).ready(function(){

    $('#caraddCatMenu').click(function (e) {
        e.preventDefault();
        var title =$("#select2-frontendsetup-menus-container").attr('title');
        $('#frontendsetup-key_setup').val(title);
    });
    $('#addCatMenu').click(function (e) {
        e.preventDefault();
        var id = $("#frontendsetup-menus").val();
        var title =$("#select2-frontendsetup-menus-container").attr('title');
        var cat= '1';
        var sortable = $("#sortable");
        var input = ' <li class="ui-state-default wells" data-id="'+id+'" data-cat="'+cat+'" data-title="'+title+'">'+title+'<span class="glyphicon glyphicon-remove del"></span></li>';
        sortable.append(input);

    });

    $('#addPageMenu').click(function (e) {
        e.preventDefault();
        var id = $("#frontendsetup-pages").val();
        var title =$("#select2-frontendsetup-pages-container").attr('title');
        var cat= '0';
        var sortable = $("#sortable");
        var input = ' <li class="ui-state-default wells" data-id="'+id+'" data-cat="'+cat+'" data-title="'+title+'">'+title+'<span class="glyphicon glyphicon-remove del"></span></li>';
        sortable.append(input);

    });
    /*$("#sortable").sortable({

    });*/

    /*$("#secure").click(function (e) {
        e.preventDefault();
        var menu={};
        $( "#sortable li" ).each(function (i) {
            var id = $(this).data('id');
            var cat = $(this).data('cat');
            var title=$(this).data('title');
            var key = 'menu' + i;
            var addmenu = {title: title, id: id, cat: cat };
            menu[key] = addmenu;
        });
        //console.log(JSON.stringify(menu));
        var newval = JSON.stringify(menu);
        $('#frontendsetup-vaelye').val(''+newval);
    });*/

    $('#sortable').on('click','.wells .del',function(){
        $(this).parent('.wells').remove()
    });

    $("#forIMG").on('click','img',function () {
        var srcImage=$(this).attr('src');
        $('.cke_button__image_icon').click();
        var input =
            setTimeout(function () { $('table table table tr:first table .cke_dialog_ui_input_text').val(srcImage)},500);

    });
    $("#addTextSlider").click(function (e) {
        e.preventDefault();
        var value = $('#frontendsetup-vaelye').val();
        var text = $('#frontendsetup-pages').val();
        string=',%,text-'+text;
        if(value==undefined){
            var name='text-'+text
        }else{
            var name =value+',%,text-'+text }
        $('#frontendsetup-vaelye').val(name);
    });

    $('#addCatImage').click(function (e) {
        e.preventDefault();
        var ids = $("#frontendsetup-menus").val();
        var value = $('#frontendsetup-vaelye').val();
        var id;
        if(value==undefined){
            id ='id-'+ids
        }else{
            id =value+',%,id-'+ids }
        $('#frontendsetup-vaelye').val(id);

    });

    $('#addColor').click(function (e) {
        e.preventDefault();
        var value = $('#addlfeild-value').val();
        var oldvalue= $('#gods-color').val();
        var color;
        if(oldvalue==''){
            color=value;
        }else{
            color=oldvalue+',%%,'+value;
        }
        $('#gods-color').val( color);

    });
    $('body .color .fa-square i').click(function () {
        var color = $(this).parent('.fa-square').attr('data-color');
        $(this).parent('.fa-square').remove();
        var oldvalue=$("#gods-delcolor").val();
        if(oldvalue==''){
            var newvalue=color;
        }else{
            var newvalue=oldvalue+',%%,'+color;
        }
        $("#gods-delcolor").val(newvalue);
    });

    $('.skin-blue').on('click','.colorinput',function () {
        var colorId = $(this).attr('data-color-id');
        var color = $(this).attr('data-color');
        $(this).addClass('have');
        var addIcon='<strong class="fa fa-times-circle colorinputremove" style="color:'+color+';"></strong>';
        $(this).html(addIcon);
        $(this).siblings('.have').find('strong.colorinputremove').remove();
        $(this).siblings('.have').removeClass('have');
        $('#godsinshop-color').val(colorId);
    });
    $(".skin-blue").on('click','.colorinputremove',function (e) {
        var colorId = $(this).parent('.colorinput').attr('data-color');
        $(this).parent('.colorinput').removeClass('have');
        $(this).remove();
        $('#godsinshop-color').val(0);
        e.stopPropagation();
    });
    /*<--==[patern]==--> */
    $('body .frontend-setup-form .blocks').on('click','h3',function () {
        $(this).addClass('fa-plus-circle');
        $(this).removeClass('fa-minus-circle');
        $(this).parents('.blocks').children('.inner').slideDown(500) ;
        var parentHeight=$(this).parents('.ui-accordion-content').height();
       $(this).parents('.ui-accordion-content').height(parentHeight+550);
    });
    $('body .frontend-setup-form .blocks').on('click','.fa-plus-circle',function (){
        $(this).addClass('fa-minus-circle');
        $(this).removeClass('fa-plus-circle');
        $(this).parents('.blocks').children('.inner').slideUp(500) ;
        var parentHeight=$(this).parents('.ui-accordion-content').height();
        $(this).parents('.ui-accordion-content').delay(700).height(parentHeight-550);

    });
    $('body .frontend-setup-form #secure').click(function (e) {
        e.preventDefault();
        var json;
        var shirts = {};
        $('body .frontend-setup-form #goods input').each(function () {
            if($(this).val()!='') {
                var name =$(this).attr('id');
                var value=$(this).val();
                goods[name]=value;;
            }
        });

        $('body .frontend-setup-form #sheet input').each(function () {
            if($(this).val()!='') {
                var name =$(this).attr('id');
                var value=$(this).val();
                shirts[name]=value;
            }
        });

        var pillowcases = {};

        $('body .frontend-setup-form #pillowcases input').each(function () {
            if($(this).val()!='') {
                var name =$(this).attr('id');
                var value=$(this).val();
                pillowcases[name]=value;;
            }
        });
        var duvetscover={};
        $('body .frontend-setup-form #duvetcover input').each(function () {
            if($(this).val()!='') {
                var name =$(this).attr('id');
                var value=$(this).val();
                duvetcover=name +':'+value;;
                duvetscover[name]=value;;
            }
        });
        json={goods:goods,shirts:shirts,pillowcases:pillowcases,duvetscovers:duvetscover};
        $('body .frontend-setup-form #frontendsetup-vaelye').val(JSON.stringify(json));
        alert(JSON.stringify(json));
        console.log(JSON.stringify(json))

    });
    $( "#accordion" ).accordion({autoHeight:false,collapsible:true});

    if ($('input').is('.color-input')){
        var elem = $('.color-input')[0];
        var hueb = new Huebee( elem, {
            notation: 'hex'
        });
        hueb.on( 'change', function( color) {
         $('#colorInput').val(color)
         })
    }

    $('#image-forhome').change(function (e) {
        var forFancy=$("#image-forfancy");
       if(forFancy.prop("checked")){
          forFancy.prop('checked', false)
       }
    });

    $('#image-forfancy').change(function (e) {
        var forHome=$("#image-forhome");
       if(forHome.prop("checked")){
           forHome.prop('checked', false)
       }
    });

});
function logAdd (evt) {
    if (!evt) {
        var args = '{}';
    } else {
        var args = evt.params;
    }
    return args;}
