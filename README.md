# 📌 Sistema de Jogos de Futebol - API-Football

## Objetivo

Este projeto é um sistema desenvolvido em **Laravel, PHP 8.2, MySQL 8 e TailwindCSS** que consome a **API-Football** para fornecer informações detalhadas sobre campeonatos de futebol. O sistema permite visualizar **próximos jogos, últimos resultados e partidas específicas de um time**.

## 🚀 Tecnologias Utilizadas

- **Laravel Framework** (Última versão)
- **PHP 8.2**
- **MySQL 8**
- **Tailwind CSS**
- **API-Football** (Integração para dados esportivos)

## Deploy do Projeto

O projeto pode ser configurado localmente seguindo os passos abaixo.

## Funcionalidades da Aplicação

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

## 📥 Instalação

1. **Clone o repositório:**

   ```sh
   git clone https://github.com/seu-usuario/sistema-futebol.git
   cd sistema-futebol
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

5. **Configure o banco de dados no **``:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sistema_futebol
   DB_USERNAME=root
   DB_PASSWORD=seu_password
   ```

6. **Execute as migrações:**

   ```sh
   php artisan migrate
   ```

7. **Configure a API-Football no **``:

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

## 🖼️ Imagens da Aplicação

Para ilustrar melhor o funcionamento do sistema, abaixo estão algumas telas da aplicação.

&#x20;

## 📄 Licença

Este projeto está sob a **licença MIT**. Sinta-se livre para contribuir e modificar conforme necessário.

## 🤝 Contribuindo

Se deseja contribuir, siga os passos:

1. **Fork o repositório**
2. **Crie uma branch** (`feature-minha-modificacao`)
3. **Faça suas alterações e commit** (`git commit -m 'Adicionando nova funcionalidade'`)
4. **Crie um Pull Request**

## 📧 Contato

Se tiver dúvidas ou sugestões, entre em contato:

- **Email**: [seuemail@example.com](mailto\:seuemail@example.com)
- **GitHub**: [SeuGitHub](https://github.com/seu-usuario)

