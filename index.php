<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sistema de Gestão Hospitalar</title>
    <style>
        /* Estilo para o modo noturno */
        .dark-mode {
            background-color: #333;
            color: white;
        }

        .dark-mode header {
            background-color: #222;
        }

        .dark-mode footer {
            background-color: #222;
        }

        .dark-mode .chat-container {
            background-color: #444;
            color: white;
        }

        .dark-mode .chat-message {
            color: white;
        }

        .dark-mode .btn-primary {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .dark-mode .btn-light {
            background-color: #444;
            color: white;
        }

        .dark-mode .btn-light:hover {
            background-color: #555;
        }

        /* Estilo para o chatbot */
        .chat-container {
            width: 350px;
            max-width: 100%;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #f9f9f9;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        /* Estilo para a aba do chatbot (ficando escondido inicialmente) */
        .chat-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 1001;
        }

        /* Caixa de chat */
        .chat-box {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 20px;
            padding-right: 10px;
            padding-left: 10px;
        }

        .chat-message {
            padding: 10px;
            margin: 5px;
            border-radius: 12px;
            word-wrap: break-word;
            max-width: 80%;
        }

        .user-message {
            background-color: #d1e7dd;
            text-align: right;
            margin-left: auto;
        }

        .bot-message {
            background-color: #e2e3e5;
            text-align: left;
            margin-right: auto;
        }

        /* Indicador de digitação */
        .typing-indicator {
            font-style: italic;
            color: #6c757d;
            text-align: left;
            margin-left: 5px;
        }

        /* Estilo dos botões do chatbot */
        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-container button {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }

        .btn-container button:hover {
            background-color: #0056b3;
        }

        .btn-container button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.5);
        }

        .chat-box::-webkit-scrollbar {
            width: 8px;
        }

        .chat-box::-webkit-scrollbar-thumb {
            background-color: #6c757d;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <header class="bg-primary text-white py-3 mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="m-0">S.G.H</h2>
            <nav>
                <a href="form.html" class="btn btn-light btn-sm mx-1">Cadastrar Paciente</a>
                <a href="exames.html" class="btn btn-light btn-sm mx-1">Cadastrar Exames</a>
                <a href="listar_pacientes.php" class="btn btn-light btn-sm mx-1">Listar Pacientes</a>
                <a href="listar_situacao.php" class="btn btn-light btn-sm mx-1">Tela de Gestão</a>
            </nav>
        </div>
    </header>

    <main class="container text-center">
        <h1 class="mt-5">Seja Bem-Vindo(a) ao Sistema de Gestão Hospitalar!</h1>
        <div class="d-grid gap-3 col-6 mx-auto mt-4">
            <a href="form.html" class="btn btn-primary">Cadastrar Paciente</a>
            <a href="exames.html" class="btn btn-primary">Registrar Exame</a>
            <a href="listar_pacientes.php" class="btn btn-primary">Pacientes</a>
            <a href="listar_situacao.php" class="btn btn-primary">Exames</a>
        </div>
    </main>

    <footer class="text-center mt-5 py-3 bg-body-tertiary">
        <p>CodeLine © 2025</p>
    </footer>

    <!-- Chatbot -->
    <div class="chat-container" id="chat-container">
        <div class="chat-box" id="chat-box">
            <!-- Mensagens de chat serão exibidas aqui -->
        </div>
        <div class="btn-container" id="btn-container">
            <h5 class="text-center">Perguntas Frequentes</h5>
            <button onclick="sendQuestion('Como eu cadastro um paciente nesse sistema?')">Cadastrar Paciente</button>
            <button onclick="sendQuestion('Como eu cadastro os exames de pacientes?')">Cadastrar Exame</button>
            <button onclick="sendQuestion('Me dê os índices de referência das taxas.')">Índices de Referência</button>
            <button onclick="sendQuestion('O que pode significar glicose alta?')">Glicose Alta</button>
            <button onclick="sendQuestion('O que pode significar colesterol alto?')">Colesterol Alto</button>
            <button onclick="sendQuestion('O que pode significar leucócitos altos?')">Leucócitos Altos</button>
            <button onclick="sendQuestion('O que pode significar hematócrito alto?')">Hematócrito Alto</button>

        </div>
    </div>

    <!-- Botão para abrir o chatbot -->
    <div class="chat-toggle" id="chat-toggle" onclick="toggleChat()">💬</div>

    <button id="dark-mode-toggle" class="btn btn-dark position-fixed" style="bottom: 20px; left: 20px;">Modo Noturno</button>

    <script>
        // Verifica o status do modo noturno armazenado no localStorage e aplica a classe ao body
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }

        document.getElementById('dark-mode-toggle').onclick = function() {
            document.body.classList.toggle('dark-mode');
            
            // Salva o status do modo noturno no localStorage
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        };

        // Função para mostrar ou esconder o chatbot
        function toggleChat() {
            const chatContainer = document.getElementById('chat-container');
            const isVisible = chatContainer.style.display === 'block';
            chatContainer.style.display = isVisible ? 'none' : 'block';
        }

        // Função para adicionar mensagens ao chat
        function addMessage(content, sender) {
            const chatBox = document.getElementById("chat-box");
            const message = document.createElement("div");
            message.classList.add("chat-message");
            message.classList.add(sender === 'user' ? 'user-message' : 'bot-message');
            message.innerHTML = content;
            chatBox.appendChild(message);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        // Função para mostrar a digitação do bot antes de enviar a resposta
        function showTypingIndicator() {
            const chatBox = document.getElementById("chat-box");
            const typingMessage = document.createElement("div");
            typingMessage.classList.add("chat-message", "typing-indicator");
            typingMessage.innerHTML = "O bot está digitando...";
            chatBox.appendChild(typingMessage);
            chatBox.scrollTop = chatBox.scrollHeight;

            return typingMessage;
        }

        function sendQuestion(question) {
    addMessage(question, 'user');
    const typingIndicator = showTypingIndicator();

    // Simula a resposta do bot após um pequeno delay
    setTimeout(() => {
        typingIndicator.remove(); // Remove o indicador de digitação
        
        let response = ""; // Resposta padrão
        switch (question) {
            case 'Como eu cadastro um paciente nesse sistema?':
                response = "Para cadastrar um paciente, clique no botão 'Cadastrar Paciente' no menu ou na tela inicial e preencha o formulário com os dados necessários.";
                break;
            case 'Como eu cadastro os exames de pacientes?':
                response = "Para cadastrar exames, clique no botão 'Registrar Exame' no menu ou na tela inicial, escolha o paciente e preencha os detalhes do exame.";
                break;

            case 'Me dê os índices de referência das taxas.':
                response = `
                    <strong>Índices de Referência:</strong><br>
                    - Hemoglobina: 13.5-17.5 g/dL (homens), 12.0-15.5 g/dL (mulheres) <br>
                    - Hematócrito: 41-50% (homens), 36-44% (mulheres) <br>
                    - Leucócitos: 4,000-11,000 células/µL <br>
                    - Glicose: 70-99 mg/dL em jejum <br>
                    - Colesterol total: Menor que 200 mg/dL <br>
                    <strong>Fonte:</strong> Diretrizes da Sociedade Brasileira de Patologia Clínica/Medicina Laboratorial (SBPC/ML).
                `;
                break;
            case 'O que pode significar glicose alta?':
                response = "Glicose alta pode ser um indicativo de diabetes ou outras condições metabólicas. Consulte um médico para avaliação.";
                break;
            case 'O que pode significar colesterol alto?':
                response = "Colesterol alto pode aumentar o risco de doenças cardiovasculares. É importante realizar exames regulares e manter uma dieta equilibrada.";
                break;
            case 'O que pode significar leucócitos altos?':
                response = "Leucócitos altos podem indicar infecção ou inflamação no corpo. Consulte um especialista para entender a causa.";
                break;
            case 'O que pode significar hematócrito alto?':
                response = "Hematócrito alto pode ser sinal de desidratação ou outras condições. Consulte um profissional de saúde para uma análise detalhada.";
                break;
            default:
                response = "Desculpe, ainda não sei como responder essa pergunta. Por favor, consulte o suporte técnico.";
        }
        addMessage(response, 'bot');
    }, 2000); // Responde após 2 segundos
}



    </script>

</body>
</html>
