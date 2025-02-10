# 📌 Sistema de Jogos de Futebol - API-Football

## Objetivo

Este projeto é um sistema desenvolvido em **Laravel, PHP 8.2, MySQL 8 e TailwindCSS** que consome a **API-Football** para fornecer informações detalhadas sobre campeonatos de futebol. O sistema permite visualizar **Campeonatos, próximos jogos, últimos resultados e partidas específicas de um time**.

## Deploy do projeto em produção
Este projeto está hospedado no serviço EC2 da AWS. Você pode acessá-lo e testá-lo agora mesmo clicando no link: [Deploy do Projeto no EC2](https://tinyurl.com/desafio-futebol-app)

## Funcionalidades desta Aplicação
Todas as funcionalidades exigidas no **enunciado** foram desenvolvidas, inclusive aproveitei para implementar novas funcionalidades, ou **funcionalidades bônus.** Abaixo seguem as principais funcionalidades deste projeto:

### 🎯 Principais Funcionalidades

1. **Seleção de Campeonato**

   - O usuário pode escolher um campeonato (ex: **Campeonato Brasileiro, Premier League, La Liga**).

2. **Visualização dos Jogos Programados**

   - Exibe os próximos jogos de um campeonato com as seguintes informações:
     - Nome dos times (casa e visitante)
     - Data e horário do jogo
     - Estádio (se disponível)

3. **Consulta dos Últimos Resultados**

   - Mostra os últimos jogos de um campeonato com o placar final.
   - Exemplo: **Flamengo 2x1 Vasco**

4. **Busca por um Time Específico**

   - Permite pesquisar um time pelo nome e visualizar:
     - Próximos jogos
     - Últimos resultados

## 🚀 Tecnologias Utilizadas
- **Linguagem PHP v8**
- **Laravel Framework** (Última versão)
- **Laravel Breeze** (Scaffold completo para as telas de usuário, login, register, etc.)
- **MySQL v8**
- **Tailwind CSS v4**
- **API-Football** (Integração para dados esportivos)

## 📥 Instalação

1. **Clone o repositório:**

   ```sh
   git clone https://github.com/am-matheusoliveira/desafio-futebol-app.git
   cd desafio-futebol-app
   ```

2. **Instale as dependências do Laravel:**

   ```sh
   composer install
   ```

3. **Instale as dependências do frontend:**

   ```sh
   npm install
   ```

4. **Copie o arquivo de configuração e gere a chave do app:**

   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure o banco de dados no `.env`**:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=futebol_app
   DB_USERNAME=root
   DB_PASSWORD=seu_password
   ```

6. **Execute as migrações:**

   ```sh
   php artisan migrate
   ```

7. **Configure sua chave da API-Football no `.env`**:

   ```env
   API_FOOTBALL_KEY=sua_chave_da_api
   ```

8. **Inicie o servidor local:**

   ```sh
   php artisan serve
   ```

9. **Inicie o Vite para compilar os assets:**

   ```sh
   npm run dev
   ```
   **Ou compile os assets:**
   
    ```sh
    npm run build
    ```   

10. **Acesse o projeto no navegador:**
   
    Após executar todas as etapas acima, o sistema estará disponível em:
   
    **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

## 🖼️ Imagens da Aplicação

Para ilustrar melhor o funcionamento do sistema, abaixo estão algumas telas da aplicação.

### 1. Página inicial da Aplicação:

![01-IMG-HOME-SISTEMA](https://github.com/user-attachments/assets/e2bd97ce-eb5f-4653-8c9a-eeda1e53caa9)

### 2. Tela de Login da Aplicação:

![02-IMG-LOGIN](https://github.com/user-attachments/assets/48df4a0b-7922-4402-bd56-c00f04025abd)

### 3. Tela de Cadastro de novos Usuários da Aplicação:

![03-IMG-NOVO-USUARIO](https://github.com/user-attachments/assets/880b9549-d116-4fb0-9a88-5ca004fa050c)

### 4. Dashboard da Aplicação:

![10-IMG-DASHBOARD-SISTEMA](https://github.com/user-attachments/assets/1ed3edd0-6d29-437b-a653-4818f385c80d)

### 5. Campeonatos:

![04-IMG-CAMPEONATOS](https://github.com/user-attachments/assets/a89e1ed8-e3a3-4963-91d6-258ace83c9c7)

### 6. Jogos do Campeonato:

![05-IMG-JOGOS-CAMPEONATOS](https://github.com/user-attachments/assets/4d0df645-a240-4807-b452-055479a0ba8b)

### 7. Resultado do Campeonato(Jogos que aconteceram):

![06-IMG-RESULTADO-CAMPEONATO](https://github.com/user-attachments/assets/f67d7024-c712-42c1-95d9-5dc290850c9f)

### 8. Buscar Time Especifico:

![07-IMG-BUSCAR-TIME](https://github.com/user-attachments/assets/b3235bb0-d48b-486d-b5e8-f3aae51b25f0)

### 9. Jogos do Time Selecionado:

![08-IMG-JOGOS-TIME](https://github.com/user-attachments/assets/bddd268a-1f4d-4d67-8a1b-ccccd019257d)

## ⚠️ Disclaimer

A API-Football, em sua versão gratuita, **não fornece informações sobre jogos a partir de 2024**. Os dados disponíveis abrangem os anos de **2021 a 2023**. 

Para garantir o funcionamento do sistema e atender aos requisitos do desafio técnico, todas as consultas e exibições de partidas foram ajustadas para trabalhar dentro deste intervalo de anos suportados. 

Abaixo, segue uma imagem com um aviso da API sobre essas limitações:

## 📷 Imagem - Aviso de limites da API
![erro-plano-gratuito-limite](https://github.com/user-attachments/assets/489a62a4-2d40-4c85-a9e3-e656792bccba)

## Não conseguiu rodar o projeto? 
<b>Se, após a execução de todas as etapas anteriores, você ainda não conseguir rodar este projeto, não se preocupe! Você ainda pode acessá-lo e testá-lo através do deploy de produção. Acesse o link deste projeto, que está rodando no AWS EC2: [Deploy do Projeto no EC2](https://tinyurl.com/desafio-futebol-app)</b>
---
### Referências

- **PHP 8.2**  
  [Documentação oficial do PHP 8.2](https://www.php.net/releases/8.2/)

- **Laravel Framework**  
  [Documentação oficial do Laravel](https://laravel.com/docs)

- **MySQL Database**  
  [Documentação oficial do MySQL](https://dev.mysql.com/doc/refman/8.0/en/)

- **TailwindCSS**  
  [Documentação oficial do TailwindCSS](https://tailwindcss.com/docs/installation/using-vite)

- **API-FUTEBOL**  
  [Documentação oficial do API-FUTEBOL](https://www.api-football.com/documentation-v3)
  
---
Sinta-se à vontade para explorar o código e fazer melhorias.<br>
Se tiver alguma dúvida, entre em contato.
