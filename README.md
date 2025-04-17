# ♻️ Reciclei - Sistema de Reciclagem

**Reciclei** é uma aplicação web que conecta usuários, coletores e pontos de coleta com o objetivo de incentivar a reciclagem de resíduos sólidos urbanos. A plataforma permite o cadastro de usuários e coletores, gerenciamento de pontos de coleta, além de promover uma interação eficiente entre todos os envolvidos.

---

## 🚀 Tecnologias Utilizadas

### 🧠 Backend
- [Laravel 11](https://laravel.com/)
- Eloquent ORM
- API RESTful
- Banco de dados MySQL/MariaDB (integrado ao Laravel)

### 🎨 Frontend
- [React 18](https://reactjs.org/)
- Axios (para chamadas à API)
- React Router (para navegação entre páginas)
- Styled Components ou TailwindCSS (opcional)

---

## 🧩 Funcionalidades Principais

### 👤 Usuário
- Cadastro e login
- Visualização de pontos de coleta por cidade/estado
- Solicitação de coleta

### 🚛 Coletor
- Cadastro e login
- Acesso às solicitações de coleta dos usuários
- Confirmação de coleta realizada

### 📍 Pontos de Coleta
- Cadastro de novos pontos (realizado por administradores ou coletores autorizados)
- Informações como endereço, materiais aceitos, horário de funcionamento
- Visualização em mapa (em versão futura)

---

## ⚙️ Como Rodar o Projeto

### 🖥️ Backend (Laravel)

```bash
# Clone o repositório
git clone https://github.com/seu-usuario/ecocoleta.git
cd ecocoleta/backend

# Instale as dependências
composer install

# Copie e configure o .env
cp .env.example .env
php artisan key:generate

# Configure o banco de dados no .env
# DB_DATABASE, DB_USERNAME, DB_PASSWORD

# Execute as migrações
php artisan migrate

# Inicie o servidor
php artisan serve

```

### 💻 Equipe
