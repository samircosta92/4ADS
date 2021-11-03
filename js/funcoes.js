//INSERIR LIVRO

function enviaForm() {
    let objLivro = document.getElementById("formLivro");
    let cod = document.getElementById("cod");
    let nome = document.getElementById("nome");
    let autor = document.getElementById("autor");
    let editora = document.getElementById("editora");
    let qtd = document.getElementById("qtd");
    let img = document.getElementById("img");


    erro1 = validaCodigo(cod);
    erro2 = validaNome(nome);
    erro3 = validaAutor(autor);
    erro4= validaEditora(editora);
    erro5 = validaQtd(qtd);
    erro6 = validaLink(img);

    erroForm = erro1+erro2+erro3+erro4+erro5+erro6;

    if (erroForm == 0) {
        let xmlhttp = new XMLHttpRequest();
        console.log(this.readyState);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector('input[name=cod]').value = "";
                document.querySelector('input[name=nome]').value = "";
                document.querySelector('input[name=autor]').value = "";
                document.querySelector('input[name=editora]').value = "";
                document.querySelector('input[name=qtd]').value = "";
                document.querySelector('input[name=img]').value = "";
                document.getElementById("resposta").innerText = this.responseText;
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/INSERIR_LIVRO.php?codigo="+ objLivro.cod.value +
            "&nome=" + objLivro.nome.value + "&autor=" + objLivro.autor.value + "&editora=" +
            objLivro.editora.value + "&quantidade=" + objLivro.qtd.value + "&img=" + objLivro.img.value,true);
        xmlhttp.send();

    }
}

function completalink()
{

    if(document.getElementById('cod').value.length > 5){
        document.getElementById("resposta").innerHTML = "Código Inválido!";
    }else{
        document.getElementById("resposta").innerHTML = "";
        document.querySelector('input[name= img]').value= "";
        document.querySelector('input[name= img]').value+= "imagens/" + document.getElementById("cod").value +".jpg";
    }
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
                    var campo_nome = document.createElement("td");
                    var campo_aut = document.createElement("td");
                    var campo_edit = document.createElement("td");
                    var campo_qtd = document.createElement("td");
                    var campo_link = document.createElement("td");


                    var texto_cod = document.createTextNode(result[0]);
                    var texto_nome = document.createTextNode(result[1]);
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
                    document.querySelector('input[name=nome]').value = result[1];
                    document.querySelector('input[name=autor]').value = result[2];
                    document.querySelector('input[name=editora]').value = result[3];
                    document.querySelector('input[name=qtd]').value = result[4];
                    document.querySelector('input[name=img]').value = result[5];


                } else {
                    document.querySelector('input[name=cod]').value = "";
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
    let nome = document.getElementById("nome");
    let autor = document.getElementById("autor");
    let editora = document.getElementById("editora");
    let qtd = document.getElementById("qtd");
    let img = document.getElementById("img");


    erro1 = validaCodigo(cod);
    erro2 = validaNome(nome);
    erro3 = validaAutor(autor);
    erro4= validaEditora(editora);
    erro5 = validaQtd(qtd);
    erro6 = validaLink(img);

    erroForm = erro1+erro2+erro3+erro4+erro5+erro6;

    if (erroForm == 0) {
        let xmlhttp = new XMLHttpRequest();
        console.log(this.readyState);
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("resposta2").innerText = this.responseText;
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/CONFIRMA_ALTERAÇÃO.php?codigo="+ objLivro.cod.value +
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
                    var linkname = document.createTextNode(result[1]);
                    a.appendChild(linkname);
                    a.href = "https://www.google.com/search?q=" + result[1];
                    document.body.appendChild(a);

                    var linha = document.createElement("tr");
                    var campo_cod = document.createElement("td");
                    var campo_nome = document.createElement("td");
                    var campo_aut = document.createElement("td");
                    var campo_edit = document.createElement("td");
                    var campo_qtd = document.createElement("td");
                    var campo_link = document.createElement("td");

                    var texto_cod = document.createTextNode(result[0]);
                    var texto_nome = document.createTextNode(result[1]);
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
                    linha.appendChild(a)
                    linha.appendChild(campo_aut);
                    linha.appendChild(campo_edit);
                    linha.appendChild(campo_qtd);
                    linha.appendChild(campo_link);


                    table.appendChild(linha);

                    var fig = document.getElementById("fig");
                    var img = document.createElement('img');
                    img.width = '640px';
                    img.height='360px';
                    img.src= result[5];
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


    erro1 = validaNome(nome);
    erro2 = validaMat(mat);
    erro3 = validaEmail(email);
    erro4= validaTel(tel);
    erro5 = validaCurso(curso);
    erro6 = validaData(datanasc);

    erroForm = erro1+erro2+erro3+erro4+erro5+erro6;

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
                document.getElementById("resposta").innerText = this.responseText;
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/INSERIR_ALUNO.php?nome="+ objAluno.nome.value +
            "&mat=" + objAluno.mat.value + "&email=" + objAluno.email.value + "&tel=" +
            objAluno.tel.value + "&curso=" + objAluno.curso.value + "&data=" + objAluno.datanasc.value,true);
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
    let objLivro = document.getElementById("formAluno");
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
                    var a = document.createElement('a');
                    var linkname = document.createTextNode(result[0]);
                    a.appendChild(linkname);
                    a.href = "https://www.google.com/search?q=" + result[0];
                    document.body.appendChild(a);


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
                    linha.appendChild(a);
                    linha.appendChild(campo_aut);
                    linha.appendChild(campo_edit);
                    linha.appendChild(campo_qtd);
                    linha.appendChild(campo_link);


                    table.appendChild(linha);

                    var fig = document.getElementById("fig");
                    var img = document.createElement('img');
                    img.width = '640px';
                    img.height='360px';
                    img.src= result[5];
                    fig.appendChild(img);



                } else {

                    document.getElementById("resposta").innerHTML = JSON.parse(this.responseText);
                }


            }

        }


        xmlhttp.open("GET", "http://localhost/4ADS/php/BUSCA_ALUNOS.php?codigo=" + objLivro.cod.value, true);
        xmlhttp.send();

    }
}


//ALTERAR ALUNO

function buscaAluno(str) {
    let objLivro = document.getElementById("formAluno");
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


                } else {

                    document.querySelector('input[name=nome]').value = "";
                    document.querySelector('input[name=mat]').value = "";
                    document.querySelector('input[name=email]').value = "";
                    document.querySelector('input[name=telefone]').value = "";
                    document.querySelector('input[name=curso]').value = "";
                    document.querySelector('input[name=datanasc]').value = "";

                    document.getElementById("resposta").innerHTML = JSON.parse(this.responseText);
                }
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/php/BUSCA_ALUNOS.PHP?codigo=" + objLivro.mat1.value, true);
        xmlhttp.send();
    }

}

function enviaForm8() {
    let objLivro = document.getElementById("formAluno");
    let mat = document.getElementById("mat");
    let nome = document.getElementById("nome");
    let email = document.getElementById("email");
    let telefone = document.getElementById("telefone");
    let curso = document.getElementById("curso");
    let data = document.getElementById("datanasc");

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
        xmlhttp.open("GET", "http://localhost/4ADS/php/CONFIRMA_ALTERAÇÃO_ALUNO.php?mat="+ objLivro.mat.value +
            "&nome=" + objLivro.nome.value + "&email=" + objLivro.email.value + "&telefone=" +
            objLivro.telefone.value + "&curso=" + objLivro.curso.value + "&data=" + objLivro.datanasc.value,true);
        xmlhttp.send();

    }
}

/*Busca dados do aluno*/
function buscaAluno2(str){

}

/*Busca dados do livro*/
function buscadados2(str){

}

/*Registra o emprestimo*/
