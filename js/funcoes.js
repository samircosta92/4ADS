//INSERIR


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

                document.getElementById("resposta").innerText = this.responseText;
            }

        }
        xmlhttp.open("GET", "http://localhost/4ADS/INSERIR_LIVRO.php?codigo="+ objLivro.cod.value +
            "&nome=" + objLivro.nome.value + "&autor=" + objLivro.autor.value + "&editora=" +
            objLivro.editora.value + "&quantidade=" + objLivro.qtd.value + "&img=" + objLivro.img.value,true);
        xmlhttp.send();

    }
}

function completalink()
{
    document.querySelector('input[name= img]').value+= document.getElementById("cod").value +".jpg";
}

//função valida codigo
function validaCodigo(cod)
{
    let erroCod = 0;
    if(cod.value.length !=5) {
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

//REMOVER

//ALTERAR