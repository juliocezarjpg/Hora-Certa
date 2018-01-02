function FormataCPF(){

    var cpf=document.forms.form2.cpf.value;
    var cpfValido = /^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}))$/;
    if (cpfValido.test(cpf) == false)    {

		    cpf = cpf.replace( /\D/g , ""); //Remove tudo o que não é dígito

		    cpf = cpf.replace( /(\d{3})(\d)/ , "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
		    cpf = cpf.replace( /(\d{3})(\d)/ , "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
		    //de novo (para o segundo bloco de números)
		    cpf = cpf.replace( /(\d{3})(\d{1,2})$/ , "$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos

		    var valorValido = document.getElementById("cpf").value = cpf;
    }
}
