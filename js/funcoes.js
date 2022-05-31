//INSERIR LIVRO

function enviaForm() {
    let objLivro = document.getElementById("formLivro");
    let cod = document.getElementById("cod");
    let nome = document.getElementById("nome");
    let autor = document.getElementById("autor");
    let editora = document.getElementById("editora");
    let qtd = document.getElementById("qtd");
    let img = document.getElementById("img");
    let isbn = document.getElementById("isbn");


    erro1 = validaCodigo(cod);
    erro2 = validaNome(nome);
    erro3 = validaAutor(autor);
    erro4= validaEditora(editora);
    erro5 = validaQtd(qtd);
    erro6 = validaLink(img);
    erro7 = validaIsbn(isbn);

    erroForm = erro1+erro2+erro3+erro4+erro5+erro6+erro7;

    if (erroForm == 0) {
        let xmlhttp = new XMLHttpRequest();
        console.log(this.readyState);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector('input[name=cod]').value = "";
                document.querySelector('input[name=isbn]').value = "";
                document.querySelector('input[name=nome]').value = "";
                document.querySelector('input[name=autor]').value = "";
                document.querySelector('input[name=editora]').value = "";
                document.querySelector('input[name=qtd]').value = "";
                document.querySelector('input[name=img]').value = "";
                document.getElementById("resposta").innerText = this.responseText;
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/INSERIR_LIVRO.php?codigo="+objLivro.cod.value+"&isbn=" + objLivro.isbn.value
            +"&nome=" + objLivro.nome.value + "&autor=" + objLivro.autor.value + "&editora=" +
            objLivro.editora.value + "&quantidade=" + objLivro.qtd.value + "&img=" + objLivro.img.value,true);
        xmlhttp.send();

    }
}

function completalink2()
{

    if(document.getElementById('mat').value.length != 13){

        document.getElementById("resposta").innerHTML = "Matrícula Inválida!";
    }else{
        document.getElementById("resposta").innerHTML = "";
        document.querySelector('input[name= img]').value= "";
        document.querySelector('input[name= img]').value+= "../imagens/" + document.getElementById("mat").value +".jpg";
    }
}

function completalink()
{

    if(document.getElementById('cod').value.length > 5){
        document.getElementById("resposta").innerHTML = "Código Inválido!";
    }else{
        document.getElementById("resposta").innerHTML = "";
        document.querySelector('input[name= img]').value= "";
        document.querySelector('input[name= img]').value+= "../imagens/" + document.getElementById("cod").value +".jpg";
    }
}

//função valida ISBN
function validaIsbn (isbn){
    let erroIsbn = 0

    if(isbn.value.length != 13){
        erroIsbn = 1;
        console.log(isbn);
    }

    if(!isNumber(isbn.value)){
        erroIsbn=1;
        console.log("aqui2");
    }

    if(erroIsbn == 1)
    {
        document.getElementById("resposta").innerHTML+= "ISBN inválido!<br>";
    }

    return erroIsbn;
}

//função que verifica se a string só tem numeros
function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

//função valida codigo
function validaCodigo(cod)
{
    let erroCod = 0;
    if(cod.value.length !=5) {
        document.querySelector('input[name=cod]').value = "";
        document.querySelector('input[name=nome]').value = "";
        document.querySelector('input[name=autor]').value = "";
        document.querySelector('input[name=editora]').value = "";
        document.querySelector('input[name=qtd]').value = "";
        document.querySelector('input[name=img]').value = "";
        document.getElementById("resposta").innerHTML = "Código Invalido!<br>";
        erroCod = 1;
    }
    return(erroCod);
}

//função valida nome
function validaNome(nome)
{
    let erroNome = 0;
    if(nome.value == "")
    {
        erroNome = 1;
        document.getElementById("resposta").innerHTML+= "Nome inválido!<br>";
    }
    return(erroNome);
}

//função valida senha

function validaSenha(senha)
{
    let erroSenha = 0;
    if(senha.value == "")
    {
        erroNome = 1;
        document.getElementById("resposta").innerHTML+= "Senha inválida!<br>";
    }
    return(erroSenha);
}

//função valida autor
function validaAutor(autor)
{
    let erroAutor = 0;
    if(nome.value == "")
    {
        erroAutor = 1;
        document.getElementById("resposta").innerHTML+= "Autor inválido!<br>";
    }
    return(erroAutor);
}

//função valida editora
function validaEditora(Editora)
{
    let erroEditora = 0;
    if(nome.value == "")
    {
        erroAutor = 1;
        document.getElementById("resposta").innerHTML+= "Editora inválida!<br>";
    }
    return(erroEditora);
}

//função valida quantidade
function validaQtd(qtd)
{
    let erroQtd = 0;
    if(qtd.value == "") {
        erroQtd = 1;
        document.getElementById("resposta").innerHTML+= "Quantidade inválida!<br>";
    }
    return(erroQtd);
}

//função valida link de imagem
function validaLink(img)
{
    let erroLink = 0;
    if(img.value == "")
    {
        erroLink = 1;
        document.getElementById("resposta").innerHTML+= "Link inválido!<br>";
    }
    return(erroLink);
}


//REMOVER LIVRO
function enviaForm2() {
    let objLivro = document.getElementById("formLivro");
    let cod = document.getElementById("cod");

    erro = validaCodigo(cod);

    if (erro == 0) {
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {


                if(JSON.parse(this.responseText) != "Não existe livro com o código correspondente!") {
                    let result = JSON.parse(this.responseText);
                    var table = document.getElementById("table");

                    document.getElementById('resposta').innerHTML="";

                    var linha = document.createElement("tr");
                    var campo_cod = document.createElement("td");
                    var campo_isbn = document.createElement("td");
                    var campo_nome = document.createElement("td");
                    var campo_aut = document.createElement("td");
                    var campo_edit = document.createElement("td");
                    var campo_qtd = document.createElement("td");
                    var campo_link = document.createElement("td");


                    var texto_cod = document.createTextNode(result[0]);
                    var texto_isbn = document.createTextNode(result[1]);
                    var texto_nome = document.createTextNode(result[2]);
                    var texto_aut = document.createTextNode(result[3]);
                    var texto_edit = document.createTextNode(result[4]);
                    var texto_qtd = document.createTextNode(result[5]);
                    var texto_link = document.createTextNode(result[6]);

                    campo_cod.appendChild(texto_cod);
                    campo_isbn.appendChild(texto_isbn);
                    campo_nome.appendChild(texto_nome);
                    campo_aut.appendChild(texto_aut);
                    campo_edit.appendChild(texto_edit);
                    campo_qtd.appendChild(texto_qtd);
                    campo_link.appendChild(texto_link);

                    linha.appendChild(campo_cod);
                    linha.appendChild(campo_isbn);
                    linha.appendChild(campo_nome)
                    linha.appendChild(campo_aut)
                    linha.appendChild(campo_edit);
                    linha.appendChild(campo_qtd)
                    linha.appendChild(campo_link);

                    table.appendChild(linha);

                    var form = document.getElementById("formLivro");
                    var button = document.createElement('button');
                    button.setAttribute('type','submit');
                    button.setAttribute('id','nome');
                    button.appendChild(document.createTextNode('Confirme a Exclusão'));
                    form.appendChild(button);

                }
                else
                {
                    document.getElementById("resposta").innerHTML= JSON.parse(this.responseText);
                }


            }

        }


        xmlhttp.open("GET", "http://localhost/4ADS/php/BUSCA_LIVROS.php?codigo=" + objLivro.cod.value, true);
        xmlhttp.send();
    }

    function validaCodigo(cod)
    {
        let erroCod = 0;
        if(cod.value.length !=5) {
            document.getElementById("resposta").innerHTML = "Código Invalido!<br>";
            erroCod = 1;
        }
        return(erroCod);
    }





}

//ALTERAR LIVRO

function buscadados() {
    let objLivro = document.getElementById("formLivro");
    let cod = document.getElementById("cod1");

    erro = validaCodigo(cod);

    if (erro == 0) {
        let xmlhttp = new XMLHttpRequest();
        console.log(this.readyState);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                if (JSON.parse(this.responseText) != "Não existe livro com o código correspondente!") {
                    document.getElementById("resposta").innerHTML = "";

                    let result = JSON.parse(this.responseText);


                    document.querySelector('input[name=cod]').value = result[0];
                    document.querySelector('input[name=isbn]').value = result[1];
                    document.querySelector('input[name=nome]').value = result[2];
                    document.querySelector('input[name=autor]').value = result[3];
                    document.querySelector('input[name=editora]').value = result[4];
                    document.querySelector('input[name=qtd]').value = result[5];
                    document.querySelector('input[name=img]').value = result[6];


                } else {
                    document.querySelector('input[name=cod]').value = "";
                    document.querySelector('input[name=isbn]').value = "";
                    document.querySelector('input[name=nome]').value = "";
                    document.querySelector('input[name=autor]').value = "";
                    document.querySelector('input[name=editora]').value = "";
                    document.querySelector('input[name=qtd]').value = "";
                    document.querySelector('input[name=img]').value = "";
                    document.getElementById("resposta").innerHTML = JSON.parse(this.responseText);
                }
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/BUSCA_LIVROS.php?codigo=" + objLivro.cod1.value, true);
        xmlhttp.send();
    }

}

function enviaForm3() {
    let objLivro = document.getElementById("formLivro");
    let cod = document.getElementById("cod");
    let isbn = document.getElementById("isbn");
    let nome = document.getElementById("nome");
    let autor = document.getElementById("autor");
    let editora = document.getElementById("editora");
    let qtd = document.getElementById("qtd");
    let img = document.getElementById("img");


    let erro1 = validaCodigo(cod);
    let erro2 = validaNome(nome);
    let erro3 = validaAutor(autor);
    let erro4= validaEditora(editora);
    let erro5 = validaQtd(qtd);
    let erro6 = validaLink(img);
    let erro7 = validaIsbn(isbn);

    let erroForm = erro1+erro2+erro3+erro4+erro5+erro6+erro7;

    if (erroForm == 0) {
        let xmlhttp = new XMLHttpRequest();
        console.log(this.readyState);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("resposta2").innerText = this.responseText;
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/CONFIRMA_ALTERAÇÃO.php?codigo="+ objLivro.cod.value + "&isbn=" + objLivro.isbn.value +
            "&nome=" + objLivro.nome.value + "&autor=" + objLivro.autor.value + "&editora=" +
            objLivro.editora.value + "&quantidade=" + objLivro.qtd.value + "&img=" + objLivro.img.value,true);
        xmlhttp.send();

    }
}

//BUSCAR LIVRO

function enviaForm4() {
    let objLivro = document.getElementById("formLivro");
    let cod = document.getElementById("cod");

    erro = validaCodigo(cod);


    if (erro == 0) {
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {


                if (JSON.parse(this.responseText) != "Não existe livro com o código correspondente!") {

                    document.getElementById("resposta").innerHTML = "";

                    let result = JSON.parse(this.responseText);
                    var table = document.getElementById("table")
                    var a = document.createElement('a');
                    var linkname = document.createTextNode(result[2]);
                    a.appendChild(linkname);
                    a.href = "https://www.google.com/search?q=" + result[2] + " " + result[3] ;
                    document.body.appendChild(a);

                    var linha = document.createElement("tr");
                    var campo_cod = document.createElement("td");
                    var campo_isbn = document.createElement("td");
                    var campo_nome = document.createElement("td");
                    var campo_aut = document.createElement("td");
                    var campo_edit = document.createElement("td");
                    var campo_qtd = document.createElement("td");
                    var campo_link = document.createElement("td");

                    var texto_cod = document.createTextNode(result[0]);
                    var texto_isbn = document.createTextNode(result[1]);
                    var texto_nome = document.createTextNode(result[2]);
                    var texto_aut = document.createTextNode(result[3]);
                    var texto_edit = document.createTextNode(result[4]);
                    var texto_qtd = document.createTextNode(result[5]);
                    var texto_link = document.createTextNode(result[6]);

                    campo_cod.appendChild(texto_cod);
                    campo_isbn.appendChild(texto_isbn);
                    campo_nome.appendChild(texto_nome);
                    campo_aut.appendChild(texto_aut);
                    campo_edit.appendChild(texto_edit);
                    campo_qtd.appendChild(texto_qtd);
                    campo_link.appendChild(texto_link);

                    linha.appendChild(campo_cod);
                    linha.appendChild(campo_isbn);
                    linha.appendChild(a)
                    linha.appendChild(campo_aut);
                    linha.appendChild(campo_edit);
                    linha.appendChild(campo_qtd);
                    linha.appendChild(campo_link);


                    table.appendChild(linha);

                    var fig = document.getElementById("fig");
                    var img = document.getElementById("img");


                    img.width = "150";
                    img.height = "250";
                    img.src= result[6];
                    fig.appendChild(img);



                } else {
                    document.getElementById("resposta").innerHTML = JSON.parse(this.responseText);
                }


            }

        }


        xmlhttp.open("GET", "http://localhost/4ADS/php/BUSCA_LIVROS.php?codigo=" + objLivro.cod.value, true);
        xmlhttp.send();

    }
}

//INSERIR ALUNO

function enviaForm5() {
    let objAluno = document.getElementById("formAluno");
    let nome = document.getElementById("nome");
    let mat = document.getElementById("mat");
    let email = document.getElementById("email");
    let tel = document.getElementById("tel");
    let curso = document.getElementById("curso");
    let datanasc = document.getElementById("datanasc");
    let img = document.getElementById("img");


    erro1 = validaNome(nome);
    erro2 = validaMat(mat);
    erro3 = validaEmail(email);
    erro4= validaTel(tel);
    erro5 = validaCurso(curso);
    erro6 = validaData(datanasc);
    erro7 = validaLink(img);

    erroForm = erro1+erro2+erro3+erro4+erro5+erro6+erro7;

    if (erroForm == 0) {
        let xmlhttp = new XMLHttpRequest();
        console.log(this.readyState);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("nome").value = "";
                document.getElementById("mat").value = "";
                document.getElementById("email").value = "";
                document.getElementById("tel").value = "";
                document.getElementById("curso").value = "";
                document.getElementById("datanasc").value = "";
                document.getElementById("img").value = "";
                document.getElementById("resposta").innerText = this.responseText;
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/INSERIR_ALUNO.php?nome="+ objAluno.nome.value +
            "&mat=" + objAluno.mat.value + "&email=" + objAluno.email.value + "&tel=" +
            objAluno.tel.value + "&curso=" + objAluno.curso.value + "&data=" + objAluno.datanasc.value
            + "&img=" + objAluno.img.value,true);
        xmlhttp.send();

    }
}

function validaMat(mat)
{
    let erroMat = 0;
    if(mat.value.length !=13)
    {
        erroMat = 1;
        document.getElementById("nome").value = "";
        document.getElementById("mat").value = "";
        document.getElementById("email").value = "";
        document.getElementById("tel").value = "";
        document.getElementById("curso").value = "";
        document.getElementById("datanasc").value = "";

        document.getElementById("resposta").innerHTML= "Matrícula inválida!<br>";
    }
    return(erroMat);
}

function validaMatExc(mat)
{
    let erroMat = 0;
    if(mat.value.length !=13)
    {
        erroMat = 1;
        document.getElementById("resposta").innerHTML= "Matrícula inválida!<br>";
    }
    return(erroMat);
}

function validaEmail(email)
{
    let erroEmail = 0;
    if(email.value == "")
    {
        erroEmail = 1;
        document.getElementById("resposta").innerHTML+= "Email inválido!<br>";
    }
    return(erroEmail);
}

function validaTel(tel){
    let erroTel = 0;
    if(tel.value == ""){
        erroTel = 1;
        document.getElementById("resposta").innerHTML+= "Telefone inválido!<br>";
    }
    return(erroTel);
}

function validaCurso(curso){
    let erroCurso = 0;
    if(curso.value == ""){
        erroCurso = 1;
        document.getElementById("resposta").innerHTML+= "Curso inválido!<br>";
    }
    return(erroCurso);
}

function validaData(data){
    let erroData = 0;
    if(data.value == ""){
        erroData = 1;
        document.getElementById("resposta").innerHTML+= "Data inválida!<br>";
    }
    return(erroData);
}

function avisoTel(){
   let aviso =  document.getElementById('aviso');
    aviso.style.marginTop= '0px';
    aviso.style.fontSize = '10px';
    aviso.style.color = "red";
    aviso.innerHTML="Digite apenas numeros!<br><br>";
}

//REMOVER ALUNO
function enviaForm6() {
    let objAluno = document.getElementById("formAluno");
    let cod = document.getElementById("mat");
    console.log("chegou!");

    var erro = validaMatExc(cod);
    console.log(erro);

    if (erro == 0) {
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {


                if (JSON.parse(this.responseText) != "Não existe aluno com o código correspondente!") {
                    let result = JSON.parse(this.responseText);
                    var table = document.getElementById("table");
                    console.log("chegou2!");

                    document.getElementById('resposta').innerHTML = "";

                    var linha = document.createElement("tr");
                    var campo_cod = document.createElement("td");
                    var campo_nome = document.createElement("td");
                    var campo_aut = document.createElement("td");
                    var campo_edit = document.createElement("td");
                    var campo_qtd = document.createElement("td");
                    var campo_link = document.createElement("td");


                    var texto_cod = document.createTextNode(result[1]);
                    var texto_nome = document.createTextNode(result[0]);
                    var texto_aut = document.createTextNode(result[2]);
                    var texto_edit = document.createTextNode(result[3]);
                    var texto_qtd = document.createTextNode(result[4]);
                    var texto_link = document.createTextNode(result[5]);

                    campo_cod.appendChild(texto_cod);
                    campo_nome.appendChild(texto_nome);
                    campo_aut.appendChild(texto_aut);
                    campo_edit.appendChild(texto_edit);
                    campo_qtd.appendChild(texto_qtd);
                    campo_link.appendChild(texto_link);

                    linha.appendChild(campo_cod);
                    linha.appendChild(campo_nome)
                    linha.appendChild(campo_aut)
                    linha.appendChild(campo_edit);
                    linha.appendChild(campo_qtd)
                    linha.appendChild(campo_link);

                    table.appendChild(linha);

                    var form = document.getElementById("formAluno");
                    var button = document.createElement('button');
                    button.setAttribute('type', 'submit');
                    button.setAttribute('id', 'nome');
                    button.appendChild(document.createTextNode('Confirme a Exclusão'));
                    form.appendChild(button);

                } else {
                    document.getElementById("resposta").innerHTML = JSON.parse(this.responseText);
                }


            }


        }
        console.log(objAluno.cod.value);
        xmlhttp.open("GET", "http://localhost/4ADS/php/BUSCA_ALUNOS.php?codigo=" + objAluno.cod.value, true);
        xmlhttp.send();
    }
}






//BUSCAR ALUNO
function enviaForm7() {
    let objAluno = document.getElementById("formAluno");
    let cod = document.getElementById("cod");

    erro = validaMatExc(cod);


    if (erro == 0) {
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {


                if (JSON.parse(this.responseText) != "Não existe aluno com o código correspondente!") {

                    document.getElementById("resposta").innerHTML = "";

                    let result = JSON.parse(this.responseText);
                    var table = document.getElementById("table")


                    var linha = document.createElement("tr");
                    var campo_mat = document.createElement("td");
                    var campo_nome = document.createElement("td");
                    var campo_email = document.createElement("td");
                    var campo_tel = document.createElement("td");
                    var campo_curso = document.createElement("td");
                    var campo_datanasc = document.createElement("td");
                    var campo_link = document.createElement("td");


                    var texto_mat = document.createTextNode(result[1]);
                    var texto_nome = document.createTextNode(result[0]);
                    var texto_email = document.createTextNode(result[2]);
                    var texto_tel = document.createTextNode(result[3]);
                    var texto_curso = document.createTextNode(result[4]);
                    var texto_datanasc= document.createTextNode(result[5]);
                    var texto_link = document.createTextNode(result[6]);

                    campo_mat.appendChild(texto_mat);
                    campo_nome.appendChild(texto_nome);
                    campo_email.appendChild(texto_email);
                    campo_tel.appendChild(texto_tel);
                    campo_curso.appendChild(texto_curso);
                    campo_datanasc.appendChild(texto_datanasc);
                    campo_link.appendChild(texto_link);

                    linha.appendChild(campo_mat);
                    linha.appendChild(campo_nome);
                    linha.appendChild(campo_email);
                    linha.appendChild(campo_tel);
                    linha.appendChild(campo_curso);
                    linha.appendChild(campo_datanasc);
                    linha.appendChild(campo_link);


                    table.appendChild(linha);

                    var fig = document.getElementById("fig");
                    var img = document.getElementById("img");

                    img.width = "150";
                    img.height = "250";
                    img.src= result[6];
                    fig.appendChild(img);



                } else {

                    document.getElementById("resposta").innerHTML = JSON.parse(this.responseText);
                }


            }

        }


        xmlhttp.open("GET", "http://localhost/4ADS/php/BUSCA_ALUNOS.php?codigo=" + objAluno.cod.value, true);
        xmlhttp.send();

    }
}


//ALTERAR ALUNO

function buscaAluno(str) {
    let objAluno = document.getElementById("formAluno");
    let cod = document.getElementById("mat1");

    erro = validaMat(cod);

    if (erro == 0) {
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                if (JSON.parse(this.responseText) != "Não existe aluno com o código correspondente!") {
                    document.getElementById("resposta").innerHTML = "";

                    let result = JSON.parse(this.responseText);
                    console.log(result);//teste

                    document.querySelector('input[name=nome]').value = result[0];
                    document.querySelector('input[name=mat]').value = result[1];
                    document.querySelector('input[name=email]').value = result[2];
                    document.querySelector('input[name=telefone]').value = result[3];
                    document.querySelector('input[name=curso]').value = result[4];
                    document.querySelector('input[name=datanasc]').value = result[5];
                    document.querySelector('input[name=link]').value = result[6];


                } else {

                    document.querySelector('input[name=nome]').value = "";
                    document.querySelector('input[name=mat]').value = "";
                    document.querySelector('input[name=email]').value = "";
                    document.querySelector('input[name=telefone]').value = "";
                    document.querySelector('input[name=curso]').value = "";
                    document.querySelector('input[name=datanasc]').value = "";
                    document.querySelector('input[name=link]').value = "";

                    document.getElementById("resposta").innerHTML = JSON.parse(this.responseText);
                }
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/BUSCA_ALUNOS.PHP?codigo=" + objAluno.mat1.value, true);
        xmlhttp.send();
    }

}

function enviaForm8() {
    let objAluno = document.getElementById("formAluno");
    let mat = document.getElementById("mat");
    let nome = document.getElementById("nome");
    let email = document.getElementById("email");
    let telefone = document.getElementById("telefone");
    let curso = document.getElementById("curso");
    let data = document.getElementById("datanasc");
    let link = document.getElementById("link");

    erro1 = validaNome(nome);
    erro2 = validaMat(mat);
    erro3 = validaEmail(email);
    erro4= validaTel(telefone);
    erro5 = validaCurso(curso);
    erro6 = validaData(data);

    erroForm = erro1+erro2+erro3+erro4+erro5+erro6;

    if (erroForm == 0) {
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("resposta2").innerText = this.responseText;
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/CONFIRMA_ALTERAÇÃO_ALUNO.php?mat="+ objAluno.mat.value +
            "&nome=" + objAluno.nome.value + "&email=" + objAluno.email.value + "&telefone=" +
            objAluno.telefone.value + "&curso=" + objAluno.curso.value + "&data=" + objAluno.datanasc.value + "&link="
            + objAluno.link.value,true);
        xmlhttp.send();

    }
}

/*Busca dados do aluno*/
function buscaAluno2(str){
    let objAluno = document.getElementById("formAluno");
    let mat = document.getElementById("mat");

    erro = validaMatExc(mat);

    if (erro == 0) {
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                if (JSON.parse(this.responseText) != "Não existe aluno com a matricula correspondente!") {
                    document.getElementById("resposta1").innerHTML = "";

                    let result = JSON.parse(this.responseText);
                    console.log(result);//teste

                    document.querySelector('input[name=nomealuno]').value = result[0];
                    document.querySelector('input[name=curso]').value = result[1];
                    document.querySelector('input[name=sitaluno]').value = result[2];

                    var fig = document.getElementById("fig1");
                    var img = document.getElementById("img1");


                    img.width = "120";
                    img.height = "200";
                    img.src= result[3];
                    fig.appendChild(img);


                } else {

                    document.querySelector('input[name=nomealuno]').value = "";
                    document.querySelector('input[name=curso]').value = "";
                    document.querySelector('input[name=sitaluno]').value = "";

                    var aviso = document.getElementById("resposta1");
                    aviso.style.marginTop= '0px';
                    aviso.style.fontSize = '10px';
                    aviso.style.color = "red";
                    aviso.innerHTML = JSON.parse(this.responseText)
                }
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/BUSCA_ALUNOS_EMP.PHP?matricula=" + objAluno.mat.value, true);
        xmlhttp.send();
    }
}

/*Busca dados do livro*/
function buscadados2(str){
    let objLivro = document.getElementById("formLivro");
    let cod = document.getElementById("cod");

    erro = validaCodigo(cod);

    if (erro == 0) {
        let xmlhttp = new XMLHttpRequest();
        console.log(this.readyState);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                if (JSON.parse(this.responseText) != "Não existe livro com o código correspondente!") {
                    document.getElementById("resposta2").innerHTML = "";

                    let result = JSON.parse(this.responseText);
                    console.log(result);//teste

                    document.querySelector('input[name=nome]').value = result[0];
                    document.querySelector('input[name=autor]').value = result[1];
                    document.querySelector('input[name=sitautor]').value = result[2];

                    var fig = document.getElementById("fig2");
                    var img = document.getElementById("img2");


                    img.width = "120";
                    img.height = "200";
                    img.src= result[4];
                    fig.appendChild(img);

                } else {
                    document.querySelector('input[name=nome]').value = "";
                    document.querySelector('input[name=autor]').value = "";
                    document.querySelector('input[name=sitautor]').value = "";

                    var aviso = document.getElementById("resposta2");
                    aviso.style.marginTop= '0px';
                    aviso.style.fontSize = '10px';
                    aviso.style.color = "red";
                    aviso.innerHTML = JSON.parse(this.responseText)

                }
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/BUSCA_LIVROS_EMP.php?codigo=" + objLivro.cod.value, true);
        xmlhttp.send();
    }
}

/*Registra o emprestimo*/
function enviaEmp() {
    let objLivro = document.getElementById("formLivro");
    let objAluno = document.getElementById("formAluno");

    let cod = document.getElementById("cod");
    let nome = document.getElementById("nome");

    let nomeA = document.getElementById("nomealuno");
    let mat = document.getElementById("mat");

    document.getElementById("resposta3").innerText = "";

    sitAluno = document.getElementById("sitaluno").value;
    sitLivro = document.getElementById("sitautor").value;

    if (sitAluno!="OK" || sitLivro!="Disponivel"){
        document.getElementById("resposta3").innerText = "Impossível realizar empréstimo!";
        console.log(sitAluno);
        console.log(sitLivro);
    }else{
        erro1 = validaCodigo(cod);
        erro2 = validaNome(nome);
        erro3 = validaMatExc(mat);
        erro4 = validaNome(nomeA);
        erroForm = erro1 + erro2 + erro3 + erro4;

        if (document.getElementById("sitaluno").value=="OK" &&
            document.getElementById("sitautor").value=="Disponivel") {

            if (erroForm == 0) {
                let xmlhttp = new XMLHttpRequest();
                console.log(this.readyState);
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.querySelector('input[name=cod]').value = "";
                        document.querySelector('input[name=nome]').value = "";
                        document.querySelector('input[name=autor]').value = "";
                        document.querySelector('input[name=sitautor]').value = "";
                        var img1 = document.getElementById("img1");

                        img1.width = "0";
                        img1.height = "0";
                        img1.src= "0";

                        document.querySelector('input[name=mat]').value = "";
                        document.querySelector('input[name=nomealuno]').value = "";
                        document.querySelector('input[name=curso]').value = "";
                        document.querySelector('input[name=sitaluno]').value = "";

                        var img2 = document.getElementById("img2");

                        img2.width = "0";
                        img2.height = "0";
                        img2.src= "0";

                        let result = JSON.parse(this.responseText);
                        window.location.href = "http://localhost/4ads/php/empPDF.php?matricula=" + result[0] +
                            "&codigo=" + result[1] + "&dataEMP=" + result[2] + "&dataDev=" + result[3] +
                            "&idEMP=" + result[4];

                    }

                }
                xmlhttp.open("GET", "http://localhost/4ADS/php/CONFIRMA_EMP.php?codigo=" + cod.value +
                    "&nome=" + nome.value + "&mat=" + mat.value + "&nomealuno=" +
                    nomeA.value, true);
                xmlhttp.send();
            }
        }
        else{
            document.getElementById("resposta3").innerText = "Não é possível realizar o empréstimo";
        }
    }


}




//FUNÇÕES PARA GERAR RELATÓRIO
function gerarRelatorios(relatorio){

    let xmlhttp = new XMLHttpRequest();
    console.log(this.readyState);
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("resposta").innerText = this.responseText;
        }

    }
    xmlhttp.open("GET", "http://localhost/4ADS/php/GERA_PDF.php?relatorio=" + relatorio, true);
    xmlhttp.send();

}


//FUNÇÃO PARA BUSCAR INFORMAÇÕES DO EMPRESTIMO
function buscaEmpr(str){

    if(validaMatExc(str)==1){
        document.getElementById("resposta").innerText = "Matricula Inválida!";
    }else{
        let xmlhttp = new XMLHttpRequest();
        console.log(this.readyState);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                let result = JSON.parse(this.responseText);
                console.log(result);//teste
                var table = document.getElementById("table");

                var linha = document.createElement("tr");
                var campo_id = document.createElement("td");
                var campo_mat = document.createElement("td");
                var campo_cod = document.createElement("td");
                var campo_dataemp = document.createElement("td");
                var campo_dev = document.createElement("td");
                var campo_situ = document.createElement("td");

                var texto_id = document.createTextNode(result[0]);
                var texto_mat = document.createTextNode(result[1]);
                var texto_cod = document.createTextNode(result[2]);
                var texto_dataemp = document.createTextNode(result[3]);
                var texto_dev = document.createTextNode(result[4]);
                var texto_situ = document.createTextNode(result[5]);

                campo_id.appendChild(texto_id);
                campo_mat.appendChild(texto_mat);
                campo_cod.appendChild(texto_cod);
                campo_dataemp.appendChild(texto_dataemp);
                campo_dev.appendChild(texto_dev);
                campo_situ.appendChild(texto_situ);

                linha.appendChild(campo_id);
                linha.appendChild(campo_mat);
                linha.appendChild(campo_cod);
                linha.appendChild(campo_dataemp);
                linha.appendChild(campo_dev);
                linha.appendChild(campo_situ);


                table.appendChild(linha);

            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/DADOS_EMP.php?matricula=" + str, true);
        xmlhttp.send();
    }

}

//Função para cadastrar usuario
function enviaCadastro(){
    let objUsuario = document.getElementById("formUsuario");

    var nome = document.getElementById("nome");
    var email = document.getElementById("email");
    var senha = document.getElementById("senha");
    var confemail = document.getElementById("confemail");
    var confsenha = document.getElementById("confsenha");

    document.getElementById("resposta").innerText = " ";
    erro1 = validaNome(nome);
    erro2 = validaEmail(email);
    erro3 = validaSenha(senha);

    erroForm = erro1+erro2+erro3;



    if ((email.value != confemail.value) || (senha.value != confsenha.value)){
        document.getElementById("resposta").innerText = "Senha e/ou email não são iguais às confirmações!";

    }
    else
    if (erroForm==0){
        let xmlhttp = new XMLHttpRequest();
        console.log(this.readyState);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("nome").value = "";
                document.getElementById("senha").value = "";
                document.getElementById("confsenha").value = "";
                document.getElementById("email").value = "";
                document.getElementById("confemail").value = "";
                document.getElementById("resposta").innerText = this.responseText;

            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/INSERIR_USUÁRIO.php?nome="+ objUsuario.nome.value +
            "&senha=" + objUsuario.senha.value + "&email=" + objUsuario.email.value,true);
        xmlhttp.send();

    }

}

//Função para login
function enviaLogin(){
    let objLogin = document.getElementById("formLogin");

    var nome = document.getElementById("nome");
    var senha = document.getElementById("senha");


    document.getElementById("resposta").innerText = " ";
    erro1 = validaNome(nome);
    erro2 = validaSenha(senha);

    erroForm = erro1+erro2;


    if (erroForm==0){
        let xmlhttp = new XMLHttpRequest();
        console.log(this.readyState);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("nome").value = "";
                document.getElementById("senha").value = "";

                if(JSON.parse(this.responseText) == "Ok" )
                {
                    window.location.href = "http://localhost/4ads/html/MENU.html"
                }
                else
                {
                    document.getElementById("resposta").innerText = JSON.parse(this.responseText);

                }


            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/LOGIN.php?nome="+ objLogin.nome.value +
            "&senha=" + objLogin.senha.value,true);
        xmlhttp.send();

    }


}

