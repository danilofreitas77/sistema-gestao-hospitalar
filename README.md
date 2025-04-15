Sistema de Otimização de Leitura de Exames Hospitalares

Este projeto é um sistema web para facilitar o gerenciamento e leitura de exames de pacientes, permitindo que laboratórios enviem resultados diretamente para médicos em tempo real. O sistema organiza e categoriza os dados, possibilitando análises detalhadas e acompanhamento da evolução dos pacientes.

🎯 Funcionalidades
Cadastro de pacientes e exames: Permite registrar ID do paciente, nome, hemoglobina, hematócrito, leucócitos, glicose e colesterol.
Histórico de exames: Armazena múltiplos exames por paciente, exibindo a evolução ao longo do tempo.
Análise automática: Classifica os níveis dos resultados como normais, altos ou baixos.
Interface amigável: Apresenta os resultados em tabelas organizadas, com links para detalhes de cada paciente.
Integração em tempo real: Os laboratórios podem enviar exames diretamente para os médicos.

🚀 Tecnologias Utilizadas
Frontend: HTML, CSS, Bootstrap e JavaScript.
Backend: PHP.
Banco de Dados: MySQL.
Servidor: Apache (via XAMPP).

📋 Requisitos
XAMPP ou outro servidor local configurado com Apache e MySQL.
Navegador atualizado para acessar a interface.

⚙️ Instalação e Configuração
Clone este repositório:

Copiar código
git clone https://github.com/seu-usuario/sistema-hospitalar.git
Configure o servidor local:

Instale o XAMPP.
Copie os arquivos do projeto para a pasta htdocs do XAMPP.
Configure o banco de dados:

Acesse o phpMyAdmin (http://localhost/phpmyadmin).
Crie um banco de dados chamado hospital.
Importe o arquivo hospital.sql (disponível neste repositório) para configurar as tabelas.
Inicie o servidor:

No XAMPP, ative os módulos Apache e MySQL.
Acesse o sistema via http://localhost/sistema-hospitalar.

🖥️ Uso do Sistema
Acesse a página inicial e realize o cadastro de pacientes.
Insira os dados dos exames para cada paciente.
Visualize os exames cadastrados em uma tabela organizada.
Clique em qualquer paciente para ver seu histórico detalhado.
Utilize os filtros para análise mais precisa.

🛠️ Melhorias Futuras
Implementação de login e autenticação para médicos e laboratórios.
Dashboard com gráficos para análise visual.
Notificações em tempo real para médicos via e-mail ou SMS.
Suporte para dispositivos móveis.

👨‍💻 Contribuição
Contribuições são bem-vindas! Siga os passos abaixo:

Faça um fork deste repositório.
Crie uma branch com a funcionalidade que deseja implementar: git checkout -b minha-feature.
Envie as alterações: git commit -m "Adicionei minha nova funcionalidade".
Faça um push para a branch: git push origin minha-feature.
Crie um Pull Request.

📝 Licença
Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais informações.