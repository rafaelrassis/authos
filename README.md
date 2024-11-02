# Authos

Authos é uma biblioteca de autenticação simples e eficaz, projetada para facilitar o processo de autenticação em aplicativos PHP.

## Índice

- [Introdução](#introdução)
- [Instalação](#instalação)
- [Uso](#uso)
- [Contribuição](#contribuição)
- [Licença](#licença)
- [Autoria](#autoria)

## Introdução

Authos oferece um conjunto de ferramentas para gerenciar o processo de autenticação de usuários em aplicações PHP. A biblioteca é leve, fácil de usar e altamente configurável.

## Instalação

Para instalar o Authos, você pode clonar o repositório ou instalar via Composer.

### Clonando o Repositório

```bash
git clone https://github.com/rafaelrassis/authos.git
cd authos
```

### Usando Composer

Adicione a seguinte linha ao seu arquivo `composer.json`:

```json
"require": {
    "rafaelrassis/authos": "^1.0"
}
```

Depois, execute:

```bash
composer install
```

## Uso

Para utilizar o Authos em sua aplicação, siga estas etapas:

### 1. Configuração

Configure as credenciais do banco de dados e as opções de autenticação em um arquivo de configuração.

### 2. Iniciando o Authos

Inclua a biblioteca em seu projeto:

```php
require_once 'path/to/authos/autoload.php';

use Authos\Auth;

$auth = new Auth();
```

### 3. Registrando um Usuário

Para registrar um novo usuário, utilize:

```php
$auth->register('username', 'password', 'email@example.com');
```

### 4. Autenticando um Usuário

Para autenticar um usuário:

```php
if ($auth->login('username', 'password')) {
    echo "Usuário autenticado com sucesso!";
} else {
    echo "Falha na autenticação!";
}
```

### 5. Logout

Para desconectar um usuário:

```php
$auth->logout();
```

## Contribuição

Contribuições são bem-vindas! Se você deseja contribuir com o Authos, siga estas etapas:

1. Fork este repositório.
2. Crie uma nova branch (`git checkout -b feature/nome-da-feature`).
3. Faça suas alterações e commit (`git commit -m 'Adiciona nova feature'`).
4. Push para a branch (`git push origin feature/nome-da-feature`).
5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

## Autoria

Authos foi criado por Rafael Rassis. Para mais informações, visite [rafaelrassis](https://github.com/rafaelrassis).
