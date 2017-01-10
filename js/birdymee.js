meAvise = function() {
    $.post('process.php', {email: $('#inputEmail').val()}, function(data) { 
      data = data.replace('"', "").replace('"', "");
      switch(data) {
        case 'registered':
           $('.modal-title').html('Obrigado!');
           $('.modal-body').html('<p>Seu e-mail foi registrado com sucesso. <br /<br />Em breve você será comunicado a respeito do lançamento do <br /><strong>App Birdymee</strong></p>');
           break;
        case 'exists':
           $('.modal-title').html('Ops...');
           $('.modal-body').html('<p>Seu e-mail já está registrado em nossos registros. <br /<br />Em breve você será comunicado a respeito do lançamento do <br /><strong>App Birdymee</strong></p>');
          break;
        case 'error':
           $('.modal-title').html('Ops...');
           $('.modal-body').html('<p>Ocorreu um erro no seu cadastro. <br /<br />Por favor, entre em contato conosco através do e-mail birdymee@birdymee.com.br</p>');
          break;
      }

      $('#modal').modal({
        keyboard: false
      });

     }
    );
}
