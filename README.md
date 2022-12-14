
[![Typing SVG](https://readme-typing-svg.herokuapp.com/?lines=Welcome+To+My+GitHub;Project+API_REST+Author+Matheus;Please+Feel+Free+To+Contact+Me)](https://git.io/typing-svg)

### Este é o repositório para desenvolvimento do projeto API_REST

## Projeto: API_REST com CodeIgniter!

## ℹ️ O que é?

Trata-se de um projeto onde é criada uma API com os Seguintes Endpoints.
- Endpoints de CRUD de clientes com os campos (CPF e/ou CNPJ, nome e/ou Razão social)

- Endpoints de CRUD de produtos

- Endpoints de CRUD de pedidos de compra, com status (Em Aberto, Pago ou Cancelado).

- Validação de token JWT com data de expiração.

## 🔧 Como foi desenvolvido? 
Utilizando os conceitos estudados até o momento foi construído de API com MYSQL, php E CodeIgniter4, Crud está completo e conta com diversas validações, também conta com a validação com o token JWT para mais segurança no projeto.


## 📚 Como Funciona ?

- Antes de tudo, é necessário criar o arquivo .env que vem de padrão para o codeigniter funcionar.

- Para fazer o projeto funcionar, clonar o repositório, dar um composer install, composer update, CONFIGURAR O SEU PROPRIO MYSQL no .ENV, recomendo criar um database vazio só para teste, e não se esqueça de ligar o servidor MYSQL, após isso, rodar as migrations (php spark migrate), é necessário ter o POSTMAN instalado para testar as funcionalidades.

- 1° Passo, acessar http://localhost:8080/clients/create no POSTMAN metodo POST e criar um novo usuário obrigatoriamente com 'name' (o que voce quiser), 'password' (o que voce quiser) e 'client_type_id' = 1 (apenas o primeiro, quando o banco de dados não tem usuários para login)

- 2° Passo acessar a rota de login e entrar com seus dados criados (name e password).

- 3° Sinta-se a vontade para testar todas as rotas e funcionalidades da API.

- 4° caso ocorra um erro de metodo não encontrado (getRequest) entre em contato, é apenas uma configuração do controller que não vem por padrão, mas caso queira testar imediatamente, basta copiar o conteudo do arquivo BackupController em app/Controllers para o Controller que fica em vendor/codeigniter4/framework/system/Controller.php.

- 5 ° Para criar novos dados, alem do JWT é necessário informar o token que no caso é simplesmente a letra a, para fazer isso basta ir no headers (no postman) e inserir key: token e value: a.
<br/>

## EndPoints Importantes
Metodo Post, Rota: http://localhost:8080/clients/create  para criar um novo usuário <br/>
Metodo Post, Rota: http://localhost:8080/login para fazer login <br/>
Metodo Get, Rota: http://localhost:8080/products para visualizar a lista de produtos <br/>
Metodo Put, Rota: http://localhost:8080/api/products/update/{id do produto para editar} para editar o produto selecionado <br/>
Metodo Post, Rota: http://localhost:8080/api/products/create  para criar um novo produto <br/>
Metodo Post, Rota: http://localhost:8080/api/orders/create para criar uma nova nota fiscal <br/>
Metodo Get, Rota: http://localhost:8080/orders/clients/{id do cliente) para visualizar a lista de produtos <br/>

Para saber mais, visite o vídeo que fiz sobre o projeto no Linkedin: https://www.linkedin.com/feed/update/urn:li:activity:6998768461606727680/

- Relações Entre as Tabelas

<p align="center">
     <img src="https://i.postimg.cc/PJCNHq0h/Relacoes-Entre-As-Tabelas.png[Relacoes-Entre-As-Tabelas.png](https://postimg.cc/q6dpXpkZ)"  alt="example badge" style="vertical-align:top margin:6px 4px>
</p>

<br/><br/><br/><br/><br/><br/><br/>

## 📚 Autor do Projeto [Matheus](https://www.linkedin.com/in/matheussan/)

