
$(function(){

    // ponerFecha de Vencimiento
    $( "#select_date" ).change(function() {
        //alert('op');
        var fecha =$('#select_date').val();
        document.getElementById("select_date2").value = fecha;

    });


    $('.fecha').datetimepicker({

        format: 'YYYY-MM-DD HH:mm:ss'
    });
    $('.fechaOnly').datetimepicker({
        format: 'DD/MM/YYYY'
       // format: 'YYYY-MM-DD'
    });

    $('#fechaOnly2').datetimepicker({
        //format: 'DD-MM-YYYY'
        format: 'YYYY-MM-DD'
    });

     $('.desde').datetimepicker({
        //format: 'DD-MM-YYYY'
        format: 'YYYY-MM-DD'

    });

      $('.hasta').datetimepicker({
        //format: 'DD-MM-YYYY'
        format: 'YYYY-MM-DD'

    })


     $('.selector expensa').selectize({
        create          : true,
         render: {
             option_create: function (data, escape) {
                 return '<div class=""><p onclick="openForm();">Nueva Expensa</p> <strong>' +  + '</strong>&hellip;</div>';

             }
         },

    });

    $('.contacto').selectize({
        create          : true,
         render: {
             option_create: function (data, escape) {
                 return '<div class=""><p onclick="openFormContacto();">Nuevo Contacto</p> <strong>' +  + '</strong>&hellip;</div>';

             }
         },

    });

     $('.selector').selectize({
        create          : true,
         render: {
             option_create: function (data, escape) {
                 return '<div class=""><p onclick="openForm();">Nueva Expensa</p> <strong>' +  + '</strong>&hellip;</div>';

             }
         },

    });



       
    $('.search_btn').click(function(){
       $(".search-box").toggle();
      //  $(".search-box input").focus();
      //  $('#factura').focus();
    });


    $(".search").keyup(function () {
           // alert('hola');
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
           // console.log(searchTerm);
            
          $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
                return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
          });
            
          $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','false');
          });

          $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','true');
          });

          var jobCount = $('.results tbody tr[visible="true"]').length;
            $('.counter').text(jobCount + ' item');

          if(jobCount == '0') {$('.no-result').show();}
            else {$('.no-result').hide();}
     });


   

})

                


function openForm()
{
   // $('#createExpense').modal('show');
}


