//**jQuery(document).ready(function($){
        
   // $('btnnuevo').click(function(){
   // console.log('click nuevo');
       
        // $("#modalnuevo").modal("show");
        
   // });

    


//});


jQuery(document).ready(function($){

   ////console.log(SolicitudesAjax);


   $('#btnnuevo').click(function(){
    $('#modalnuevo').modal("show");
    
   });


   var i = 1;
   $('#add').click(function(){
      i++;add
      $('#camposdinamicos').append('<tr id="row'+i+'"><td><label for="txtnombre" class="col-form-label" style="margi-right:5px">Pregunta '+i+'</label></td><td><input type="text" name="name[]" id="name" class="form-control name_list"></td><td><select name="type[] id="type" class="form-control type_list" style="margin-left:5px"><option value ="1" selected>SI - NO</option><option value="2"> rango 0 - 5</option></select></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove" style="margin-left:15px"> x </button></td></tr>');
      return false;
   });
 
   $(document).on('click','.btn_remove',function(){
      var button_id = $(this).attr('id');
      $("#row" +button_id+"").remove();
      return false;
   });
   

   $(document).on('click',"a[data-id]",function(){
      var id = this.dataset.id;
      var url = SolicitudesAjax.url;
      $.ajax({
          type: "POST",
          url: url,
          data:{
              action : "peticioneliminar",
              nonce : SolicitudesAjax.seguridad,
              id: id,
          },
          success:function(){
              alert("Datos borrados");
              location.reload();
          }
         
      });
   });
});


