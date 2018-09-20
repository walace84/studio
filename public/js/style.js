
  function carrinhoRemoverProduto( order, product_id, item ) {
    $('#form-remover-produto input[name="order"]').val(order);
    $('#form-remover-produto input[name="product_id"]').val(product_id);
    $('#form-remover-produto input[name="item"]').val(item);
    $('#form-remover-produto').submit();
}

function carrinhoAdicionarProduto( produto_id ) {
  $('#form-adicionar-produto input[name="id"]').val(produto_id);
  $('#form-adicionar-produto').submit();
}


// mascara para número telefone
$("#phone").bind('input propertychange',function(){
 
    var texto = $(this).val();
    
    texto = texto.replace(/[^\d]/g, '');
    
    if (texto.length > 0)
    {
    texto = "(" + texto;
        
    if (texto.length > 3)
    {
        texto = [texto.slice(0, 3), ") ", texto.slice(3)].join('');  
    }
    if (texto.length > 12)
    {      
    if (texto.length > 13) 
        texto = [texto.slice(0, 10), "-", texto.slice(10)].join('');
    else
        texto = [texto.slice(0, 9), "-", texto.slice(9)].join('');
    }                 
    if (texto.length > 15)                
      texto = texto.substr(0,15);
    }
    $(this).val(texto);     
 })

 // data
   
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    i18n: {
        today: 'Hoje',
        clear: 'Limpar',
        done: 'Ok',
        nextMonth: 'Próximo mês',
        previousMonth: 'Mês anterior',
        weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
        weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
        weekdays: ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'],
        monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
    }
});


  // select

  $(document).ready(function(){
    $('select').formSelect();
  });