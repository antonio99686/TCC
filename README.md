# Sentinela da Fronteira — TCC • edição profissional

Sistema renovado em **PHP 8.1+ / MySQL 8+ / HTML, CSS e JavaScript** para gerir a invernada do PTG Sentinela da Fronteira. Não depende de Node.js.

## O que já funciona

- Login por CPF com `password_hash` / `password_verify`, sessões protegidas e limitação básica de tentativas por sessão.
- Coordenação e integrantes com permissões distintas.
- Painel de indicadores e próximos compromissos.
- Calendário mensal responsivo, usando eventos no MySQL (os dois perfis veem a mesma agenda).
- Cadastro e cancelamento de ensaios, eventos e reuniões (coordenação).
- Mural de comunicados (coordenação publica, todos leem).
- Cadastro e pesquisa de integrantes (coordenação).
- Mensalidades por competência e registro manual de quitação (coordenação).
- Empréstimos de figurinos e devoluções (coordenação).
- Perfil próprio, alteração de contato e senha.
- Interface responsiva e navegável por teclado em desktop, tablet e mobile.

## Instalar com WampServer

1. Extraia esta pasta em `C:\wamp64\www\sentinela` (ou diretório equivalente do Apache).
2. No phpMyAdmin, importe `sql/01_schema.sql`. Esse script **cria o banco `sentinela_pro`** vazio, sem pessoas reais.
3. Copie `config.example.php` para `config.php`; ajuste usuário, senha, host e nome do banco.
4. Pelo CMD, dentro da pasta do projeto, execute:
   ```cmd
   php tools/create_admin.php "Coordenador PTG" 00000000000 "UmaSenhaMuitoForte#2026"
   ```
   Use um CPF real autorizado e escolha uma senha própria — o comando acima é somente exemplo. O comando completo pode ficar registrado no histórico do terminal; em produção, prefira provisionamento de contas por método protegido.
5. Abra `http://localhost/sentinela/index.php` e entre com CPF e senha cadastrados.

## Cuidados e limitações

- **Não importamos dados pessoais** do dump original. Este é um banco limpo; para migrar integrantes antigos, requer mapeamento, backup e revisão de consentimento/privacidade.
- Integrações PIX/cartão e e-mail foram **deliberadamente desativadas** nesta nova base: exigir credenciais seguras, webhooks verificados e fluxos testados antes de ativar recebimentos reais.
- A tabela `auditoria` foi preparada para histórico, mas ainda não tem registros automáticos.
- Não inclui recuperação de senha por e-mail nem upload de documentos; faça isso antes de uso público caso seja indispensável.
- A lista de integrantes e lançamentos está limitada a 150/200 resultados; antes de uso em escala, acrescente paginação.
- Proteções básicas não substituem testes de invasão, revisão LGPD, verificações de acessibilidade e homologação.
- Executar em HTTPS em hospedagem; configure credenciais fora da pasta pública no deploy.
- Remova `tools/` e arquivos SQL do diretório público em produção ou negue acesso no servidor.

## Estrutura

`app/bootstrap.php` — conexão PDO, autenticação, CSRF, cabeçalho e helpers.
`pages/` — páginas funcionais (sem dependências de componentes antigos).
`assets/` — CSS responsivo e menu mobile.
`sql/` — schema normalizado e vazio.
`tools/` — provisionamento CLI do primeiro coordenador.

## Proposta para o texto acadêmico

Tema: desenvolvimento e avaliação de um sistema web responsivo para gestão de invernada artística. Aplicar testes de usabilidade com participantes e coordenação, avaliar tempo de tarefas, satisfação e acessibilidade. Descrever problemas do legado, modelo de dados, controle de acesso, tecnologias, implementação, testes e limitações.
