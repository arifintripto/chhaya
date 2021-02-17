/* Concave builder & Concave 5 Inc 
	copyright 2014 . concave builder com  & Concave5.net
*/
$(window).on('load', function() {
  $('#preloader').delay(100).fadeOut('slow',function(){$(this).remove();});
});


jQuery(document).ready(function($){
	$('.toggleMenu').click(function () {
      	var w = $("#app");
	//	w.toggleClass("close-sidemenu");
			
		if( w.hasClass('toggled'))
		{
			w.removeClass('toggled');
			$.cookie("sidebar",' ', {expires: 365, path: '/'});

		} else {
			w.addClass('toggled');
			$.cookie("sidebar",'toggled', {expires: 365, path: '/'});	
		}		

		 console.log( $.cookie("sidebar") );
    })

	/*
	$("#side-nav").addClass($.cookie("side-nav-color"));
	$(".page-header").addClass($.cookie("header-nav-color"));
	$(".sidebar-header").addClass($.cookie("header-nav-color"));  

	if( $("#side-nav").hasClass('darken-2') ||  $("#side-nav").hasClass('darken-3') ||  $("#side-nav").hasClass('darken-4') ||  $("#side-nav").hasClass('darken-1') ) {
		$(".sidebar-compact ul li a i").css('color','#fff');
	}
	if( $(".page-header").hasClass('darken-2') ||  $(".page-header").hasClass('darken-3') ||  $(".page-header").hasClass('darken-4') ||  $(".page-header").hasClass('darken-1') ) {
		$(".page-header , a.toggleMenu  ").css('color','#fff');
	}
	if( $(".sidebar-header").hasClass('darken-2') ||  $(".sidebar-header").hasClass('darken-3') ||  $(".sidebar-header").hasClass('darken-4') ||  $(".sidebar-header").hasClass('darken-1') ) {
		$(".sidebar-header a  ").css('color','#fff !important');
	}
	*/
	$("#app").addClass( $.cookie("sidebar") );
	
	$('.sidebar-compact ul li a').hover(function(){
		var w = $("#app");
		if( w.hasClass('toggled')) {
			w.removeClass('toggled');
		} 			
	})

	$(window).bind("load resize",function(){
		var w = $("body");
		if( w.hasClass('ls-closed'))
		{
			$('body').removeClass('close-sidemenu')
		
		} else {
			$("body").addClass( $.cookie("concave-sidebar") );
		}

	})


    //$('.editor').summernote({ height: 250});
    	tinymce.init({
		selector: '.editor',
		height: 250,
		theme: 'modern',
		plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern code help',
		toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code toc',
		image_advtab: true
	});
	
     window.prettyPrint && prettyPrint();
	$('.date').datepicker({format:'yyyy-mm-dd',autoClose:true})
	$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss',autoClose:true});
  	$(".select2").select2({ width:"100%"});	    
	$('.popup').click(function (e) {
		e.stopPropagation();
	});    
	$('.clearCache').click(function(){
		$('.ajaxLoading').show();
		var url = $(this).attr('href');
		$.get( url  , function( data ) {
		 $('.ajaxLoading').hide();
		 notyMessage(data.message); 
		     
		});
		return false;
	}); 
	$('.confirm_logout').on('click',function(){
		if(confirm('Logout from application ?'))
		{
			return true;
		}
		return false;
	})

	$(".checkall").click(function() {
		var cblist = $(".ids");
		if($(this).is(":checked"))
		{				
			cblist.prop("checked", !cblist.is(":checked"));
		} else {	
			cblist.removeAttr("checked");
		}	
	});

	$('.checkall').on('ifChecked', function(event) {
	    $('.ids').iCheck('check');
	});
	$('.checkall').on('ifUnchecked', function(event) {
	    $('.ids').iCheck('uncheck');
	});

    $('input[type="checkbox"].minimal-green, input[type="radio"].minimal-green').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    }); 	
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green'
    }); 

    $('.validated').parsley();

    $('.onsearch').keyup(function( e ){
		if (e.keyCode === 13) {
	      val = $(this).val();
	      target =  $(this).data('target');
	      window.location.href = target + '?s='+val ;	     
	    }
	})	
	$('.upload').change(function() {

		var id = $(this).attr('name');

		var files = $(this).prop('files');
		$(this).parent().closest('.title').html(files[0].name)
		
		const fr = new FileReader()
		fr.readAsDataURL(files[0]);
		fr.addEventListener('load', () => {
		 	$('.'+id+'-preview').html('<img src="'+fr.result+'" width="120" />')
		}) 
		
	})
	$('.form-tab a').on('click', function (e) {
	  	e.preventDefault()
	  	$(this).tab('show')
	})

	

})

function previewUpload( e , id ) {
	console.log(e)
		const files = e.target.files
		let imageName = files[0].name
    	let imageType = files[0].type
		const fr = new FileReader()
		fr.readAsDataURL(files[0])
		fr.addEventListener('load', () => {
		 	$('#'+id+'-preview').html('<img src="'+fr.result+'" width="80" />')
		}) 

}
function ConcaveConfirmDelete( url )
{

	Swal.fire({
        title: 'Confirm ?',
        text: ' Are u sure deleting this record ? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, please',
        cancelButtonText: 'cancel'
      }).then((result) => {
        if (result.value) {
          window.location.href = url;
          
        }
      })

	return false;
}
function ConcaveDelete(  )
{	
	var total = $('input[class="ids"]:checkbox:checked').length;
	Swal.fire({
        title: 'Confirm ?',
        text: ' Are u sure deleting this record ? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, please',
        cancelButtonText: 'cancel'
      }).then((result) => {
        if (result.value) {
         	$('input[name="action_task"]').val('delete');
			$('#ConcaveTable').submit();// do the rest here
          
        }
      })
}
function ConcaveCopy(  )
{	
	var total = $('input[class="ids"]:checkbox:checked').length;
	if(confirm('are u sure removing selected rows ?'))
	{
		$('#ConcaveTable').submit();// do the rest here	
	}	
}	
function ConcaveModal( url , title)
{
	
	$('#concave-modal-content').html(' ....Loading content , please wait ...');
	$('.modal-title').html(title);
	$('#concave-modal-content').load(url,function(){
	});
	$('#concave-modal').modal('show');	
}

function notyMessage(message)
{
	 $.toast({
	    heading: 'success',
	    text: message,
	    position: 'top-right',		           
	   	icon: 'success',
	    hideAfter: 3000,
	    stack: 6
	});	
}
function notyMessageError(message)
{
	 $.toast({
	    heading: 'error',
	    text: message,
	    position: 'top-right',		           
	    icon: 'error',
	    hideAfter: 3000,
	    stack: 6
	});	
}

function reloadData( id,url   )
{
	$('.ajaxLoading').show()
	$.get( url ,function( data ) {
		$( id +'Grid' ).html( data );
		$('.ajaxLoading').hide()
	});
}
function ajaxViewClose( id )
{
	$( id +'View' ).html('');	
	$( id +'Grid' ).show();	
	$('#concave-modal').modal('hide');
}
function ajaxViewDetail( id , url )
{
	if(url !='#')
	 {
		$('.ajaxLoading').show();
		$.get( url ,function( data ) {
			$( id +'View').html( data );
			$( id +'Grid').hide( );
			var w = $(window); 
			var duration = 300;
			$('html, body').animate({scrollTop: 0}, duration);
			$('.ajaxLoading').hide();
		});		
	} else {
		alert('No Link with' + url);
	}	
}
function ajaxFilter( id ,url )
{
	var attr = '';
	$( id +'Filter :input').each(function() {
		if(this.value !='') { attr += this.name+'='+this.value+'&'; }
	});	

	reloadData(id, url+"?"+attr);
}
function ajaxCopy(  id , url )
{	
	if(confirm('Areu sure Copy selected row(s)'))
	{
		var datas = $( id +'Table :input').serialize();
			$.post( url ,datas,function( data ) {
				if(data.status =='success')
				{
					notyMessage(data.message );
					ajaxFilter( id ,url+'/data' );
				} else {
					notyMessage(data.message );
				}				
			});			
	} else {
		return false;
	}
}
function loadNestedLookup(url , id )
{
	if($(id).is(':empty'))
	{
		$(id).html('<p class"text-center" style="line-height:100px; text-align:center;"> Loading Content .... Please wait </p>');
		$.get(url,function(data)
		{
			$(id).load(url);	
		})		
	}	
}
function addMoreFiles(id){

	var html = '<div class="fileUpload btn" ><span><i class="fa fa-copy"></i></span><div class="title"> Browse File </div><input type="file" name="'+id+'[]" class="upload"></div>';

   $("."+id+"Upl").append(html)
}
;(function ($, window, document, undefined) {

    $.fn.Sdtable = function( options ) {

    	var settings = $.extend({
            tableId     : 'datatable',
            table   	: 'table',
            action      : 'action'	
     
        }, options);

        return this.each( function() {
			var gridData 	= settings.tableId+'Table';
			var gridTbl 	= settings.tableId+'Grid';
			var gridView 	= settings.tableId+'View';
        	$( gridData +' tbody').on('click', 'tr.odd', function () { $(this).toggleClass('selected'); });
        	$( gridData +' tbody ').on('click', 'tr.even', function () { $(this).toggleClass('selected'); });
			$('.Action_Row').click(function () {
				var code = $(this).attr('code');
				if( code =='reload') { settings.table.ajax.reload();}
				if( code =='add') {
			       		var url = settings.action + '/create';			       		
			       		var mode = $(this).attr('mode');
						var title = $(this).attr('data-original-title');
						if(mode =='native')
						{
							Sdt_ViewDetail( settings.tableId , url  );
						} else {
							ConcaveModal(  url  , title  );
						}					
				}

				var rows = settings.table.rows('.selected').data().length ;
		        if(rows)
		        {
		        	var id = settings.table.row('.selected').data().rowId;
					
					if(code =='view')
					{
						var url =  settings.action + '/show/'+id;
						var mode = $(this).attr('mode');
						var title = $(this).attr('data-original-title');
						if(mode =='native')
						{
							Sdt_ViewDetail( settings.tableId , url  );
						} else {
							ConcaveModal(  url  , title  );
						}
						
						

					}  else if(code =='copy') {

						var rows = settings.table.rows('.selected').data();
						var ss = [];
			        	for(var i=0; i<rows.length; i++){
			        		var ids = rows[i].rowId;
		                    ss.push(ids) ;
			        	}
			        	if(confirm('Are sure Clone/Copy selected row(s) ?'))
			        	{
			        		var url =  settings.action ;
			        		$('.ajaxLoading').show()
							$.post( url  ,{ids:ss,action_task:'copy'},function( data ) {
								if(data.status =='success')
								{
									notyMessage(data.message);	

									 settings.table.ajax.reload();
									 $('.ajaxLoading').hide()
								} else {
									notyMessageError(data.message);	
								}				
							});	
			        	}	

					} else if(code =='edit') {
			       		var url = settings.action + '/update/'+id;			       		
			       		var mode = $(this).attr('mode');
						var title = $(this).attr('data-original-title');
						if(mode =='native')
						{
							Sdt_ViewDetail( settings.tableId , url  );
						} else {
							ConcaveModal(  url  , title  );
						}					

					} else if(code =='remove'){

						var rows = settings.table.rows('.selected').data();
						var ss = [];
			        	for(var i=0; i<rows.length; i++){
			        		var ids = rows[i].rowId;
		                    ss.push(ids) ;
			        	}
			        	if(confirm('Are sure Remove selected row(s) ?'))
			        	{
			        		var url =   settings.action;
							$.post( url ,{ids:ss,action_task:'delete'},function( data ) {
								if(data.status =='success')
								{
									notyMessage(data.message);	
									settings.table.ajax.reload();
								} else {
									notyMessageError(data.message);	
								}				
							});		
			        	}					

					} else {

					}
				}	
		    });	



        });

    }

}(jQuery));

