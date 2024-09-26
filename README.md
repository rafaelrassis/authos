# Sistema de Autenticação e Gerenciamento de Pacientes

## Descrição do Projeto

Este projeto é um sistema completo de autenticação e gerenciamento de pacientes, com funcionalidades que permitem o cadastro e login de especialistas e pacientes. Também inclui a busca, visualização e gestão de informações de pacientes em uma interface organizada. O sistema foi desenvolvido para facilitar o gerenciamento de dados médicos e de pacientes com segurança e eficiência.

----------

## Índice

1.  [Instalação](#instala%C3%A7%C3%A3o)
2.  [Funcionalidades](#funcionalidades)
    -   [Tela de Login de Especialistas](#tela-de-login-de-especialistas)
    -   [Tela de Login de Pacientes](#tela-de-login-de-pacientes)
    -   [Tela de Cadastro de Especialistas](#tela-de-cadastro-de-especialistas)
    -   [Tela de Busca de Pacientes](#tela-de-busca-de-pacientes)
    -   [Tela de Informações do Paciente](#tela-de-informa%C3%A7%C3%B5es-do-paciente)
3.  [Contribuição](#contribui%C3%A7%C3%A3o)
4.  [Licença](#licen%C3%A7a)

----------

## Instalação

Para instalar o projeto, siga as etapas abaixo:

1.  Clone o repositório:
    
    bash
    
    Copiar código
    
    `git clone https://github.com/rafaelrassis/authos.git
    cd authos` 
    
2.  Certifique-se de que o Composer está instalado. Em seguida, execute o comando para instalar as dependências:
    
    bash
    
    Copiar código
    
    `composer install` 
    

----------

## Funcionalidades

### Tela de Login de Especialistas

-   Permite que especialistas se autentiquem utilizando seu **CIP** e **senha**.
-   Realiza **sanitização dos dados** para garantir a segurança.
-   Executa uma **verificação no banco de dados** para confirmar se os dados inseridos correspondem a um especialista registrado.
-   Redireciona o especialista para a **tela principal** do sistema em caso de sucesso ou exibe uma mensagem de erro em caso de falha.

### Tela de Login de Pacientes

-   Funcionalidade semelhante à tela de login de especialistas.
-   Permite que pacientes se autentiquem com **CPF** e **senha**, também sanitizando e verificando os dados no banco.
-   Após a autenticação bem-sucedida, o paciente é redirecionado para a tela principal.

### Tela de Cadastro de Especialistas

-   Interface de cadastro para novos especialistas no sistema.
-   Campos obrigatórios do formulário:
    -   **CIP**
    -   **CNPJ**
    -   **CPF**
    -   **Nome**
    -   **Especialidade** (menu suspenso, populado pelo método `consultaEspecialidade()` a partir dos dados do banco de dados)
    -   **Senha**
-   Permite criar, inativar e reativar especialidades para os especialistas.

### Tela de Busca de Pacientes

-   Interface que permite a busca de pacientes pelo **código**.
-   Se o paciente for encontrado:
    -   Suas informações são **salvas na sessão**.
    -   O usuário é **redirecionado** para a tela de informações detalhadas do paciente.
-   Se o paciente não for encontrado, é exibido um **código de erro**.

### Tela de Informações do Paciente

-   Exibe informações detalhadas sobre o paciente, como:
    -   **CPF**
    -   **Nome**
    -   **Data de Nascimento**
    -   **Email**
    -   **Senha**
    -   **Foto**
-   Permite ao usuário visualizar e gerenciar informações de pacientes de forma eficiente e intuitiva.

----------

## Contribuição

Contribuições são bem-vindas! Para contribuir, siga os passos abaixo:

1.  Faça um **fork** do repositório.
    
2.  Crie uma nova **branch**:
    
    bash
    
    Copiar código
    
    `git checkout -b feature/nova-funcionalidade` 
    
3.  Realize suas alterações e **commite**:
    
    bash
    
    Copiar código
    
    `git commit -m 'Adicionando nova funcionalidade'` 
    
4.  Envie suas alterações para o repositório original:
    
    bash
    
    Copiar código
    
    `git push origin feature/nova-funcionalidade` 
    
5.  Crie um **Pull Request** para que suas alterações sejam revisadas e integradas.