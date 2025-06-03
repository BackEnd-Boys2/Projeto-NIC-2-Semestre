let projetos = JSON.parse(localStorage.getItem('projetos')) || [];
let contador = projetos.length > 0 ? projetos[projetos.length - 1].id + 1 : 1;

document.getElementById('formProjeto').addEventListener('submit', function (event) {
  event.preventDefault();

  const titulo = document.getElementById('titulo').value.trim();
  const aluno = document.getElementById('aluno').value.trim().toLowerCase(); // Normaliza o nome
  const descricao = document.getElementById('descricao').value;
  const arquivoInput = document.getElementById('arquivoProjeto');
  const arquivo = arquivoInput.files[0];

  if (!arquivo) {
    alert("Por favor, selecione um arquivo compactado.");
    return;
  }

  // Verificando se o arquivo tem uma extensão permitida
  const extensaoPermitida = /\.(zip|rar|tar|gz|7z)$/i;
  if (!extensaoPermitida.test(arquivo.name)) {
    alert("Por favor, envie apenas arquivos compactados (.zip, .rar, .tar, .gz, .7z).");
    return;
  }

  const reader = new FileReader();
  reader.onload = function (e) {
    const novoProjeto = {
      id: contador++,
      titulo,
      aluno,
      descricao,
      status: 'Enviado',
      nomeArquivo: arquivo.name,
      arquivoData: e.target.result  // O arquivo é armazenado em base64
    };

    projetos.push(novoProjeto);
    localStorage.setItem('projetos', JSON.stringify(projetos)); // Salva os projetos no localStorage
    localStorage.setItem('alunoLogado', aluno); // Salva o aluno atual logado
    atualizarTabela();

    document.getElementById('formProjeto').reset();
  };

  reader.readAsDataURL(arquivo);  // Lê o arquivo como base64
});

function atualizarTabela(filtro = '') {
  const corpo = document.getElementById('tabela-corpo');
  corpo.innerHTML = '';

  projetos
    .filter(p => p.titulo.toLowerCase().includes(filtro.toLowerCase()))
    .forEach(projeto => {
      const linha = document.createElement('tr');
      linha.innerHTML = `
        <td>${projeto.id}</td>
        <td>${projeto.titulo}</td>
        <td>${projeto.aluno}</td>
        <td>${projeto.descricao}</td>
        <td>${projeto.status}</td>
        <td><a href="${projeto.arquivoData}" download="${projeto.nomeArquivo}">Baixar</a></td>
      `;
      corpo.appendChild(linha);
    });
}

function filtrar() {
  const filtro = document.getElementById('filtroInput').value.trim().toLowerCase();
  atualizarTabela(filtro);
}

// Atualiza a tabela ao dar refresh na página
window.addEventListener('DOMContentLoaded', () => {
  atualizarTabela();
});
